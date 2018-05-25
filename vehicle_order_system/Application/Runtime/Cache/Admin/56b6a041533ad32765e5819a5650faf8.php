<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Common/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Public/css/orderManager.css">
    <title>订单管理页面</title>
</head>
<body>
<ul class="layui-nav layui-nav-tree layui-nav-side" lay-filter="test">
    <li class="layui-nav-item">
        <a href="<?php echo U('index');?>">主页</a>
    </li>

    <?php if(in_array(($permissions[0][manage_driver]), explode(',',"1"))): ?><li class="layui-nav-item" >
            <a href="javascript:;">司机管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toDriverManage');?>">司机信息管理</a></dd>
            </dl>
        </li><?php endif; ?>

    <?php if(in_array(($permissions[0][manage_oil]), explode(',',"1"))): ?><li class="layui-nav-item" >
            <a href="javascript:;">油品管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toOilManage');?>">油品类型管理</a></dd>
            </dl>
        </li><?php endif; ?>


    <?php if(in_array(($permissions[0][manage_order]), explode(',',"1"))): ?><li class="layui-nav-item" >
            <a href="javascript:;">车队列表管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toOrderManage');?>">排队管理</a></dd>
            </dl>
        </li><?php endif; ?>


    <?php if(in_array(($permissions[0][manage_data]), explode(',',"1"))): ?><li class="layui-nav-item">
            <a href="javascript:;">数据信息</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toDataManage');?>">数据管理</a></dd>
            </dl>
        </li><?php endif; ?>

    <?php if(in_array(($permissions[0][manage_notice]), explode(',',"1"))): ?><li class="layui-nav-item layui-nav-itemed">
            <a href="javascript:;">公告内容信息</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toNoticeManage');?>" class="layui-this">公告内容管理</a></dd>
            </dl>
        </li><?php endif; ?>

    <?php if(in_array(($permissions[0][manage_role]), explode(',',"1"))): ?><li class="layui-nav-item">
            <a href="javascript:;">角色权限</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toRole');?>">权限管理</a></dd>
                <dd><a href="<?php echo U('toUser');?>">后台用户管理</a></dd>
            </dl>
        </li><?php endif; ?>

    <?php if(in_array(($permissions[0][manage_log]), explode(',',"1"))): ?><li class="layui-nav-item">
            <a href="javascript:;">操作日记</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toLogManage');?>">日记管理</a></dd>
            </dl>
        </li><?php endif; ?>
</ul>

<div class="allContent">
    <form class="layui-form" action="">

        <div class="layui-form-item toInline">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-inline">
                <input type="text" name="title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item  toInline">
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit lay-filter="formSearch" id="search">搜索</button>
            </div>
        </div>
    </form>

    <form class="layui-form" action="" method="post" id="addNotice">
        <div class="layui-form-item toInline ">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required lay-verify="required" autocomplete="off" class="layui-input" >
            </div>
        </div>

        <!--<div class="layui-form-item toInline">-->
            <!--<label class="layui-form-label">内容</label>-->
            <!--<div class="layui-input-block">-->
                <!--<input type="text" name="content" required lay-verify="required" autocomplete="off" class="layui-input" >-->
            <!--</div>-->
        <!--</div>-->
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item toInline">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">新增</button>
                <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
            </div>
        </div>
    </form>
    <table id="order" lay-filter="test"></table>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
</div>

<script src="/Public/layui/layui.js"></script>
<script src="/Public/jquery-3.3.1.min.js"></script>
<script src="/Application/Admin/Public/js/noticeManage.js"></script>
</body>
</html>