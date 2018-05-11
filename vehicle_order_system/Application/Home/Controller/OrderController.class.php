<?php
namespace Home\Controller;

class OrderController extends BaseController {

    //查询未接订单
    public function selectUnTaking() {
        $m = D("Order");
        $rs = $m->selectUnTaking();
        $this->assign('unTakingData', $rs);
    }

    //查询进行中订单
    public function selectUnFinish() {
        $m = D("Order");
        $rs = $m->selectUnFinish();
        $this->assign('unFinishData', $rs);
    }

    //查询完成订单
    public function selectFinish() {
        $m = D("Order");
        $rs = $m->selectFinish();
        $this->assign('finishData', $rs);
    }

    //查询订单
    public function showOrderDetail() {
        $m = D("Order");
        $rs = $m->showOrderDetail();
        $this->assign('data', $rs);
    }

    //领取订单
    public function makeOrder() {
        $m = D("Order");
        $rs = $m->makeOrder();
        echo $rs;
    }

    //查询个人进行中订单
    public function selectPersonalUnFinish() {
        $m = D("Order");
        $rs = $m->selectPersonalUnFinish();
        $this->assign('personalUnFinishData', $rs);
    }

    //查询个人完成订单
    public function selectPersonalFinish() {
        $m = D("Order");
        $rs = $m->selectPersonalFinish();
        $this->assign('personalFinishData', $rs);
    }

    //查询个人订单详情
    public function showPersonalOrderDetail() {
        $m = D("Order");
        $rs = $m->showPersonalOrderDetail();
        $this->assign('data', $rs);
    }

    //填写送达订单
    public function makeServiceOrder() {
        $m = D("Order");
        $rs = $m->makeServiceOrder();
        echo $rs;
    }

    //查询完成订单详情
    public function showFinishOrderDetail() {
        $m = D("Order");
        $rs = $m->showPersonalOrderDetail();
        $this->assign('data', $rs);
    }

}