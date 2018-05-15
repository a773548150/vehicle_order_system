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


    //生成订单
    public function makeOrder() {
        $m = D("Order");
        $res = $m->makeOrder();
        echo $res;
    }

    public function selectAllVehicle() {
        $m = D("Order");
        $res = $m->selectAllVehicle();
        $this->assign('vehicleName', $res);
    }

    public function selectAllOil() {
        $m = D("Order");
        $res = $m->selectAllOil();
        $this->assign('oilName', $res);
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

    public function searchVehicle() {
        $m = D("Order");
        $res = $m->searchVehicle();

        $rs = json(0,'数据返回成功',1000,$res);
        echo $rs;
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
            array('number','单号'),
            array('order_status','状态'),
            array('rank','排名'),
            array('driver_number','司机编号'),
            array('oil_name','油名'),
            array('create_time','开始时间')
        );
        $xlsModel = M('Order');
        $driver = M("driver");
        $oil = M("oil");

        if (I("get.startTime") && I("get.endTime")) {
            $startTime = I("get.startTime");
            $endTime = I("get.endTime");
            $data['mission_status'] = I('get.missionStatus');
            $data['number'] = array('LIKE', "%".I('get.orderNumber')."%");
            $data["create_time"] = array(array('gt', $startTime), array('lt', $endTime));
            $xlsData  = $xlsModel->where($data)->order('id desc')->Field('id,number,create_time,order_status,rank,driver_id,oil_id')->select();
        } else {
            $xlsData  = $xlsModel->order('id desc')->Field('id,number,create_time,order_status,rank,driver_id,oil_id')->select();
        }

        foreach ($xlsData as $k => $v)
        {
            $value3 = $v['driver_id'];
            $result3 = $driver->where(array("id"=>$value3))->getField("number");
            $xlsData[$k]['driver_number'] = $result3;

            $value2 = $v['oil_id'];
            $result2 = $oil->where(array("id"=>$value2))->getField("name");
            $xlsData[$k]['oil_name'] = $result2;
        }

        foreach ($xlsData as $k => $v)
        {
            if ($v['order_status']==0){
                $xlsData[$k]['order_status'] = "已接";
            } else if ($v['order_status']==1) {
                $xlsData[$k]['order_status'] = "装车中";
            } else if ($v['order_status']==2) {
                $xlsData[$k]['order_status'] = "厂区内待装";
            }else if ($v['order_status']==3) {
                $xlsData[$k]['order_status'] = "厂外待装";
            }
        }
        exportExcel($xlsName,$xlsCell,$xlsData); //调用Common函数，导出excel
    }
}