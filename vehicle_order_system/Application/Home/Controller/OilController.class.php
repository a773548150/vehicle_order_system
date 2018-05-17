<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:09
 */

namespace Home\Controller;

class OilController extends BaseController {

    public function addOil() {
        $m = D("Oil");
        $res = $m->addOil();
        echo $res;
    }

    public function searchOil() {
        $m = D("Oil");
        $res = $m->searchOil();

        $rs = json2($res);
        echo $rs;
    }
    public function deleteOil() {
        $m = D("Oil");
        $res = $m->deleteOil();
        echo $res;
    }


}