<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Public/css/index.css">
    <title>首页</title>
</head>
<body>
    <ul class="layui-nav layui-nav-tree layui-nav-side" lay-filter="test">
        <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
        <li class="layui-nav-item layui-this">
            <a href="/Admin/Index/index">主页</a>
        </li>

        <?php if(in_array(($permissions[0][manage_driver]), explode(',',"1"))): ?><li class="layui-nav-item" >
                <a href="javascript:;">司机管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toDriverManage">司机信息管理</a></dd>
                </dl>
            </li><?php endif; ?>

        <?php if(in_array(($permissions[0][manage_oil]), explode(',',"1"))): ?><li class="layui-nav-item" >
                <a href="javascript:;">油品管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toOilManage">油品类型管理</a></dd>
                </dl>
            </li><?php endif; ?>


        <?php if(in_array(($permissions[0][manage_order]), explode(',',"1"))): ?><li class="layui-nav-item" >
                <a href="javascript:;">车队列表管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toOrder">添加车辆</a></dd>
                    <dd><a href="/Admin/Index/toOrderManage">排队管理</a></dd>
                </dl>
            </li><?php endif; ?>

        <?php if(in_array(($permissions[0][manage_data]), explode(',',"1"))): ?><li class="layui-nav-item">
                <a href="javascript:;">数据信息</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toDataManage">数据管理</a></dd>
                </dl>
            </li><?php endif; ?>

        <?php if(in_array(($permissions[0][manage_notice]), explode(',',"1"))): ?><li class="layui-nav-item">
                <a href="javascript:;">公告内容信息</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toNoticeManage">公告内容管理</a></dd>
                </dl>
            </li><?php endif; ?>

        <?php if(in_array(($permissions[0][manage_role]), explode(',',"1"))): ?><li class="layui-nav-item">
                <a href="javascript:;">角色权限</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toRole">权限管理</a></dd>
                    <dd><a href="/Admin/Index/toUser">后台用户管理</a></dd>
                </dl>
            </li><?php endif; ?>

        <?php if(in_array(($permissions[0][manage_log]), explode(',',"1"))): ?><li class="layui-nav-item">
                <a href="javascript:;">操作日记</a>
                <dl class="layui-nav-child">
                    <dd><a href="/Admin/Index/toLogManage">日记管理</a></dd>
                </dl>
            </li><?php endif; ?>
    </ul>
    <h2>欢迎使用后台管理</h2>

    <a href="/Admin/Index/toAlertPassword" class="layui-btn" id="alert-password">修改密码</a>
    <a href="#" class="layui-btn" id="loginOff">退出登录</a>
    <script src="/Public/layui/layui.all.js"></script>
    <script src="/Public/jquery-3.3.1.min.js"></script>
    <script src="/Public/jquery.cookie.js"></script>
    <script src="/Application/Admin/Public/js/index.js"></script>

</body>
</html>