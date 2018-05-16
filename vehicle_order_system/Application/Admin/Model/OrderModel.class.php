<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class OrderModel extends BaseModel {

//    public function goods() {
//        $m = M("goods");
//        $result = $m->getField("name", true);
//        return $result;
//    }

    public function makeOrder() {
        $m = M("order");
        $D = M("driver");
        $O = M("oil");
        $L = A("Log");

        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');

        $data['driver_id'] = $D->where(array("license_plate" => I('post.vehicle')))->getField("id");
        $data['oil_id'] = $O->where(array("name" => I('post.oil')))->getField("id");
        $data['rank'] = I('post.rank');
        $data['number'] = $nowTime.$sixRand;
        $data['order_status'] = I("post.status");
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();

        $L->insert("添加预约车辆车牌为：".I('post.vehicle'));
        return $result;
    }

    public function findForeign($result){
        $D = M("driver");
        $O = M("oil");

        //通过司机id外键查找到司机编号
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "driver_id" && $key2 != null) {
                    $result[$key]["driver_number"] = $D->where(array("id"=>$value2))->getField("number");
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "oil_id" && $key2 != null) {
                    $result[$key]["oil_name"] = $O->where(array("id"=>$value2))->getField("name");
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "order_status" && $key2 != null) {
                    if($result[$key]["order_status"] == 0) {
                        $result[$key]["order_status"] = "已装";
                    } else if($result[$key]["order_status"] == 1) {
                        $result[$key]["order_status"] = "装车中";
                    } else if($result[$key]["order_status"] == 2) {
                        $result[$key]["order_status"] = "厂区内待装";
                    }else if($result[$key]["order_status"] == 3) {
                        $result[$key]["order_status"] = "厂外待装";
                    }
                }
            }
        }

        return $result;
    }

    public function searchOrder() {
        $m = M("order");

        $startTime = I("get.startTime");
        $endTime = I("get.endTime");
        if ($startTime && $endTime) {
            $data["create_time"] = array(array('egt', $startTime), array('elt', $endTime));
        }
        $data['order_status'] = I('get.missionStatus');
        $data['number'] = array('LIKE', "%".I('get.orderNumber')."%");
        $data['status'] = 1;
        $page = I('get.page');
        $limit = I('get.limit');
        if ($data['order_status'] === "0" || $data['order_status'] === "1" || $data['order_status'] === "2") {
            $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
            $result = $this->findForeign($result);
            return $result;
        } else if($data['order_status'] === "3"){
            unset($data['order_status']);
            $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
            $result = $this->findForeign($result);
            return $result;
        } else {
            $result = $m->where(array("status"=>1))->order('id desc')->page($page, $limit)->select();
            $result = $this->findForeign($result);
            return $result;
        }
    }

    public function searchVehicle() {
    $m = M("order");
    $data['license_plate'] = array('LIKE', "%".I('get.license_plate')."%");
    $data['status'] = 1;
    $page = I('get.page');
    $limit = I('get.limit');
    $result = $m->where(array("status"=>1))->order('id desc')->page($page, $limit)->select();
    $result = $this->findForeign($result);
    return $result;
}

    public function deleteOrder() {
        $m = M("order");
        $L = A("Log");
        $data["id"] = I("post.id");
        $result = $m->delete($data["id"]);
        $L->insert("删除了单号为：".I("post.number")."  的订单");
        return $result;
    }

    public function editOrder() {
        $m = M("order");
        $O = M("oil");
        $D = M("driver");
        $L = A("Log");
        $lim["id"] = I('post.id');
        $oil_id = $O->where(array("name" => I("post.oil_name")))->getField("id");
        $driver_id = $D->where(array("number" => I("post.driver_number")))->getField("id");
        $data = I('post.value');
        $data["oil_id"] = $oil_id;
        $data["driver_id"] = $driver_id;
        $data['update_time'] = date("Y-m-d h:i:s");
        $res = $m->where($lim)->save($data);
        $number = $m->where(array("id" => $lim["id"]))->getField("number");

        $L->update("修改单号：“".$number."”的信息");
        return $res;
    }

    public function selectAllVehicle() {
        $D = M();
        $sql = "SELECT * FROM t_driver d left JOIN t_order o ON d.id=o.driver_id  where order_status is null and  d.`status` = 1";
        $result = $D->query($sql);
//        var_dump($result);
        return $result;
    }

    public function selectAllOil() {
        $O = M("oil");
        $result = $O->where(array("status"=>"1"))->getField("name", true);
//        var_dump($result);die;
        return $result;
    }
}