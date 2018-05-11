<?php
namespace Home\Controller;

class VehicleController extends BaseController {

    //查询车牌号
    public function selectLicense() {
        $m = D("Vehicle");
        $rs = $m->selectLicense();
        echo json_encode($rs);
    }
}