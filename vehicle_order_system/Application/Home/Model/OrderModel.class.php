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

    public function makeOrder() {
        $m = M("order");
        $V = M("vehicle");
        $D = M("driver");
        $vehicle["license_plate"] = I("post.license_plate");
        $driver["mobile_number"] = $_SESSION['username1'];
        $vehicle_id = $V->where($vehicle)->getField("id");
        $driver_id = $D->where($driver)->getField("id");
        $number["number"] = I("post.number");

        $data["vehicle_id"] = $vehicle_id;
        $data["driver_id"] = $driver_id;
        $data["pick_up_order"] = I("post.pick_up_order");
        $data["pick_up_time"] = I("post.pick_up_time");
        $data["pick_up_quantity"] = I("post.pick_up_quantity");
        $data["contract_number"] = I("post.contract_number");
        $data["out_of_stock_message"] = I("post.out_of_stock_message");
        $data["closing_unit"] = I("post.closing_unit");

        $result = $m->where($number)->save($data);

        return $result;
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