<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>我的信息</title>
	<script type="text/javascript" src="/Application/Home/View/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/myInfo.css">


	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="/Application/Home/View/css/weui.min.css">

</head>
<body>
	<div id="main">
		<div class="con">
			<div class="line">
				<span>真实姓名</span>
				<input type="text"  class="weui-input"  v-bind:value="name" v-model="name">
			</div>
			<div class="line">
				<span>联系电话</span>
				<input type="tel"  class="weui-input"  v-bind:value="mobile_number" v-model="mobile_number">
			</div>
			<div class="line">
				<span>车牌号</span>
				<input type="text"  class="weui-input"  v-bind:value="license_plate" v-model="license_plate">
			</div>
			<div class="line">
				<span>公司名称</span>
				<input type="text"  class="weui-input"  v-bind:value="company" v-model="company">
			</div>
		</div>
		<div class="subBtn" v-on:click="submit">确定修改</div>
	</div>
</body>
	<script type="text/javascript" src="/Application/Home/View/js/vue.min.js"></script>
	<script src="/Application/Home/View/js/jquery.min weui.js"></script>
    <script src="/Application/Home/View/js/jquery-weui.min.js"></script>
    <script src="/Application/Home/View/js/editmy.js"></script>
</html>