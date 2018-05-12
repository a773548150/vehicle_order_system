<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class LogModel extends BaseModel {

    public function insert($insertData) {
        $L = M("log");
        $username= $_SESSION['username'];
        $data["log"] = "$insertData";
        $data["create_time"] = date("Y-m-d h:i:s");
        $data["username"] = $username;
        $res = $L->data($data)->add();
        return $res;
    }

    public function update($updateData) {
        $L = M("log");
        $username= $_SESSION['username'];
        $data["log"] = "$updateData";
        $data["create_time"] = date("Y-m-d h:i:s");
        $data["username"] = $username;
        $res = $L->data($data)->add();
        return $res;
    }

    public function delete($deleteData) {
        $L = M("log");
        $username= $_SESSION['username'];
        $data["log"] = "$deleteData";
        $data["create_time"] = date("Y-m-d h:i:s");
        $data["username"] = $username;
        $res = $L->data($data)->add();
        return $res;
    }

    public function searchLog() {
        $m = M("log");
        $startTime = I("get.startTime");
        $endTime = I("get.endTime");
        if ($startTime && $endTime) {
            $data["create_time"] = array(array('egt', $startTime), array('elt', $endTime));
        }
        $page = I('get.page');
        $limit = I('get.limit');
        $data['status'] = 1;
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
        return $result;
    }

    public function deleteLog() {
        $m = M("log");
        $id = I("post.id");
        $data['status'] = 0;
        $data['delete_time'] = date("Y-m-d h:i:s");
        $res = $m->where(array("id" => $id))->save($data);
        return $res;
    }
}