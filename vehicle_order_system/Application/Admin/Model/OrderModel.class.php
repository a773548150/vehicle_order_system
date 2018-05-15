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
        $G = M("goods");
        $C = A("Order");
        $L = A("Log");

        $data['number'] = $C->orderNumber();
        $data['udid'] = $C->orderNumber();
        $data['out_destination'] = trim(I('post.destination'));
        $goods["name"] = trim(I('post.goodsName'));
        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        $goods["number"] = $nowTime.$sixRand;
        $goods['quantity'] = trim(I('post.number'));
        $goodsId = $G->data($goods)->add();
        $data['goods_id'] = $goodsId;
        $data['goods_quantity'] = trim(I('post.number'));
        $data['start_time'] = trim(I('post.startTime'));
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();
        if($result){
            $insertData = array();
            $insertData["table_id"] = $result;
            $insertData["table_name"] = "order";
            $L->insert($insertData);
        }
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

    public function deleteOrder() {
        $m = M("order");
        $L = A("Log");
        $data["id"] = I("post.id");
        $data2['delete_time'] = date("Y-m-d h:i:s");
        $data2["status"] = 0;
        $result = $m->where($data)->save($data2);
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

}