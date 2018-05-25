<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Common/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Public/css/driverManage.css">
    <title>订单管理页面</title>
</head>
<body>
<ul class="layui-nav layui-nav-tree layui-nav-side" lay-filter="test">
    <li class="layui-nav-item">
        <a href="<?php echo U('index');?>">主页</a>
    </li>
    <?php if(in_array(($permissions[0][manage_driver]), explode(',',"1"))): ?><li class="layui-nav-item layui-nav-itemed" >
            <a href="javascript:;">司机管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('toDriverManage');?>" class="layui-this">司机信息管理</a></dd>
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
            <label class="layui-form-label">手机号码</label>
            <div class="layui-input-inline">
                <input type="text" name="number"  placeholder="请输入手机号码" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item  toInline">
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit lay-filter="formSearch" id="search">搜索</button>
            </div>
        </div>
    </form>

    <!--<table id="order" lay-filter="order" class="layui-table">-->
        <!--<colgroup>-->
            <!--<col>-->
            <!--<col>-->
            <!--<col>-->
        <!--</colgroup>-->
        <!--<thead>-->
            <!--<tr>-->
                <!--<th>订单号</th>-->
                <!--<th>出发时间</th>-->
                <!--<th>出车车牌号</th>-->
                <!--<th>目的地</th>-->
                <!--<th>状态</th>-->
                <!--<th>司机编号</th>-->
                <!--<th>提货单号</th>-->
                <!--<th>合同号</th>-->
                <!--<th>缺货信息</th>-->
                <!--<th>提货数量</th>-->
                <!--<th>提货时间</th>-->
                <!--<th>结算单位</th>-->
            <!--</tr>-->
        <!--</thead>-->
        <!--<tbody>-->

            <!--<?php if(is_array($orderMessage)): foreach($orderMessage as $key=>$vo): ?>-->
                <!--<tr>-->
                    <!--<td><?php echo ($vo["number"]); ?></td>-->
                    <!--<td><?php echo ($vo["create_time"]); ?></td>-->
                    <!--<td><?php echo ($vo["out_number"]); ?></td>-->
                    <!--<td><?php echo ($vo["out_destination"]); ?></td>-->
                    <!--<td><?php echo ($vo["mission_status"]); ?></td>-->
                    <!--<td><?php echo ($vo["order_driver_number"]); ?></td>-->
                    <!--<td><?php echo ($vo["pick_up_order"]); ?></td>-->
                    <!--<td><?php echo ($vo["contract_number"]); ?></td>-->
                    <!--<td><?php echo ($vo["out_of_stock_message"]); ?></td>-->
                    <!--<td><?php echo ($vo["pick_up_quantity"]); ?></td>-->
                    <!--<td><?php echo ($vo["pick_up_time"]); ?></td>-->
                    <!--<td><?php echo ($vo["closing_unit"]); ?></td>-->
                <!--</tr>-->
            <!--<?php endforeach; endif; ?>-->

        <!--</tbody>-->
    <!--</table>-->

    <!--<table class="layui-table" lay-data="{height:315, url:'/Admin/driver/searchDriver', page:true, id:'test'}" lay-filter="test">-->
        <!--<thead>-->
        <!--<tr>-->
            <!--<th lay-data="{field:'headimgurl', width:80, sort: true}" class="idsssssss">ID</th>-->
            <!--<th lay-data="{field:'nickname', width:80}">用户名</th>-->
            <!--<th lay-data="{field:'sex', width:80, sort: true}">性别</th>-->
            <!--<th lay-data="{field:'city'}">城市</th>-->
            <!--<th lay-data="{field:'sign'}">签名</th>-->
            <!--<th lay-data="{field:'experience', sort: true}">积分</th>-->
            <!--<th lay-data="{field:'score', sort: true}">评分</th>-->
            <!--<th lay-data="{field:'classify'}">职业</th>-->
            <!--<th lay-data="{field:'wealth', sort: true}">财富</th>-->
        <!--</tr>-->
        <!--</thead>-->
    <!--</table>-->
    <table id="order" lay-filter="test"></table>
</div>

<script src="/Public/layui/layui.js"></script>
<script src="/Public/jquery-3.3.1.min.js"></script>
<script src="/Application/Admin/Public/js/driverManage.js"></script>
</body>
</html>