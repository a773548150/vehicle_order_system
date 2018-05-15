<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:09
 */

namespace Admin\Controller;

class noticeController extends BaseController {

    public function addNotice() {
        $m = D("Notice");
        $res = $m->addNotice();
        echo $res;
    }

    public function searchNotice() {
        $m = D("Notice");
        $res = $m->searchNotice();

        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
    }
    public function deleteNotice() {
        $m = D("Notice");
        $res = $m->deleteNotice();
        echo $res;
    }
    public function editNotice() {
        $m = D("Notice");
        $res = $m->editNotice();
        echo $res;
    }

}