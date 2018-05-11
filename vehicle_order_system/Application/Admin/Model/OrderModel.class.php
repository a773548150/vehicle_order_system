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
        $G = M("goods");
        $V = M("vehicle");
        $D = M("driver");
        //通过商品id外键查找到商品名字
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "goods_id" && $key2 != null) {
                    $result[$key]["goods_name"] = $G->where(array("id"=>$value2))->getField("name");
                }
            }
        }
        //通过车辆id外键查找到车牌号
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "vehicle_id" && $key2 != null) {
                    $result[$key]["out_number"] = $V->where(array("id"=>$value2))->getField("license_plate");
                }
            }
        }
        //通过司机id外键查找到司机编号
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "driver_id" && $key2 != null) {
                    $result[$key]["order_driver_number"] = $D->where(array("id"=>$value2))->getField("number");
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
            $data["start_time"] = array(array('egt', $startTime), array('elt', $endTime));
        }
        $data['mission_status'] = I('get.missionStatus');
        $data['number'] = array('LIKE', "%".I('get.orderNumber')."%");
        $data['status'] = 1;
        $page = I('get.page');
        $limit = I('get.limit');
        if ($data['mission_status'] === "0" || $data['mission_status'] === "1" || $data['mission_status'] === "2") {
            $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
            $result = $this->findForeign($result);
            return $result;
        } else if($data['mission_status'] === "3"){
            unset($data['mission_status']);
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
        $data2["status"] = 0;
        $result = $m->where($data)->save($data2);
        if($result){
            $deleteData = array();
            $deleteData["table_id"] = $data["id"];
            $deleteData["table_name"] = "order";
            $L->delete($deleteData);
        }
        echo $result;
    }

    public function editOrder() {
        $m = M("order");
        $L = A("Log");
        $field = I('post.field');
        $value = I('post.value');
        $lim["id"] = I('post.id');
        $data[$field] = $value;
        $oldValue = $m->where($lim)->getField($field);
        $res = $m->where($lim)->save($data);

        if($res){
            $updateData = array();
            $updateData["table_id"] = $lim["id"];
            $updateData["table_name"] = "order";
            $updateData["key"] = $field;
            $updateData["value"] = $oldValue;
            $updateData["current_value"] = $value;
            $L->update($updateData);
        }
        return $res;
    }

}