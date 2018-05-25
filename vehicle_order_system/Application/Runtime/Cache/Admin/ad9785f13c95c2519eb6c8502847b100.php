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


    <?php if(in_array(($permissions[0][manage_data]), explode(',',"1"))): ?><li class="layui-nav-item layui-nav-itemed">
            <a href="javascript:;">数据信息</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toDataManage');?>" class="layui-this">数据管理</a></dd>
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
            <label class="layui-form-label">类型</label>
            <div class="layui-input-inline">
                <select name="orderStatus" lay-verify="required" lay-filter="selectStatus" >
                    <option value="3" id="orderStauts">全部</option>
                    <option value="0" id="orderStauts0">已接</option>
                    <option value="1" id="orderStauts1">装车中</option>
                    <option value="2" id="orderStauts2">厂区内待装</option>
                    <option value="2" id="orderStauts3">厂外待装</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item toInline">
            <label class="layui-form-label">单号</label>
            <div class="layui-input-inline">
                <input type="text" name="number"  placeholder="请输入单号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item toInline">
            <label class="layui-form-label">时间</label>
            <div class="layui-input-inline">
                <input type="text" name="startTime" class="layui-input" id="time1">
            </div>
            <div class="layui-form-mid layui-word-aux"> ~ </div>
        </div>
        <div class="layui-form-item toInline">
            <div class="layui-input-inline">
                <input type="text" name="endTime" class="layui-input" id="time2">
            </div>
            <!--<button class="layui-btn" id="addGoods">添加</button>-->
        </div>
        <div class="layui-form-item  toInline">
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit lay-filter="formSearch" id="search">搜索</button>
            </div>
        </div>
        <div class="layui-form-item outExcel">
            <div class="layui-input-inline">
                <a href="javascript:;" id="excel" class="layui-btn layui-btn-normal toInline excel">导出excel</a>
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
<script src="/Application/Admin/Public/js/dataManage.js"></script>
</body>
</html>