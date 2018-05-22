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

        $status = I("post.status");
        $license_plate = I("post.vehicle");
        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');

        $data['driver_id'] = $D->where(array("license_plate" => $license_plate))->getField("id");
        $data['oil_id'] = $O->where(array("name" => I('post.oil')))->getField("id");
        $data['license_plate'] = $license_plate;
        if($status == 0) {
            $data['rank'] = 0;
        } else if($status == 1) {
            $data['rank'] = 1;
        } else if($status == 2) {
            $data['rank'] = 2;
        } else if($status == 3) {
            $data['rank'] = I('post.rank');
        }

        $this->rank($data);

        $data['number'] = $nowTime.$sixRand;
        $data['order_status'] = I("post.status");
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();
        $L->insert("添加预约车辆车牌为：".I('post.vehicle'));
        return $result;
    }

    public function rank($data) {
        $m = M("order");
        $result = $m->where(array("order_status" => 3))->getField("rank", true);
        $update_time = date("Y-m-d h:i:s");
        $rankMax = count($result) + 2;
        for ($i = $rankMax; $i >= $data['rank']; $i--) {
            $m->where(array("order_status" => 3, "rank" => $i))->save(array("rank" => $i+1, "update_time" => $update_time));
        }
    }

    public function findForeign($result){
        $D = M("driver");
        $O = M("oil");

        //通过司机id外键查找到司机编号
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "driver_id" && $key2 != null) {
                    $result[$key]["driver_mobile_number"] = $D->where(array("id"=>$value2))->getField("mobile_number");
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

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "stop" && $key2 != null) {
                    if($result[$key]["stop"] == 0) {
                        $result[$key]["stop"] = "排队进行中";
                    } else if($result[$key]["stop"] == 1) {
                        $result[$key]["stop"] = "暂停排队";
                    }
                }
            }
        }

