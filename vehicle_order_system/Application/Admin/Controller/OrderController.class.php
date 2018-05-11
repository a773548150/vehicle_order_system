<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:09
 */

namespace Admin\Controller;

class OrderController extends BaseController {
    public function index() {
        $this->display("/order");
    }

//    public function goods() {
//        $m = D("Order");
//        $res = $m->goods();
//        $this->assign('goodsName', $res);
//    }

    //创建随机订单编号
    public function orderNumber() {
        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        return $nowTime.$sixRand;
    }

    //创建随机商品编号
    public function goodsNumber() {
        $nowTime = date("Ymdhis");
        return "goods".$nowTime;
    }

    //生成订单
    public function makeOrder() {
        $m = D("Order");
        $res = $m->makeOrder();
        echo $res;
    }

//    public function searchType() {
//        $m = D("Order");
//        $res = $m->searchType();
//        $this->assign('orderMessage', $res);
//        $this->display("/orderManager");
//    }

    public function searchOrder() {
        $m = D("Order");
        $res = $m->searchOrder();

        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
//        $this->assign('orderMessage', $res);
//        $this->display("/orderManager");
    }

    public function deleteOrder() {
        $m = D("Order");
        $res = $m->deleteOrder();
        echo $res;
    }

    public function editOrder() {
        $m = D("Order");
        $res = $m->editOrder();
        echo $res;
    }

    public function timeSelect() {
        $m = D("Order");
        $res = $m->timeSelect();
        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
    }

     //导出Excel
    function expUser(){
        $xlsName  = "Order";
        $xlsCell  = array(
            array('id','id'),
            array('number','订单号'),
            array('udid','订单编号'),
            array('create_time','出发时间'),
            array('out_number','出车车牌号'),
            array('out_destination','目的地'),
            array('mission_status','状态'),
            array('order_driver_number','司机编号'),
            array('pick_up_order','提货单号'),
            array('contract_number','合同号'),
            array('out_of_stock_message','缺货信息'),
            array('goods_name','商品名'),
            array('pick_up_quantity','提货数量'),
            array('pick_up_time','提货时间'),
            array('closing_unit','结算单位')
        );
        $xlsModel = M('Order');
        $driver = M("driver");
        $vehicle = M("vehicle");
        $goods = M("goods");

        if (I("get.startTime") && I("get.endTime")) {
            $startTime = I("get.startTime");
            $endTime = I("get.endTime");
            $data['mission_status'] = I('get.missionStatus');
            $data['number'] = array('LIKE', "%".I('get.orderNumber')."%");
            $data["start_time"] = array(array('gt', $startTime), array('lt', $endTime));
            $xlsData  = $xlsModel->where($data)->order('id desc')->Field('id,number,udid,create_time,vehicle_id,out_destination,mission_status,driver_id,pick_up_order,contract_number,out_of_stock_message,goods_id,pick_up_quantity,pick_up_time,closing_unit')->select();
        } else {
            $xlsData  = $xlsModel->order('id desc')->Field('id,number,udid,create_time,vehicle_id,out_destination,mission_status,driver_id,pick_up_order,contract_number,out_of_stock_message,goods_id,pick_up_quantity,pick_up_time,closing_unit')->select();
        }

        foreach ($xlsData as $k => $v)
        {
            $value1 = $v['vehicle_id'];
            $result1 = $vehicle->where(array("id"=>$value1))->getField("license_plate");
            $xlsData[$k]['out_number'] = $result1;

            $value2 = $v['goods_id'];
            $result2 = $goods->where(array("id"=>$value2))->getField("name");
            $xlsData[$k]['goods_name'] = $result2;

            $value3 = $v['driver_id'];
            $result3 = $driver->where(array("id"=>$value3))->getField("number");
            $xlsData[$k]['order_driver_number'] = $result3;
        }

        foreach ($xlsData as $k => $v)
        {
            if ($v['mission_status']==0){
                $xlsData[$k]['mission_status'] = "未接";
            } else if ($v['mission_status']==1) {
                $xlsData[$k]['mission_status'] = "已接";
            } else if ($v['mission_status']==2) {
                $xlsData[$k]['mission_status'] = "已完成";
            }
        }
        exportExcel($xlsName,$xlsCell,$xlsData); //调用Common函数，导出excel
    }
}