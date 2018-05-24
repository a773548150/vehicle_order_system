<?php
namespace Home\Controller;

class OrderController extends BaseController {

    //领取订单
    public function makeOrder() {
        $m = D("Order");
        $rs = $m->makeOrder();
        echo $rs;
    }

    public function defaultInput() {
        $m = D("Order");
        $rs = $m->defaultInput();
        $rs = json2($rs);
        echo $rs;
    }
    public function searchLicense() {
        $m = D("Order");
        $rs = $m->searchLicense();
        $rs = json2($rs);
        echo $rs;
    }

    public function searchData() {
        $m = D("Order");
        $rs = $m->searchData();
        $rs = json2($rs);
        echo $rs;
    }

    public function searchPersonalMessage() {
        $m = D("Order");
        $rs = $m->searchPersonalMessage();
        $rs = json2($rs);
        echo $rs;
    }

    public function searchPersonalOrder() {
        $m = D("Order");
        $rs = $m->searchPersonalOrder();
        $rs = json2($rs);
        echo $rs;
    }

    public function searchEditMy() {
        $m = D("Order");
        $rs = $m->searchEditMy();
        $rs = json2($rs);
        echo $rs;
    }

    public function alertPersonalMessage() {
        $m = D("Order");
        $rs = $m->alertPersonalMessage();
        $rs = json2($rs);
        echo $rs;
    }
}