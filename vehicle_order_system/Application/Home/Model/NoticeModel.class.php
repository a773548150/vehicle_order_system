<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:39
 */

namespace Home\Model;

class NoticeModel extends BaseModel {

    public function selectNotice() {
        $m = M("notice");
        $result = $m->select();
        return $result;
    }
}