//        foreach ($result as $key => $value) {
//            $result[$key]["rank"] = $result[$key]["rank"] - 2;
//        }
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
        $data['number'] = array('LIKE', "%".I('get.number')."%");
        $data['status'] = 1;
        $page = I('get.page');
        $limit = I('get.limit');
        if ($data['order_status'] === "0" || $data['order_status'] === "1" || $data['order_status'] === "2") {
            $result = $m->where($data)->order('rank desc')->page($page, $limit)->select();
            $result = $this->findForeign($result);
            return $result;
        } else if($data['order_status'] === "3"){
            unset($data['order_status']);
            $result = $m->where($data)->order('rank desc')->page($page, $limit)->select();
            $result = $this->findForeign($result);

            return $result;
        } else {
            $result = $m->where(array("status"=>1))->order('rank desc')->page($page, $limit)->select();
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
        $rank = I("post.rank");
        $update_time = date("Y-m-d h:i:s");
        $result = $m->where(array("order_status" => 3))->getField("rank", true);
        $rankMax = count($result) + 2;
        if($rank+3 > $rankMax || $rank-3 < 0){
            return "0";
        } else {
            $m->where(array("rank" => $rank+1))->save(array("rank" => $rank, "update_time" => $update_time));
            $m->where(array("rank" => $rank+2))->save(array("rank" => $rank+1, "update_time" => $update_time));
            $m->where(array("rank" => $rank+3))->save(array("rank" => $rank+2, "update_time" => $update_time));
            $m->where(array("id" => $data["id"]))->save(array("rank" => $rank+3, "update_time" => $update_time));
            $L->insert("删除了单号为：".I("post.number")."  的订单");
            return "1";
        }
    }

    public function stop() {
        $m = M("order");
        $L = A("Log");
        $data["stop"] = 1;
        $result1 = $m->getField("id", true);
        $data["update_time"] = date("Y-m-d h:i:s");
        foreach($result1 as $v){
            $result = $m->where(array("id" => $v))->save($data);
            $this->sendMessage($v,1);
        }
        $L->insert("暂停排队");
        return $result;
    }

    public function start() {
        $m = M("order");
        $L = A("Log");
        $data["stop"] = 0;
        $data["update_time"] = date("Y-m-d h:i:s");
        $result1 = $m->getField("id", true);
        foreach($result1 as $v){
            $result = $m->where(array("id" => $v))->save($data);
            $this->sendMessage($v,0);
        }
        $L->insert("开始排队");
        return $result;
    }

    public function forword() {
        $m = M("order");
        $L = A("Log");
        $update_time = date("Y-m-d h:i:s");
        $result = $m->where(array("order_status" => 3))->getField("id, rank", true);
        $rankMax = count($result) + 2;
        for ($i = 1; $i <= $rankMax; $i++) {
            $m->where(array("rank" => $i))->save(array("rank" => $i-1, "update_time" => $update_time));

        }
        foreach($result as $key => $value) {
            $this->sendMessage($key);
        }
        $m->where(array("rank" => 1))->save(array("order_status" => 1, "update_time" => $update_time));
        $m->where(array("rank" => 2))->save(array("order_status" => 2, "update_time" => $update_time));
        $m->where(array("rank" => 0))->save(array("order_status" => 0, "update_time" => $update_time));

        $L->insert("排队前进");
        return "1";
    }
    public function editOrder() {
        $m = M("order");
        $O = M("oil");
        $D = M("driver");
        $L = A("Log");

        $result = "0";

        $lim["id"] = I('post.id');

        $rank = $m->where(array("id" => $lim["id"]))->getField("rank");
        $newRank = I("post.value");
        //var_dump($newRank["rank"]);
        $result1 = $m->where(array("order_status" => 3))->getField("rank", true);
        $update_time = date("Y-m-d h:i:s");
        $rankMax = count($result1) + 2;
        //var_dump("rank: ".$rank."  newRank; ".$newRank["rank"]."  rankMax: ".$rankMax);die;

        if($newRank["rank"] < 0){
            $result = "0";
        } else {
            if($rank < 3){
                if($newRank["rank"] > 3 && $newRank["rank"] <= $rankMax+1){
                    $m->where(array("id" => $lim["id"]))->save(array("rank" => $newRank["rank"], "order_status" => 3, "update_time" => $update_time));
                    $this->sendMessage($lim["id"]);
                } else if($newRank["rank"] < 3 && $newRank["rank"] <= $rankMax+1){
                    $m->where(array("id" => $lim["id"]))->save(array("rank" => $newRank["rank"], "order_status" => $newRank["rank"], "update_time" => $update_time));
                    $this->sendMessage($lim["id"]);
                } else if($newRank["rank"] == 3 && $newRank["rank"] <= $rankMax+1){
                    for($i = $rankMax; $i >= 3; $i--) {
                        $m->where(array("rank" => $i))->save(array("rank" => $i+1, "update_time" => $update_time));
                    }
                    $m->where(array("id" => $lim["id"]))->save(array("rank" => $newRank["rank"], "update_time" => $update_time));
                }
                $result = 3;
            } else {
                if($newRank["rank"] > $rankMax){
                    $result =  "1";
                }else{
                    if($newRank["rank"] < 3 && $newRank["rank"] >=0){
                        for($i = $rank + 1; $i <= $rankMax; $i++) {
                            $m->where(array("rank" => $i))->save(array("rank" => $i-1, "update_time" => $update_time));
                        }
                        $m->where(array("id" => $lim["id"]))->save(array("rank" => $newRank["rank"], "order_status" => $newRank["rank"], "update_time" => $update_time));
                        $this->sendMessage($lim["id"]);
                        $result = "3";
                    } else if($newRank["rank"] >= 3){
                        if($rank < $newRank["rank"]) {
                            for($i = $rank + 1; $i <= $rankMax; $i++) {
                                $m->where(array("rank" => $i))->save(array("rank" => $i-1, "update_time" => $update_time));
                            }
                            $m->where(array("id" => $lim["id"]))->save(array("rank" => $newRank["rank"], "update_time" => $update_time));
                            $result = "3";
                        } else if($rank > $newRank["rank"]) {
                            for($i = $rank - 1; $i >= $newRank["rank"]; $i--) {
                                $m->where(array("rank" => $i))->save(array("rank" => $i+1, "update_time" => $update_time));
                            }
                            $m->where(array("id" => $lim["id"]))->save(array("rank" => $newRank["rank"], "update_time" => $update_time));
                            $result = "3";
                        } else if($rank == $newRank["rank"]){
                            $result = "2";
                        }
                    }
                }
            }
        }


        if($result > 2) {
            $data['update_time'] = date("Y-m-d h:i:s");
            $res = $m->where($lim)->save($data);
            $number = $m->where(array("id" => $lim["id"]))->getField("number");
            $L->update("修改单号：“".$number."”的信息");
        }
        return $result;
    }

    public function selectAllVehicle() {
        $D = M();
        $sql = "SELECT d.license_plate FROM t_driver d left JOIN t_order o ON d.id=o.driver_id  where order_status is null and  d.`status` = 1";
        $result = $D->query($sql);
//        var_dump($result);die;
        return $result;
    }

    public function selectAllOil() {
        $O = M("oil");
        $result = $O->where(array("status"=>"1"))->getField("name", true);
//        var_dump($result);die;
        return $result;
    }

    public function sendMessage($id, $rankStatus="") {
        $m = M();
        $sql="select t_order.license_plate license_plate, t_order.update_time , t_oil.type oilType, t_oil.name oilName, t_driver.`name`, t_order.status, t_wechat.openid  from t_order LEFT JOIN t_driver on t_driver.id = t_order.driver_id LEFT JOIN t_wechat on t_wechat.id = t_driver.wechat_id LEFT JOIN t_oil on t_oil.id = t_order.oil_id where t_order.id = \"{$id}\"";
        $result = $m->query($sql);
//        var_dump($result);die;
        if($result[0]["status"] == 0) {
            $result[0]["status"] = "已装";
        } else if($result[0]["status"] == 1) {
            $result[0]["status"] = "装车中";
        } else if($result[0]["status"] == 2) {
            $result[0]["status"] = "厂区内待装";
        } else if($result[0]["status"] == 3) {
            $result[0]["status"] = "厂区外待装";
        }
        if($rankStatus == 1) {
            $result[0]["status"] = "暂停";
        } else if($rankStatus == 0) {
            $result[0]["status"] = "重新开始";
        }

        $this->send_template_msg(
            $result[0]["openid"],//获取已保存的用户openid
            "http://yijiangbangtest.wsandos.com/linxiaocong/home/index/toYyjl",//订单详情页完整域名
            "#FF0000",//特殊语句的自定义16进制颜色
            "你好，".$result[0]["name"].",您的预约订单已经发生了变化",
            $result[0]["license_plate"],
            $result[0]["oiltype"],
            $result[0]["oilname"],
            $result[0]["status"],
            $result[0]["update_time"],
            ""
        );
    }

    public function send_template_msg($openid,$url="",$color="#000000",$first,$license_plate,$oilType,$oilName,$status,$time,$remark){
        $wechat = C('WECHAT_SDK');
        $data  = $this->teml($openid,$url,$color,$first,$license_plate,$oilType,$oilName,$status,$time,$remark);

        $json_token=$this->http_request("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wechat['appid']}&secret={$wechat['secret']}");
        $access_token=json_decode($json_token,true);
        $basetoken=$access_token["access_token"];

        $urls = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$basetoken;
        $res = $this->http_request($urls,urldecode($data));
        return json_decode($res,true);//array
    }

    public function teml($openid,$url="",$color="#000",$first,$license_plate,$oilType,$oilName,$status,$time,$remark="点击“查看详情“立即查阅您车辆的最新状态！"){
        $template = array(
            'touser' => "oCDScxIOAHLZG0GoSmqojFPANlO4",
            'template_id' => "iP7mZ2JSJNQRUhtyioAru6mEfvajevmNF29MpKNyVwM",//模版id
            'url'=> $url,
            'topcolor'=>"#7B68EE",
            'data'=>array(
                'first' => array(
                    'value' => urlencode($first),
                    'color' => $color,
                ),
                'keyword1' => array(
                    'value' => urlencode($license_plate),
                    'color' => $color,
                ),
                'keyword2' => array(
                    'value' => urlencode($oilType),
                    'color' => $color,
                ),
                'keyword3' => array(
                    'value' => urlencode($oilName),
                    'color' => $color,
                ),
                'keyword4' => array(
                    'value' => urlencode($status),
                    'color' => $color,
                ),
                'keyword5' => array(
                    'value' => urlencode($time),
                    'color' => $color,
                ),
                'remark' => array(
                    'value' => urlencode($remark),
                    'color' => "#000000",
                )
            )
        );

        return json_encode($template);
    }

    public function http_request($url,$data=null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}