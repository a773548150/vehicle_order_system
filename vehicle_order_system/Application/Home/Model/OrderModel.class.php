<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:39
 */

namespace Home\Model;

class OrderModel extends BaseModel {

    public function selectUnTaking() {
        $m = M("order");
        $G = M("goods");
        $data["mission_status"] = 0;
        $result = $m->where($data)->order('id desc')->getField('number, out_destination, goods_id, goods_quantity, start_time');

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                }
            }
        }
        return $result;
    }

    public function selectUnFinish() {
        $m = M("order");
        $G = M("goods");
        $V = M("vehicle");
        $data["mission_status"] = 1;
        $result = $m->where($data)->order('id desc')->getField('number, out_destination, goods_id, vehicle_id, goods_quantity, start_time');

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                }
            }
        }
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["license_plate"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        return $result;
    }

    public function selectFinish() {
        $m = M("order");
        $G = M("goods");
        $V = M("vehicle");
        $data["mission_status"] = 2;
        $result = $m->where($data)->order('id desc')->getField('number, out_destination, goods_id, vehicle_id, goods_quantity, start_time');

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                    $result[$key]["real_quantity"] = $G->where(array("id"=>$value2))->getField("real_quantity");
                }
            }
        }


        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["license_plate"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        return $result;
    }

    public function showOrderDetail() {
        $m = M("order");
        $G = M("goods");
        $data["number"] = I("get.id");
        $result = $m->where($data)->order('id desc')->select();
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                }
            }
        }
        return $result;
    }


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

    public function selectPersonalUnFinish() {
        $m = M("order");
        $G = M("goods");
        $D = M("driver");
        $V = M("vehicle");
        $startTime = I("get.startTime");
        $endTime = I("get.endTime");
        if($startTime && $endTime) {
            $data["start_time"] = array(array('egt', $startTime), array('elt', $endTime));
        }

        $driver["mobile_number"] = $_SESSION['username1'];
        $driver_id = $D->where($driver)->getField("id");
        $data["mission_status"] = 1;
        $data['driver_id'] = $driver_id;
        $result = $m->where($data)->order('id desc')->getField('number, out_destination, goods_id, vehicle_id, goods_quantity, start_time');

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                }
            }
        }
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["license_plate"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        return $result;
    }

    public function selectPersonalFinish() {
        $m = M("order");
        $G = M("goods");
        $D = M("driver");
        $V = M("vehicle");
        $startTime = I("get.startTime");
        $endTime = I("get.endTime");
        if($startTime && $endTime) {
            $data["start_time"] = array(array('egt', $startTime), array('elt', $endTime));
        }

        $driver["mobile_number"] = $_SESSION['username1'];
        $driver_id = $D->where($driver)->getField("id");
        $data["mission_status"] = 2;
        $data['driver_id'] = $driver_id;
        $result = $m->where($data)->order('id desc')->getField('number, out_destination, goods_id, vehicle_id, goods_quantity, start_time');

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                    $result[$key]["real_quantity"] = $G->where(array("id"=>$value2))->getField("real_quantity");
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["license_plate"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        return $result;
    }

    public function showPersonalOrderDetail() {
        $m = M("order");
        $G = M("goods");
        $V = M("vehicle");
        $data["number"] = I("get.id");
        $result = $m->where($data)->order('id desc')->select();
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["license_plate"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        return $result;
    }

    public function makeServiceOrder() {
        $m = M("order");
        $G = M("goods");
        $order["number"] = I("post.number");
        $data["real_quantity"] = I("post.real_quantity");
        $goods_id = $m->where($order)->getField("goods_id");
        $id["id"] = $goods_id;
        $result = $G->where($id)->save($data);
        return $result;
    }

    public function showFinishOrderDetail() {
        $m = M("order");
        $G = M("goods");
        $V = M("vehicle");
        $data["number"] = I("get.id");
        $result = $m->where($data)->order('id desc')->select();
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                    $result[$key]["real_quantity"] = $G->where(array("id"=>$value2))->getField("real_quantity");
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["license_plate"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        return $result;
    }

}