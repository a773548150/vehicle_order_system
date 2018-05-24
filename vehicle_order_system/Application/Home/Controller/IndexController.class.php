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
            AccessToPermissions("toIndex");
            //exit;
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

    public function getUserInfo() {
        $toUrl = I("get.url");

        getAccessToken();
        getOpenid();
        session_start();
//第三步:根据全局access_token和openid查询用户信息
        $access_token = $_SESSION['access_token'];
        $openid = $_SESSION['openid'];
        $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userinfo = getJson($get_user_info_url);

//打印用户信息
        $m = M("wechat");
        $D = M("driver");
        $select = $m->where(array("openid"=>$userinfo["openid"]))->getField("id");

        if($select && $select != null ) {
            $userinfo["create_time"] = date("Y-m-d h:i:s");
            $m->where(array("openid" => $userinfo["openid"]))->save($userinfo);
//            echo "更新数据成功";
            //exit;
        } else {
            $userinfo["update_time"] = date("Y-m-d h:i:s");
            $result = $m->data($userinfo)->add();
            if($result) {
                $data["wechat_id"] = $result;
                $nowTime = date("Ymdhis");
                $sixRand = rand('100000', '999999');
                $data["number"] = $nowTime.$sixRand;
                $data["name"] = "请编辑您的真实姓名";
                $data["mobile_number"] = "请编辑您的手机号";
                $data["company"] = "请您所属公司";
                $data['create_time'] = date("Y-m-d h:i:s");
                $result1 = $D->data($data)->add();
            }
            //exit;
        }
        //$this->display("/index");

        $this->redirect("$toUrl");
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

    public function toYyjlTest(){
        $this->display("/yyjl");
    }
    public function toYyjl() {
        AccessToPermissions("toYyjlTest");
    }
}