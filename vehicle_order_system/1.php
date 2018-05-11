<?php

/**

 * 作者：smalle

 * 网址：http://blog.csdn.net/oldinaction

 * 微信公众号：smallelife

 */



//定义 TOKEN(要与开发者中心配置的TOKEN一致)

define("TOKEN", "hiaocong");

//实例化对象

$wechatObj = new wechatCallbackapiTest();

//调用函数

if (isset($_GET['echostr'])) {

    $wechatObj->valid();

}else{

    $wechatObj->responseMsg();

}



class wechatCallbackapiTest

{

    public function valid()

    {

        $echoStr = $_GET["echostr"];



        if($this->checkSignature()){

            echo $echoStr;

            exit;

        }

    }



    public function responseMsg()

    {

        $param['access_token'] = '';

        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){

            libxml_disable_entity_loader(true);//安全防护

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

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

            if(!empty( $keyword ) && $keyword == "你好")

            {

                $msgType = "text";

                //用户给公众号发消息后，公众号被动(自动)回复的消息内容

                $time = date('Y-m-d H:i',time());

                //$contentStr = "您的微信openid是:".$fromUsername;

                $contentStr = "你好！！";

                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                echo $resultStr;

            }else{

                echo "Input something...";

            }

        }else {

            echo "";

            exit;

        }

    }



    private function checkSignature()

    {

        if (!defined("TOKEN")) {

            throw new Exception('TOKEN is not defined!');

        }



        $signature = $_GET["signature"];

        $timestamp = $_GET["timestamp"];

        $nonce = $_GET["nonce"];

        $token = TOKEN;

        $tmpArr = array($token, $timestamp, $nonce);

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode( $tmpArr );

        $tmpStr = sha1( $tmpStr );



        if( $tmpStr == $signature ){

            return true;

        }else{

            return false;

        }

    }

}



?>