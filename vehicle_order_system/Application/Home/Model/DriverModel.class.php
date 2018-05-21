<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:39
 */

namespace Home\Model;

class DriverModel extends BaseModel {

    public function uploadProfilePhoto() {
        $m = M("driver");
        $file = $_FILES;
        $name = $_SESSION["username1"];
        $src = "Application/Common/img/".$name.'.png';
        $res = move_uploaded_file($_FILES['upFile']['tmp_name'], $src);
        var_dump($file);
        $data["head_path"] = $src;
        $result = $m->where(array('mobile_number'=>$name))->save($data);
//        return $result;
    }

    public function showDriverMessage() {
        $m = M("driver");
        $data["mobile_number"] = $_SESSION['username1'];
        $result = $m->where($data)->select();
        return $result;
    }

    public function addDriver() {
        $m = M("driver");
        $W = M("wechat");
        session_start();
        $openid = $_SESSION["openid"];
        $wechat_id = $W->where(array("openid" => $openid))->getField("id");
        $ifExist = $m->where(array("wechat_id" => $wechat_id))->select();

        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        $data["number"] = $nowTime.$sixRand;
        $data["wechat_id"] = $wechat_id;
        $data["name"] = I("post.name");
        $data["license_plate"] = I("post.license_plate");
        $data["mobile_number"] = I("post.mobile_number");
        $data["company"] = I("post.company");

        if($ifExist) {
            $data['update_time'] = date("Y-m-d h:i:s");
            $result = $m->where(array("wechat_id" => $wechat_id))->save($data);
        } else {
            $data['create_time'] = date("Y-m-d h:i:s");
            $result = $m->data($data)->add();
        }

        return $result;
    }
}