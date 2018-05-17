<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:39
 */

namespace Home\Model;

class OrderModel extends BaseModel {

    public function findRank() {
        $m = M("order");
        $result = $m->where(array("order_status" => 3))->getField("rank", true);
        return count($result);
    }

    public function makeOrder() {
        $m = M("order");
        $O = M("oil");
       // $driver = openid;
        $driver_id = 1;
        $license_plate = strtoupper(trim(I("post.license_plate")));
        $oil_id = $O->where(array("name" => I("post.OilName")))->getField("id");
        $rank = $this->findRank() + 1;
        $data["driver_id"] = $driver_id;
        $data["oil_id"] = $oil_id;
        $data["rank"] = $rank;
        $data["license_plate"] = "粤A".$license_plate;
        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        $data["number"] = $nowTime.$sixRand;
        $data["order_status"] = 3;
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();
        return $result;
    }

    public function defaultInput() {
//        $m = M("order");
//        $W = M("wechat");
//        $D = M("driver");

        $openid = "oyur_1GhybMGLZZ5xc1-LxSO39T8";
        $default = M();
        $sql = "select o.license_plate, d.company from t_order o LEFT JOIN t_driver d on o.driver_id = d.id LEFT JOIN t_wechat w on d.wechat_id = w.id where o.`status`=1 and d.`status`=1 and w.openid = \"{$openid}\" order by o.create_time DESC LIMIT 0, 1";
        $result = $default->query($sql);
        return $result;

//        $wechat_id = $W->where($data1)->getField("id");
//        $data2["wechat_id"] = $wechat_id;
//        $driver_id = $D->where($data2)->getField("id");
//        $data3["driver_id"] = $driver_id;
//        $result = $m->where($data3)->getField("license_plate, ");
    }

    public function searchLicense() {
        $oilName = I("post.oilName");
        $M = M();
        $sql = "select t_order.license_plate, t_order.order_status, t_order.rank, t_order.`stop`, t_order.oil_id, t_oil.`name`, company from t_order LEFT JOIN t_oil on t_order.oil_id = t_oil.id LEFT JOIN t_driver on t_driver.id = t_order.driver_id where t_oil.name = \"{$oilName}\" order by rank asc";
        $result = $M->query($sql);
        return $result;
    }

    public function searchData() {
        $searchData = I("post.searchData");
        $M = M();
        $sql = "select license_plate, order_status, rank from t_order where license_plate = \"{$searchData}\"";
        $result = $M->query($sql);
        if ($result) {
            return $result;
        } else {
            return "0";
        }
    }

    public function searchPersonalMessage() {
        $M = M();
        $openid = "oyur_1GhybMGLZZ5xc1-LxSO39T8";
        $sql = "select t_order.license_plate, t_wechat.nickname, t_order.order_status, company, t_driver.`name`, t_driver.mobile_number, t_wechat.headimgurl from t_order LEFT JOIN t_driver on t_driver.id = t_order.driver_id LEFT JOIN t_wechat on t_wechat.id = t_driver.wechat_id where t_wechat.openid = \"{$openid}\"";
        $result = $M->query($sql);
        return $result;
    }

    public function searchPersonalOrder() {
        $M = M();
        $openid = "oyur_1GhybMGLZZ5xc1-LxSO39T8";
        $sql = "select t_order.license_plate, t_order.create_time, t_oil.type, t_order.order_status, company, t_driver.`name`, t_driver.mobile_number from t_order LEFT JOIN t_driver on t_driver.id = t_order.driver_id LEFT JOIN t_wechat on t_wechat.id = t_driver.wechat_id LEFT JOIN t_oil on t_oil.id = t_order.oil_id where t_wechat.openid = \"{$openid}\"";
        $result = $M->query($sql);
        return $result;
    }
}