<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:09
 */

namespace Admin\Controller;

class LogController extends BaseController {
    public function insert($insertData) {
        $m = D("Log");
        $rs = $m->insert($insertData);
        echo $rs;
    }

    public function update($updateData) {
        $m = D("Log");
        $rs = $m->update($updateData);
        echo $rs;
    }

    public function delete($deleteData) {
        $m = D("Log");
        $rs = $m->delete($deleteData);
        echo $rs;
    }

    public function searchLog(){
        $m = D("Log");
        $res = $m->searchLog();
        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
    }

    public function deleteLog() {
        $m = D("Log");
        $rs = $m->deleteLog();
        echo $rs;
    }

}