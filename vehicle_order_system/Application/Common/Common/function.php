<?php
/**
 * Created by PhpStorm.
 * User: 77354
 * Date: 2018/4/18
 * Time: 22:09
 */

function AccessToPermissions($url1) {
    $wechat = C('WECHAT_SDK');
    $redirect_uri = urlencode('http://yijiangbangtest.wsandos.com/linxiaocong/home/index/getUserInfo?url='.$url1);
    $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$wechat['appid']}&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
    header("Location:".$url);
}

//获取微信accesstoken
function getAccessToken() {
    $wechat = C('WECHAT_SDK');

    $lifeTime = 2 * 3600;
    session_set_cookie_params($lifeTime);
    session_start();
    if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        return 0;
    }else {
        //取全局access_token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wechat['appid']}&secret={$wechat['secret']}";
//https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxddbec552bd3c87d4&secret=a29f03616a31ebd7b23d28e8c9e056ed
        $token = getJson($url);
        $_SESSION['access_token'] = $token["access_token"];
        return 1;
    }
}

function getOpenid() {
    $wechat = C('WECHAT_SDK');
    $code = $_GET["code"];
    $lifeTime = 24 * 3600;
    session_set_cookie_params($lifeTime);
    session_start();
    if(isset($_SESSION['openid']) && $_SESSION['openid']) {
        return 0;
    }else {
        //第二步:取得openid
        $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$wechat['appid']}&secret={$wechat['secret']}&code=$code&grant_type=authorization_code";
        $oauth2 = getJson($oauth2Url);
        var_dump($oauth2);
        $_SESSION['openid'] = $oauth2['openid'];
        return 1;
    }
}
//创建json格式
function json($code,$msg="",$count,$data=array()){
    $result=array(
        'code'=>$code,
        'msg'=>$msg,
        'count'=>$count,
        'data'=>$data
    );
    //输出json
    echo json_encode($result);
    exit;
}

function getJson($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}

//创建json格式
function json2($data){
    //输出json
    echo json_encode($data);
    exit;
}
//导出excel
function exportExcel($expTitle,$expCellName,$expTableData){
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);
    vendor("PHPExcel.PHPExcel");

    $objPHPExcel = new \PHPExcel();
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
    for($i=0;$i<$cellNum;$i++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
    }
    // Miscellaneous glyphs, UTF-8
    for($i=0;$i<$dataNum;$i++){
        for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
        }
    }

    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}