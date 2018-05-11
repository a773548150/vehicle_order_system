<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class VehicleModel extends BaseModel {

    public function addVehicle() {
        $m = M("Vehicle");
        $data['license_plate'] = trim(I('post.license_plate'));
        $data['vin'] = trim(I('post.vin'));
        $result = $m->data($data)->add();
        return $result;
    }

    public function searchVehicle() {
        $m = M("Vehicle");
        $data['license_plate'] = array('LIKE', "%".I('get.license_plate')."%");
        $data['status'] = 1;
        $page = I('get.page');
        $limit = I('get.limit');
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
        return $result;
    }

    public function deleteVehicle() {
        $m = M("Vehicle");
        $data["id"] = I("post.id");
        $data2["status"] = 0;
        $result = $m->where($data)->save($data2);
        echo $result;
    }

    public function editVehicle() {
        $m = M("Vehicle");
        $field = I('post.field');
        $value = I('post.value');
        $lim["id"] = I('post.id');
        $data[$field] = $value;
        $res = $m->where($lim)->save($data);
        return $res;
    }
}