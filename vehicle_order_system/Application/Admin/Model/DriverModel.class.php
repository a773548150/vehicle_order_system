<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class DriverModel extends BaseModel {

    public function addDriver() {
        $m = M("driver");
        $C = A("Driver");
        $data['mobile_number'] = trim(I('post.mobile_number'));
        $data['password'] = md5(trim(I('post.password')));
        $data['name'] = trim(I('post.name'));
        $data['number'] = $C->driverNumber();
        $result = $m->data($data)->add();
        return $result;
    }

    public function searchDriver() {
        $m = M("driver");
        $data['name'] = array('LIKE', "%".I('get.name')."%");
        $data['status'] = 1;
        $page = I('get.page');
        $limit = I('get.limit');
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
        return $result;
    }

    public function deleteDriver() {
        $m = M("driver");
        $data["id"] = I("post.id");
        $data2["status"] = 0;
        $result = $m->where($data)->save($data2);
        echo $result;
    }

    public function editDriver() {
        $m = M("driver");
        $field = I('post.field');
        $value = I('post.value');
        $lim["id"] = I('post.id');
        $data[$field] = $value;
        $res = $m->where($lim)->save($data);
        return $res;
    }
}