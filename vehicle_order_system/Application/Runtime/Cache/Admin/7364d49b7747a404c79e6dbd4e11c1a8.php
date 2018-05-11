<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Public/css/order.css">
    <title>生成订单页面</title>
</head>
<body>
<ul class="layui-nav layui-nav-tree layui-nav-side" lay-filter="test">
    <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
    <li class="layui-nav-item">
        <a href="/Admin/Index/index">主页</a>
    </li>
    <?php if(in_array(($permissions[0][manage_order]), explode(',',"1"))): ?><li class="layui-nav-item layui-nav-itemed" >
            <a href="javascript:;">订单管理</a>
            <dl class="layui-nav-child">
                <dd><a href="/Admin/Index/toOrderManager">订单管理</a></dd>
                <dd><a href="/Admin/Index/toOrder" class="layui-this">新添订单</a></dd>
            </dl>
        </li><?php endif; ?>
    <?php if(in_array(($permissions[0][manage_driver]), explode(',',"1"))): ?><li class="layui-nav-item">
            <a href="javascript:;">司机信息</a>
            <dl class="layui-nav-child">
                <dd><a href="/Admin/Index/toDriver">司机管理</a></dd>
            </dl>
        </li><?php endif; ?>
    <?php if(in_array(($permissions[0][manage_vehicle]), explode(',',"1"))): ?><li class="layui-nav-item">
            <a href="javascript:;">车辆信息</a>
            <dl class="layui-nav-child">
                <dd><a href="/Admin/Index/toVehicle">车辆管理</a></dd>
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

<div class="allContent">
    <form class="layui-form" action="/Admin/Order/makeOrder" method="post">
        <!--<div class="layui-form-item">-->
            <!--<label class="layui-form-label">订单号</label>-->
            <!--<div class="layui-input-inline">-->
                <!--<input type="text" name="orderNumber" id="orderNumber" required  lay-verify="required" placeholder="请输入订单号" autocomplete="off" class="layui-input"  disabled>-->
            <!--</div>-->
            <!--<button class="layui-btn" id="makeNumber">生成</button>-->
        <!--</div>-->
        <div class="layui-form-item">
            <label class="layui-form-label">目的地</label>
            <div class="layui-input-inline">
                <input type="text" name="destination" id="destination" required lay-verify="required" placeholder="请输入目的地" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">精确到门牌号</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品</label>
            <div class="layui-input-inline">
                <input type="text" name="goodsName" id="goodsName" required  lay-verify="required" placeholder="请输入商品名" autocomplete="off" class="layui-input">
            </div>
            <!--<div class="layui-input-inline">-->
                <!--<select name="city" lay-verify="required" id="selectGoods">-->
                    <!--<?php if(is_array($goodsName)): foreach($goodsName as $key=>$vo): ?>-->
                        <!--<option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option>-->
                    <!--<?php endforeach; endif; ?>-->
                <!--</select>-->
            <!--</div>-->
            <!--<button class="layui-btn" id="addGoods">添加</button>-->
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">数量</label>
            <div class="layui-input-inline">
                <input type="number" name="number" id="number" required  lay-verify="required" placeholder="请输入数量" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">单位吨(t)</div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">出发时间</label>
            <div class="layui-input-block">
                <input type="text" name="startTime" class="layui-input" id="test1">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>


<script src="/Public/layui/layui.js"></script>
<script src="/Public/jquery-3.3.1.min.js"></script>
<script src="/Application/Admin/Public/js/order.js"></script>
</body>
</html>