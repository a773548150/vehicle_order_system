<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>预约装车</title>
	<script type="text/javascript" src="/Application/Home/View/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/yuyuezhuangche.css">


	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="/Application/Home/View/css/weui.min.css">

</head>
<style>
	.weui-mask.weui-mask--visible{
		opacity: 0.2;
	}
</style>
<body>
		<div id="main">
			<div class="con">
				<div class="line">
					<div class="null">
						<span class="yuan"></span>
					</div>

					<span class="Txt">真实姓名</span>
					<input type="text" class="weui-input" placeholder="请输入真实姓名" v-model="name">
				</div>
				<div class="line">
					<div class="null">
					</div>
					<span class="Txt">联系电话</span>
					<input type="tel" class="weui-input" placeholder="请输入联系电话" v-model="mobile_number">
				</div>

			</div>
			<div class="con">
				<div class="line ">
					<div class="null">
						<span class="yuan"></span>
					</div>
					<span class="Txt">油品类型</span>
					<div class="selLine weui-cell__bd">
						<select class="weui-select" @change="selectVal" >
							<option v-for="item in selects">{{ item.value }}</option>
						</select>
					</div>
					<div class="selLine weui-cell__bd">
						<select  class="weui-select weui-cell__bd" @change="selectOilName">
							<!--<option disabled="disabled">请选择类型</option>-->
							<option v-for="item in oilName">{{ item }}</option>
						</select>
					</div>
				</div>
				<!-- <div class="line weui-cell__bd">
					<div class="null">
					</div>
					<span class="Txt">预约时间</span>
					<input type="date" class="weui-input" placeholder="请输入联系电话" v-model="time">
				</div> -->
				<div class="line">
					<div class="null">
					</div>
					<span class="Txt">车牌号</span>
					<div class="lineC-left">
						<div v-if="chepai == ''">
							<span class="pz" >粤</span>
						</div>
						<div >
							<span class="pz" >A</span>
						</div>
							<input type="text" class="weui-input" placeholder="请输入车牌号" v-model="license_plate" maxlength="5" required>
					</div>
				</div>
				<div class="line">
					<div class="null">
					</div>
					<span class="Txt">公司名称</span>
					<input type="text" class="weui-input" placeholder="请输入公司名称" v-model="company" maxlength="20" required>
				</div>
			</div>
			<div class="subBtn" v-on:click="submit">提交预约</div>
			<!-- <div class="boTxt" >
				<div class="gou">
					<span class="icon-ok"></span>

				</div>
				<p>您已提交预约信息，可在“排队查询”查看</p>
			</div> -->
				<div id="footer">
				<a href="<?php echo U('toIndex');?>" >
					<img src="/Application/Home/View/images/paiduichaxun.png" alt="">
					<p>排队查询</p>
				</a>
				<a href="<?php echo U('toOrder');?>" class="on">
					<img src="/Application/Home/View/images/yuyue2.png" alt="">
					<p>预约装车</p>
				</a>
				<a href="<?php echo U('toMy');?>">
					<img src="/Application/Home/View/images/gerenzhongxin.png" alt="">
					<p>个人中心</p>
				</a>
			</div>
			<!-- <div class="pzCon" :style="{display:pzConDp}">
				<div class="pzCon-txt">
					<span >{{item}}</span>
					<p class="okBtn" @click="pzOk">
						完成
					</p>
				</div>
			</div> -->


		</div>
</body>
	<script type="text/javascript" src="/Application/Home/View/js/vue.js"></script>
	<script src="/Application/Home/View/js/jquery.min weui.js"></script>
    <script src="/Application/Home/View/js/jquery-weui.min.js"></script>
    <script src="/Application/Home/View/js/order.js"></script>
</html>