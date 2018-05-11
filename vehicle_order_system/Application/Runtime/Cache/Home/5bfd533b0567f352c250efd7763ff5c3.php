<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
    <!--<link rel="stylesheet" type="text/css" href="/Application/Home/Common/css/index.css">-->
    <link rel="stylesheet" type="text/css" href="/Application/Home/Public/css/personalOrderManage.css">
    <title>公共订单页面</title>
</head>
<body>
<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="/Home/index/toPublicOrder">公共订单</a></li>
    <li class="layui-nav-item layui-this">
        <a href="/Home/index/toPersonalOrder">个人订单</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="/Home/index/toPersonalUnTakingOrder">接订单</a></dd>
            <dd><a href="/Home/index/toPersonalOrderManage" class="layui-this">订单管理</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item">
        <a href="/Home/index/toPersonalMessage">个人中心</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="/Home/index/toAlertPassword">修改密码</a></dd>
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

<form class="layui-form" action="" method="post" id="timeForm">
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

    <div class="layui-form-item toInline">
        <div class="layui-input-inline">
            <button class="layui-btn" lay-submit lay-filter="timeSelect">搜索</button>
        </div>
    </div>
</form>


<div class="unFinishAll">
    <h2>已接</h2>
    <?php if(is_array($personalUnFinishData)): foreach($personalUnFinishData as $key=>$vo): ?><div class="tableAll" id="<?php echo ($key); ?>" >
            <table class="layui-table unFinish">
                <colgroup>
                    <col width="100">
                    <col width="200">
                    <col>
                </colgroup>
                <?php if(is_array($vo)): foreach($vo as $key=>$vi): ?><tr>
                        <?php switch($key): case "number": ?><th>订单号</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "out_destination": ?><th>目的地</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "goods_name": ?><th>商品</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "goods_quantity": ?><th>数量</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "start_time": ?><th>出发时间</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "license_plate": ?><th>车牌号</th><td><?php echo ($vi); ?></td><?php break; endswitch;?>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div><?php endforeach; endif; ?>
</div>

<div class="finishAll">
    <h2>已完成</h2>
    <?php if(is_array($personalFinishData)): foreach($personalFinishData as $key=>$vo): ?><div class="tableAll" id="<?php echo ($key); ?>">
            <table class="layui-table unFinish">
                <colgroup>
                    <col width="100">
                    <col width="200">
                    <col>
                </colgroup>
                <?php if(is_array($vo)): foreach($vo as $key=>$vi): ?><tr>
                        <?php switch($key): case "number": ?><th>订单号</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "out_destination": ?><th>目的地</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "goods_name": ?><th>商品</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "goods_quantity": ?><th>数量</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "start_time": ?><th>出发时间</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "license_plate": ?><th>车牌号</th><td><?php echo ($vi); ?></td><?php break;?>
                            <?php case "real_quantity": ?><th>商品实际数量</th><td><?php echo ($vi); ?></td><?php break; endswitch;?>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div><?php endforeach; endif; ?>
</div>
<script src="/Public/jquery-3.3.1.min.js"></script>
<script src="/Public/layui/layui.js"></script>
<script src="/Public/jquery.cookie.js"></script>
<script src="/Application/Home/Common/common.js"></script>
<script src="/Application/Home/Public/js/personalOrderManage.js"></script>
</body>
</html>