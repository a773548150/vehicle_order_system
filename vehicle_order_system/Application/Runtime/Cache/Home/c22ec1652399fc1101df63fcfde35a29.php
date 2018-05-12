<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>个人中心</title>
	<script type="text/javascript" src="/Application/Home/View/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/myCenter.css">


	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="/Application/Home/View/css/weui.min.css">

</head>
<body>
	<div id="main">
		<div class="top">
			<div class="userInfo">
				<img src="/Application/Home/View/images/head.png">
				<span>测试者</span>
			</div>
			<a href="/home/index/toYyjl" class="l weui-cell__bd">我的预约记录</a>
		</div>
		<div class="carInfo">
			<span class="num numIng" v-if="statu == 1">1</span>
				<span class="chepai">粤AE86</span>
			<span class="statu ing">正在装</span>

		</div>

		<div class="myIfo">
		<a href="/home/index/eidtmy.html" class="l m weui-cell__bd">
				<span>我的信息</span>
				<span>去编辑</span>
			</a>
			<div class="line">
				<div class="line-left">
					<span>真实姓名</span>
					<p>测试者</p>
				</div>
				<div class="line-right">
					<span>联系电话</span>
					<p>181026632132</p>
				</div>
			</div>
			<div class="line">
				<div class="line-left">
					<span>车牌号</span>
					<p>粤AE86</p>
				</div>
				<div class="line-right">
					<span>公司名称</span>
					<p>测试公司</p>
				</div>
			</div>
		</div>

		<div class="contact">

			<a href="/home/index/toContact" class="weui-cell__bd">联系我们</a>
			<a href="/home/index/toAbout" class="weui-cell__bd">关于我们</a>

		</div>

		<div id="footer">
				<a href="/home/index/toIndex" >
					<img src="/Application/Home/View/images/paiduichaxun.png" alt="">
					<p>排队查询</p>
				</a>
				<a href="/home/index/toOrder">
					<img src="/Application/Home/View/images/yuyue.png" alt="">
					<p>预约装车</p>
				</a>
				<a href="/home/index/toMy" class="on">
					<img src="/Application/Home/View/images/gerenzhongxin2.png" alt="">
					<p>个人中心</p>
				</a>
			</div>

	</div>
</body>
	<script type="text/javascript" src="/Application/Home/View/js/vue.min.js"></script>
	<script src="/Application/Home/View/js/jquery.min weui.js"></script>
    <script src="/Application/Home/View/js/jquery-weui.min.js"></script>

</html>