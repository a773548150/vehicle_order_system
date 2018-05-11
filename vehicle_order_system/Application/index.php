<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 8:53
 */

header("content-type:text/html;charset=utf-8");

//设置系统的模式
define('APP_DEBUG',true);   //开发
//define('APP_DEBUG',false);   //生产


//引入框架的核心程序
//引入接口文件
include "../ThinkPHP/ThinkPHP.php";