<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 17:05
 */

namespace Admin\Model;

class ManagerModel extends BaseModel {
    public function login() {
//        $up['username'] = $_POST['username'];
//        $up['password'] = $_POST['password'];

        $up['username'] = I('post.username');
        $up['password'] = md5(I('post.password'));
        $data['session_id'] = session_id();
        $m = M("manager");
        $m->where($up)->save($data);
        $result = $m->where($up)->count();
        return $result;
    }

//    public function signUp() {
//        $m = M("manager");
//        $up['username'] = I('post.username');
//        $up['password'] = md5(I('post.password'));
//        $result = $m->data($up)->add();
//        return $result;
//    }

    public function alertPassword() {
        $m = M("manager");
        $data['username'] = I('post.username');
        $data['password'] = md5(I('post.oldPassword'));
        $result = $m->where($data)->getField('id');

        if ($result) {
            $data2['password'] = md5(I('post.newPassword'));
            $result2 = $m->where(array('id'=>$result))->save($data2);
            if ($result2 === 1) {
                return 1;
            }
        } else {
            return 2; //密码错误
        }
    }
}