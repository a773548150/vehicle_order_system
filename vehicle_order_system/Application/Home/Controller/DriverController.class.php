<?php
namespace Home\Controller;

class DriverController extends BaseController {

    //上传头像
    public function uploadProfilePhoto() {
        $m = D("driver");
        $rs = $m->uploadProfilePhoto();
        echo $rs;
    }

    //查询司机信息
    public function showDriverMessage() {
        $m = D("driver");
        $rs = $m->showDriverMessage();
        $this->assign('data', $rs);
    }
}