<?php
namespace Home\Controller;
class IndexController extends BaseController {
    public function index() {
        $nonce = $_GET['nonce'];
        $token = "linxiaocong";
        $timestamp = $_GET['timestamp'];
        $echostr = $_GET['echostr'];
        $signature = $_GET['signature'];
        $array = array($nonce, $timestamp, $token);
        sort($array);
        $str = sha1(implode($array));
        if($str == $signature && $echostr){
            echo $echostr;
            exit;
        }
        else {
            $this->responseMsg();
        }

    }
    //跳转到登录页面
    public function toLogin() {
        $this->display("/login");
    }

    public function getUserInfo() {
        $wechat = C('WECHAT_SDK');
        $code = $_GET["code"];
//var_dump($code);die;

//第一步:取全局access_token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wechat['appid']}&secret={$wechat['secret']}";
//https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxddbec552bd3c87d4&secret=a29f03616a31ebd7b23d28e8c9e056ed
        $token = $this->getJson($url);
//var_dump($token);die;
//第二步:取得openid
        $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$wechat['appid']}&secret={$wechat['secret']}&code=$code&grant_type=authorization_code";
        $oauth2 = $this->getJson($oauth2Url);



//第三步:根据全局access_token和openid查询用户信息
        $access_token = $token["access_token"];
        $openid = $oauth2['openid'];
        $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userinfo = $this->getJson($get_user_info_url);

//打印用户信息

        $m = M("wechat");
        $select = $m->where(array("openid"=>$userinfo["openid"]))->getField("id");
//        var_dump($select);die;
        if($select) {
            $m->where(array("openid" => $userinfo["openid"]))->save($userinfo);
//            echo "更新数据成功";
        } else {
            $result = $m->data($userinfo)->add();
//            if($result){
//                echo "插入数据成功";
//            }
        }
        $this->display("/index");
    }

    public function getJson($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    public function responseMsg()
    {

        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        //extract post data
        if (!empty($postStr)){
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>  
                        <ToUserName><![CDATA[%s]]></ToUserName>  
                        <FromUserName><![CDATA[%s]]></FromUserName>  
                        <CreateTime>%s</CreateTime>  
                        <MsgType><![CDATA[%s]]></MsgType>  
                        <Content><![CDATA[%s]]></Content>  
                        <FuncFlag>0</FuncFlag>  
                        </xml>";
            if(!empty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "http://yijiangbangtest.wsandos.com/linxiaocong";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }
        }else {
            echo "";
            $wechat = C('WECHAT_SDK');
            $redirect_uri = urlencode('http://yijiangbangtest.wsandos.com/linxiaocong/home/index/getUserInfo');
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$wechat['appid']}&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
            header("Location:".$url);
            exit;
        }

        if(strtolower($postObj->MsgType) == 'event') {
            if(strtolower($postObj->Event == 'subscribe')) {
                $toUser = $postObj->FromUserName;
                $fromUser = $postObj->ToUserName;
                $time = time();
                $msgType = 'text';
                $content = '欢迎关注我们的微信公众账号'.$postObj->FromUserName;
                $template = "<xml>  
                        <ToUserName><![CDATA[%s]]></ToUserName>  
                        <FromUserName><![CDATA[%s]]></FromUserName>  
                        <CreateTime>%s</CreateTime>  
                        <MsgType><![CDATA[%s]]></MsgType>  
                        <Content><![CDATA[%s]]></Content>  
                        <FuncFlag>0</FuncFlag>  
                        </xml>";
                $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                echo $info;
            }
        }
    }
//    public function isStop() {
//        $m = M("order");
//        $result = $m->getField("stop");
//        if($result == 1){
//            return false;
//        } else {
//            return true;
//        }
//    }

    public function toAbout() {
        $this->display("/about");
    }

    public function toContact() {
        $this->display("/contact");
    }

    public function toEidtmy() {
        $this->display("/eidtmy");
    }

    public function toIndex() {
        $this->display("/index");
    }

    public function toMy() {
        $this->display("/my");
    }

    public function toOrder() {
        $this->display("/order");
    }
    public function toYyjl() {
        $this->display("/yyjl");
    }
}