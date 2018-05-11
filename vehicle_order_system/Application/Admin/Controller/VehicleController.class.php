<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:09
 */

namespace Admin\Controller;

class VehicleController extends BaseController {
    public function addVehicle() {
        $m = D("Vehicle");
        $res = $m->addVehicle();
        echo $res;
    }

    public function searchVehicle() {
        $m = D("Vehicle");
        $res = $m->searchVehicle();

        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
    }

    public function deleteVehicle() {
        $m = D("Vehicle");
        $res = $m->deleteVehicle();
        echo $res;
    }

    public function editVehicle() {
        $m = D("Vehicle");
        $res = $m->editVehicle();
        echo $res;
    }
}