<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <!--<link rel="stylesheet" type="text/css" href="/Application/Home/Common/css/index.css">-->
    <link rel="stylesheet" type="text/css" href="/Application/Home/Public/css/personalMessage.css">
    <title>订单详情页面</title>
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
        <a href="/Home/index/toPersonalMessage">个人中心</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="/Home/index/toAlertPassword">修改密码</a></dd>
            <dd><a href="/Home/index/toPersonalMessage" class="layui-this">个人信息</a></dd>
            <dd><a href="/Home/index/toPersonalOrderManage">个人订单管理</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item">
        <a href=""><img src="/<?php echo ($data[0][head_path]); ?>" class="layui-nav-img">我</a>
        <dl class="layui-nav-child">
            <dd><a href="/Home/Index/toAlertPassword">修改密码</a></dd>
            <dd><a href="javascript:;">安全管理</a></dd>
            <dd><a href="/Home/Index/loginOff" id="loginOff">退出</a></dd>
        </dl>
    </li>
</ul>

<div class="all">
    <form class="layui-form" enctype="multipart/form-data" action="" id="upload_form">
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" name="number" required  lay-verify="required" autocomplete="off"  class="layui-input" value="<?php echo ($data[0][mobile_number]); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-inline">
                <input type="text" name="out_destination" required lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo ($data[0][name]); ?>" disabled>
            </div>
        </div>

        <div class="profilePhoto">
            <div class="layui-form-item toInline">
                <label class="layui-form-label">头像</label>
                <img src="/<?php echo ($data[0][head_path]); ?>" class="layui-img">
                <input id="file" type="file" name="profilePhoto"/>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">上传头像</button>
                </div>
            </div>
        </div>

    </form>
</div>

<script src="/Public/jquery-3.3.1.min.js"></script>
<script src="/Public/layui/layui.js"></script>
<script src="/Public/jquery.cookie.js"></script>
<script src="/Application/Home/Common/common.js"></script>
<script src="/Application/Home/Public/js/personalMessage.js"></script>
</body>
</html>