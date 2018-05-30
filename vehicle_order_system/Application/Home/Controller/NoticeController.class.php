<?php
namespace Home\Controller;

class NoticeController extends BaseController {

    //查询车牌号
    public function selectNotice() {
        $m = D("Notice");
        $rs = $m->selectNotice();
        echo json_encode($rs);
    }
}