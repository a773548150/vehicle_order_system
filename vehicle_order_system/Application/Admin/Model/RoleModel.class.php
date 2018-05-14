<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class RoleModel extends BaseModel {
    public function role() {
        $m = M("role");
        $data["status"] = 1;
        $result = $m->where($data)->getField("name", true);
        return $result;
    }
    public function user() {
        $m = M("manager");
        $data['create_time'] = array('neq', 0);
        $data["status"] = 1;
        $result = $m->where($data)->getField("username", true);
        return $result;
    }
    public function addRole() {
        $m = M("Role");
        $L = A("Log");

        $data['name'] = trim(I('post.name'));
        $data['manage_order'] = I('post.manage_order') == "on" ? "1" : "0";
        $data['manage_user'] = I('post.manage_driver') == "on" ? "1" : "0";
        $data['manage_vehicle'] = I('post.manage_vehicle') == "on" ? "1" : "0";
        $data['manage_oil'] = I('post.manage_vehicle') == "on" ? "1" : "0";
        $data['manage_notice'] = I('post.manage_vehicle') == "on" ? "1" : "0";
        $data['manage_role'] = I('post.manage_role') == "on" ? "1" : "0";
        $data['manage_log'] = I('post.manage_diary') == "on" ? "1" : "0";
        $data['create_time'] = date("Y-m-d h:i:s");
        $result = $m->data($data)->add();

        $L->insert("添加了角色名为：".$data['name']);

        return $result;
    }

    public function searchRole() {
        $m = M("Role");
        $page = I('get.page');
        $data['status'] = 1;
        $limit = I('get.limit');
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();
        return $result;
    }

    public function deleteRole() {
        $m = M("Role");
        $L = A("Log");
        $data["id"] = I("post.id");
        $data2["status"] = 0;
        $data2['delete_time'] = date("Y-m-d h:i:s");
        $result = $m->where($data)->save($data2);
        $name = $this->getRoleName($data["id"]);
        $L->insert("删除了角色名为：".$name);
        echo $result;
    }

    public function getRoleName($data){
        $m = M("Role");
        $name = $m->where(array("id" => $data))->getField("name");
        return $name;
    }

    public function getUserName($data){
        $m = M("manager");
        $name = $m->where(array("id" => $data))->getField("username");
        return $name;
    }

    public function editRole() {
        $m = M("Role");
        $L = A("Log");
        $lim["id"] = I('post.id');
        $data = I('post.value');
        $data['update_time'] = date("Y-m-d h:i:s");
        $res = $m->where($lim)->save($data);
        $name = $this->getRoleName($lim["id"]);
        $L->update("修改角色名：“".$name."”的权限");
        return $res;
    }

    public function addUser() {
        $m = M("manager");
        $r = M("role");
        $L = A("Log");
        $role_id = $r->where(array("name" => I('post.roleName')))->getField("id");
        $data['username'] = trim(I('post.username'));
        $data['password'] = md5(trim(I('post.password')));
        $data['create_time'] = date("Y-m-d h:i:s");
        $data['role_id'] = $role_id;
        $result = $m->data($data)->add();
        $L->insert("添加了用户名为：".$data['username']);
        return $result;
    }

    public function searchUser() {
        $m = M("Manager");
        $r = M("Role");
        $page = I('get.page');
        $limit = I('get.limit');
        $data['create_time'] = array('neq', 0);
        $data["status"] = 1;
        $result = $m->where($data)->order('id desc')->page($page, $limit)->select();

        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2){
                if ($key2 == "role_id" && $key2 != null) {
                    $result[$key]["role_name"] = $r->where(array("id"=>$value2))->getField("name");
                }
            }
        }
        return $result;
    }

    public function deleteUser() {
        $m = M("Manager");
        $L = A("Log");
        $name = $this->getUserName(I('post.id'));
        $L->insert("删除了角色名为：".$name);
        $m->delete(I('post.id'));
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