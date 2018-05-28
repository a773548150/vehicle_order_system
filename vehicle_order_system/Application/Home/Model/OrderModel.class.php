<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:39
 */

namespace Home\Model;

class OrderModel extends BaseModel {

    public function findRank($oil_id) {
        $m = M("order");
        $result = $m->where(array("order_status" => 3, "oil_id" => $oil_id))->getField("rank", true);
        return count($result);
    }

    public function makeOrder() {
        $m = M("order");
        $O = M("oil");
        $D = M("driver");
        $W = M("wechat");
       // $driver = openid;
        session_start();
        $openid = $_SESSION["openid"];
        $wechat_id = $W->where(array("openid" => $openid))->getField("id");
        $driver_id = $D->where(array("wechat_id" => $wechat_id))->getField("id");;

        $license_plate = strtoupper(trim(I("post.license_plate")));
        $oil_id = $O->where(array("name" => I("post.OilName")))->getField("id");
        $rank = $this->findRank($oil_id) + 3;
        $data["driver_id"] = $driver_id;
        $data["oil_id"] = $oil_id;
        $data["rank"] = $rank;
        $data["license_plate"] = $license_plate;
        $data["company"] = I("post.company");
        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        $data["number"] = $nowTime.$sixRand;
        $data["order_status"] = 3;
        $data['create_time'] = date("Y-m-d h:i:s");
        if(!$this->isStop()){
            $result = $m->data($data)->add();
        } else {
            $result = "0";
        }
        return $result;
    }

    public function defaultInput() {
//        $m = M("order");
//        $W = M("wechat");
//        $D = M("driver");
        session_start();
        $openid = $_SESSION["openid"];
        $default = M();
        $sql = "select o.license_plate, o.stop, d.company, d.name, d.mobile_number, o.order_status from t_order o LEFT JOIN t_driver d on o.driver_id = d.id LEFT JOIN t_wechat w on d.wechat_id = w.id where o.`status`=1 and d.`status`=1 and w.openid = \"{$openid}\" order by o.create_time DESC LIMIT 0, 1";
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
        if($oilName == "0"){
            $sql = "select t_order.license_plate, t_order.order_status, t_order.rank, t_order.`stop`, t_order.oil_id, t_oil.`name`, t_order.company from t_order LEFT JOIN t_oil on t_order.oil_id = t_oil.id LEFT JOIN t_driver on t_driver.id = t_order.driver_id where t_oil.name = 0 and t_oil.`status`=1 order by rank asc";
        } else {
            $sql = "select t_order.license_plate, t_order.order_status, t_order.rank, t_order.`stop`, t_order.oil_id, t_oil.`name`, t_order.company from t_order LEFT JOIN t_oil on t_order.oil_id = t_oil.id LEFT JOIN t_driver on t_driver.id = t_order.driver_id where t_oil.name = \"{$oilName}\" and t_oil.`status`=1 order by rank asc";
        }
         $result = $M->query($sql);
        return $result;
    }

    public function searchData() {
        $searchData = I("post.searchData");
        $M = M();
        $sql = "select license_plate, order_status, rank from t_order where license_plate and t_order.`status`=1 like \"%{$searchData}%\"";
        $result = $M->query($sql);
        if ($result) {
            return $result;
        } else {
            return "0";
        }
    }

    public function searchPersonalMessage() {
        session_start();
        $M = M();
        $openid = $_SESSION["openid"];
        $sql = "select t_driver.license_plate driver_license_plate, t_order.stop, t_order.rank, t_order.license_plate order_license_plate, t_wechat.nickname, t_order.order_status, t_order.company, t_driver.`name`, t_driver.mobile_number, t_wechat.headimgurl from t_order LEFT JOIN t_driver on t_driver.id = t_order.driver_id LEFT JOIN t_wechat on t_wechat.id = t_driver.wechat_id where t_wechat.openid = \"{$openid}\"";
        $result = $M->query($sql);
        if($result) {
            return $result;
        } else {
            $sql = "select t_driver.license_plate driver_license_plate, t_wechat.nickname, t_driver.company, t_driver.`name`, t_driver.mobile_number, t_wechat.headimgurl from t_driver left join t_wechat on t_wechat.id = t_driver.wechat_id where t_wechat.openid = \"{$openid}\"";
            $result1 = $M->query($sql);
            $result1[0]["stop"] =1;
            $result1[0]["rank"] =0;
            $result1[0]["order_license_plate"] = "*****";
            $result1[0]["order_status"] = 3;
            return $result1;
        }

    }

    public function searchPersonalOrder() {
        session_start();
        $M = M();
        $openid = $_SESSION["openid"];
        $sql = "select t_driver.license_plate driver_license_plate, t_order.license_plate t_order_license_plate,t_order.create_time, t_oil.type, t_order.order_status, t_order.company, t_driver.`name`, t_driver.mobile_number from t_order LEFT JOIN t_driver on t_driver.id = t_order.driver_id LEFT JOIN t_wechat on t_wechat.id = t_driver.wechat_id LEFT JOIN t_oil on t_oil.id = t_order.oil_id where t_wechat.openid = \"{$openid}\" and t_order.status=1 order by create_time desc";
        $result = $M->query($sql);

        return $result;
    }

    public function isStop() {
        session_start();
        $M = M("Order");
        $result = $M->getField("stop");
        return $result;
    }

    public function searchEditMy() {
        session_start();
        $M = M();
        $openid = $_SESSION["openid"];
        $sql = "select t_driver.license_plate driver_license_plate, t_driver.company, t_driver.`name`, t_driver.mobile_number from t_driver LEFT JOIN t_wechat on t_wechat.id = t_driver.wechat_id where t_wechat.openid = \"{$openid}\"";
        $result = $M->query($sql);
        return $result;
    }

    public function alertPersonalMessage() {
        session_start();
        $W = M("wechat");
        $D = M("driver");

        $name = I("post.name");
        $mobile_number = I("post.mobile_number");
        $license_plate = I("post.license_plate");
        $company = I("post.company");

        $openid = $_SESSION["openid"];
        $wechat_id = $W->where(array("openid" => $openid))->getField("id");
        $driver_id = $D->where(array("wechat_id" => $wechat_id))->getField("id");
        $result = $D->where(array("id" => $driver_id))->save(array("name" => $name, "mobile_number" => $mobile_number, "company" => $company, "license_plate" => $license_plate));

        return $result;
    }
}