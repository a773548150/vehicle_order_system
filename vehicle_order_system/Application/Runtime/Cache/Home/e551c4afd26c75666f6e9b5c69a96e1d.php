<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>关于我们</title>
	<script type="text/javascript" src="/Application/Home/View/js/flexible.js"></script>
	<script type="text/javascript" src="/Application/Home/View/js/jquery.min weui.js"></script>
	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/about.css">


	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="/Application/Home/View/css/weui.min.css">

</head>
<body>
	<img src="/Application/Home/View/images/ab.jpg" class="ab">
	<div class="topTxt">
		<p>关于美誉</p>
		<p class="today">今天是<span class="time"></span></p>
	</div>
	<div class="Con">
		<p>美誉化工装车排队系统,他是针对我司汽油装车管理,以及装车状态管理,研发的新一代管理系统。</p>
		<p>本系统通过信息化手段，将汽油装车的状态和车辆排队进出厂管理有机的结合起来，并通过综合信息发布平台和自动呼叫系统引导车辆到指定位置进行装车。</p>
		<p>以此杜绝车辆在厂区内乱停乱放，减少安全隐患，提高汽油装车管理效率。</p>
	</div>

</body>
<script type="text/javascript">
		$(function(){
			var myDate = new Date();//获取系统当前时间
			var str = myDate.getFullYear()+"年"+(myDate.getMonth()+1)+"月"+myDate.getDate()+"日";
			$('.time').html(str)
		})

</script>
</html>