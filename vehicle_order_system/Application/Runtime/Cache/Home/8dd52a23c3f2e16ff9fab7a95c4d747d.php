<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Application/Home/Public/css/alertPassword.css">
    <title>修改密码</title>
</head>
<body>
<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="/Home/index/toPublicOrder">公共订单</a></li>
    <li class="layui-nav-item">
        <a href="/Home/index/toPersonalOrder">个人订单</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="/Home/index/toPersonalUnTakingOrder">接订单</a></dd>
            <dd><a href="/Home/index/toPersonalOrderManage">订单管理</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item layui-this">
        <a href="/Home/index/toPersonalOrder">个人中心</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="/Home/index/toAlertPassword" class="layui-this">修改密码</a></dd>
            <dd><a href="/Home/index/toPersonalMessage">个人信息</a></dd>
            <dd><a href="/Home/index/toPersonalOrderManage">个人订单管理</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item">
        <a href=""><img src="#" class="layui-nav-img">我</a>
        <dl class="layui-nav-child">
            <dd><a href="/Home/Index/toAlertPassword">修改密码</a></dd>
            <dd><a href="javascript:;">安全管理</a></dd>
            <dd><a href="/Home/Index/loginOff" id="loginOff">退出</a></dd>
        </dl>
    </li>
</ul>

<form class="layui-form" action="alertPassword" method="post" id="all">
    <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-inline">
            <input type="text" name="mobile_number" id="mobile_number" required lay-verify="required" disabled autocomplete="off" class="layui-input">
        </div>
        <!--<div class="layui-form-mid layui-word-aux">辅助文字</div>-->
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">旧密码</label>
        <div class="layui-input-inline">
            <input type="password" name="oldPassword" id="oldPassword" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input"  maxlength="15">
        </div>
        <!--<div class="layui-form-mid layui-word-aux">辅助文字</div>-->
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">新密码</label>
        <div class="layui-input-inline">
            <input type="password" name="newPassword" id="newPassword" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input inputNewPssword"  maxlength="15">
            <!--<input type="text" class="layui-input inputNewPsswordHide" maxlength="20" id="" name="newPassword" placeholder="Password" />-->
        </div>
        <!--<i class="layui-icon" style="font-size: 20px;" id="eye">&#xe60f;</i>-->
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">再输入密码</label>
        <div class="layui-input-inline">
            <input type="password" name="newPassword2" id="newPassword2" required lay-verify="required" placeholder="请再输入密码" autocomplete="off" class="layui-input inputNewPssword"  maxlength="15">
            <!--<input type="text" class="layui-input inputNewPsswordHide" maxlength="20" id="" name="newPassword" placeholder="Password" />-->
        </div>
        <!--<i class="layui-icon" style="font-size: 20px;" id="eye">&#xe60f;</i>-->
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script src="/Public/layui/layui.all.js"></script>
<script src="/Public/jquery-3.3.1.min.js"></script>
<script src="/Public/jquery.cookie.js"></script>
<script src="/Application/Home/Common/common.js"></script>
<script src="/Application/Home/Public/js/alertPassword.js"></script>
</body>
</html>