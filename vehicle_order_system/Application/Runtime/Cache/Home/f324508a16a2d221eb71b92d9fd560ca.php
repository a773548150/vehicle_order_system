<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="refresh" content="60">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<title>车辆运货预约</title>
	<script type="text/javascript" src="/Application/Home/View/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/index.css">


	<link rel="stylesheet" type="text/css" href="/Application/Home/View/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="/Application/Home/View/css/weui.min.css">

</head>
<!-- <style>
	#top{
		height:6rem;
	}
</style> -->
<body>
		<div id="main">
			<div id="box" class="box" v-show="boxDp">
			    <div id="wrap" class="wrap">
			        <div id="start" class="start">
			            <span>告示：</span>请把微信姓名改成真实姓名
			        </div>
			    </div>
			</div>
			<div id="top">
				<img src="/Application/Home/View/images/banner.png" class="topImg">
				<p style="text-align: center;color: #333;height: 0.7rem;line-height: 0.7rem;font-size: .4rem; background-color: #fff;width: 90%;margin: 0 auto;padding: .1rem .2rem;">二甲苯装车排队情况</p>
				<div class="search">
					<div class="searchCon">
						<!-- <span class="sx" @click="sxBtn">筛选</span> -->
						<input type="text" placeholder="请输入你想搜索的内容" class="weui-input">
						<span class="icon-search"></span>
						<div class="refresh">
							<span class="icon-refresh"></span>
						</div>
					</div>
				</div>

				<div class="search" >
					<div class="searchCon-right">
						<select id="sel" >
							<option>油品类</option>
							<option>化工类</option>
						</select>
					</div>
					<div class="searchCon-right">
						<select id="sel"  v-model="proName"  >
							<option disabled="disabled">请选择类型</option>
							<option >二甲苯</option>
							<option >粗甲苯</option>
						</select>
					</div>
				</div>


			</div>
			<div class="list" style="height:6.5rem">
				<div class="line">
					<span class="num numIng" >1</span>
						<span class="chepai">粤AE86</span>
						<span class="statu ing" >正在装</span>
					</div>
					<div class="line">
					<span class="num numCq" >2</span>
						<span class="chepai">粤BE86</span>
						<span class="statu cq" >厂区待装</span>
					</div>
					<div class="line">
					<span class="num" >3</span>
						<span class="chepai">粤CE86</span>
						<span class="statu" >厂外待装</span>
				</div>
			</div>

			<!-- <div class="list" v-else>
					<div class="nothing">
						<img src="/Public/Home/icon/nothing.png" alt="" />
						<p>暂无更多数据</p>
					</div>
			</div> -->
			<div id="footer">
				<a href="<?php echo U('toIndex');?>" class="on">
					<img src="/Application/Home/View/images/paiduichaxun2.png" alt="">
					<p>排队查询</p>
				</a>
				<a href="<?php echo U('toOrder');?>">
					<img src="/Application/Home/View/images/yuyue.png" alt="">
					<p>预约装车</p>
				</a>
				<a href="<?php echo U('toMy');?>">
					<img src="/Application/Home/View/images/gerenzhongxin.png" alt="">
					<p>个人中心</p>
				</a>
			</div>
</div>
</body>
	<script type="text/javascript" src="/Application/Home/View/js/vue.min.js"></script>
	<script src="/Application/Home/View/js/jquery.min weui.js"></script>
    <script src="/Application/Home/View/js/jquery-weui.min.js"></script>

</html>