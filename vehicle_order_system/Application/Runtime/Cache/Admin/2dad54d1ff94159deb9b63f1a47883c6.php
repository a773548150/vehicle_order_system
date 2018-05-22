<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/linxiaocong/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/linxiaocong/Application/Admin/Common/css/index.css">
    <link rel="stylesheet" type="text/css" href="/linxiaocong/Application/Admin/Public/css/user.css">
    <title>权限管理页面</title>
</head>
<body>
<ul class="layui-nav layui-nav-tree layui-nav-side" lay-filter="test">
    <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
    <li class="layui-nav-item">
        <a href="<?php echo U('index');?>">主页</a>
    </li>

    <?php if(in_array(($permissions[0][manage_driver]), explode(',',"1"))): ?><li class="layui-nav-item" >
            <a href="javascript:;">司机管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toDriverManage');?>">司机信息管理</a></dd>
            </dl>
        </li><?php endif; ?>

    <?php if(in_array(($permissions[0][manage_oil]), explode(',',"1"))): ?><li class="layui-nav-item layui-nav-itemed" >
            <a href="javascript:;">油品管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toOilManage');?>" class="layui-this">油品类型管理</a></dd>
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

    <?php if(in_array(($permissions[0][manage_notice]), explode(',',"1"))): ?><li class="layui-nav-item">
            <a href="javascript:;">公告内容信息</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toNoticeManage');?>">公告内容管理</a></dd>
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
            <label class="layui-form-label">编号</label>
            <div class="layui-input-inline">
                <input type="text" name="number"  placeholder="请输入油编号" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item  toInline">
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit lay-filter="formSearch" id="search">搜索</button>
            </div>
        </div>
    </form>

    <form class="layui-form" action="" method="post">

        <div class="layui-input-inline">
            <label class="layui-form-label">油类型</label>
            <div class="layui-input-block">
                <select name="oilType" lay-verify="required" id="addRoleNameSelect">
                    <option value="">点击选择油类型</option>
                    <option value="0">化工类</option>
                    <option value="1">油品类</option>
                    <option value="2">合成类</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item toInline">
            <label class="layui-form-label">油名</label>
            <div class="layui-input-block">
                <input type="text" name="name"  required lay-verify="required" autocomplete="off" class="layui-input" >
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
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
</div>

<script src="/linxiaocong/Public/layui/layui.js"></script>
<script src="/linxiaocong/Public/jquery-3.3.1.min.js"></script>
<script src="/linxiaocong/Application/Admin/Public/js/oilManage.js"></script>
</body>
</html>