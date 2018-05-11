<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:09
 */

namespace Admin\Controller;

class DriverController extends BaseController {
    public function index() {

    }

    public function addDriver() {
        $m = D("Driver");
        $res = $m->addDriver();
        echo $res;
    }

    public function driverNumber() {
        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        return $nowTime.$sixRand;
    }

    public function searchDriver() {
        $m = D("Driver");
        $res = $m->searchDriver();

        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
    }

    public function deleteDriver() {
        $m = D("Driver");
        $res = $m->deleteDriver();
        echo $res;
    }

    public function editDriver() {
        $m = D("Driver");
        $res = $m->editDriver();
        echo $res;
    }
}