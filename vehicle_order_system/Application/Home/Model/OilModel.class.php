<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Home\Model;

class OilModel extends BaseModel {

    public function addOil() {
        $m = M("oil");
        $L = A("Log");

        $nowTime = date("Ymdhis");
        $sixRand = rand('100000', '999999');
        $data["number"] = $nowTime.$sixRand;

        $data['name'] = trim(I('post.name'));
        $data['type'] = trim(I('post.oilType'));
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();
        $L->insert("添加了编号为：".$data['number']."  油名为：".$data['name']);
        return $result;
    }

    public function searchOil() {
        $m = M("Oil");
        $data['type'] = I("post.type");
        $data["status"] = 1;
        $result = $m->where($data)->order('id desc')->getField("name", true);
        return $result;
    }

    public function deleteOil() {
        $m = M("Oil");
        $L = A("Log");
        $name = I("post.name");
        $number = I("post.number");
        $L->insert("删除了编号为：".$number."  油名名为：".$name);
        $m->where(array("id"=>I('post.id')))->save(array("status" => "0"));
        echo "1";
    }


    public function searchPermissions() {
        $m = M("Manager");
        $R = M("Role");
        $page = I('get.page');
        $limit = I('get.limit');
        $data['create_time'] = array('neq', 0);
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key2 == "role_id" && $key2 != null) {
                    $result[$key]["role_name"] = $R->where(array("id" => $value2))->getField("name");
                }
            }
        }
        return $result;
    }

    public function addPermissions() {
        $m = M("manager");
        $R = M("role");

        $L = A("Log");
        $data['username'] = trim(I('post.username'));
        $roleName = trim(I('post.roleName'));
        $data2['role_id'] = $R->where(array("name" => $roleName))->getField("id");
        $data2['update_time'] = date("Y-m-d h:i:s");
        $result = $m->where($data)->save($data2);
        $L->update("“".$data['username']."”的角色名修改为：".$roleName);
        return $result;
    }

    public function findPermissions() {
        $m = M("manager");
        $R = M("role");
        $data["username"] = $_SESSION["username"];
        $result["id"] = $m->where($data)->getField("role_id");
        $result2 = $R->where($result)->select();
        return $result2;
    }
}