<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>预约记录</title>
	<script type="text/javascript" src="/linxiaocong/Application/Home/View/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="/linxiaocong/Application/Home/View/css/yuyuejilu.css">


	<link rel="stylesheet" type="text/css" href="/linxiaocong/Application/Home/View/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="/linxiaocong/Application/Home/View/css/weui.min.css">

</head>
<body>
	<div id="main">
		<div v-for="item in message">
			<div class="line">
				<div class="lineTop">
					<span class="time">{{ item.create_time }}</span>
					<span class="statu" v-bind:class="{ing: item.isIng, cqdz: item.isCq, finish: item.isFinish }">{{ item.order_status }}</span>

				</div>
				<div class="lineCon">
					<span class="lineCon-left">油品类型</span>
					<span class="lineCon-right">{{ item.type }}</span>
				</div>
				<div class="lineCon">
					<span class="lineCon-left">车牌号码</span>
					<span class="lineCon-right">{{ item.license_plate }}</span>
				</div>
				<div class="lineCon">
					<span class="lineCon-left">公司名称</span>
					<span class="lineCon-right">{{ item.company }}</span>
				</div>
				<div class="lineCon">
					<span class="lineCon-left">真实姓名</span>
					<span class="lineCon-right">{{ item.name }}</span>
				</div>
				<div class="lineCon">
					<span class="lineCon-left">联系电话</span>
					<span class="lineCon-right">{{ item.mobile_number }}</span>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="/linxiaocong/Application/Home/View/js/vue.min.js"></script>
<script src="/linxiaocong/Application/Home/View/js/jquery.min weui.js"></script>
<script src="/linxiaocong/Application/Home/View/js/jquery-weui.min.js"></script>
<script type="text/javascript" src="/linxiaocong/Application/Home/View/js/yyjl.js"></script>

</html>