<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 16:42
 */

namespace Admin\Controller;

class IndexController extends BaseController {
    //跳转到主页
    public function index() {
        if($this->isLogin()){
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/index");
        }
    }

    //登录，用session存放判断
    public function login() {
        session_start();
        $username = I('post.username');
        $m = D("Manager");
        $rs = $m->login();
        if ($rs == 1) {
            $_SESSION['logined'] = true;
            $_SESSION['username'] = $username;
            $this->ajaxReturn("登录成功");
        } else {
            $_SESSION['logined'] = false;
            $this->ajaxReturn("登录失败");
        }
    }

    //退出登录
    public function loginOff() {
        session_destroy();
        $this->ajaxReturn("成功退出");
    }

    //判断是否登录
    public function isLogin() {
        if (isset($_SESSION['logined']) && $_SESSION['logined']) {
            return true;
        } else {
            $this->toLogin();
            return false;
        }
    }

    //跳转到登录页面
    public function toLogin() {
        $this->display("/login");
    }

    //跳转到修改密码页面
    public function toAlertPassword() {
        if($this->isLogin()) {
            $this->display("/alertPassword");
        }
    }

    //修改密码
    public function alertPassword() {
        $m = D("Manager");
        $rs = $m->alertPassword();
        echo $rs;
    }

    //跳转到新添订单页面
    public function toOrder() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/order");
        }
    }

    //跳转到订单管理页面
    public function toOrderManage() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $m = A("Order");
            $m->selectAllVehicle();
            $m->selectAllOil();
            $permissions->findPermissions();
            $this->display("/orderManage");
        }
    }

    //跳转到司机管理页面
    public function toDriver() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/driverManage");
        }
    }

    //跳转到车辆管理页面
    public function toVehicle() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/vehicle");
        }
    }

    //跳转到权限管理页面
    public function toRole() {
        if($this->isLogin()){
            $Role = A("Role");
            $Role->role();
            $Role->user();
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/role");
        }
    }

    //跳转到商品管理页面
    public function toGoods() {
        if($this->isLogin()) {
            $this->display("/goods");
        }
    }

    //跳转到后台用户管理页面
    public function toUser() {
        if($this->isLogin()) {
            $Role = A("Role");
            $Role->role();
            $Role->user();
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/user");
        }
    }

    //跳转到日记管理页面
    public function toLogManage() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/logManage");
        }
    }

    public function toDriverManage() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/driverManage");
        }
    }

    public function toOilManage() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/oilManage");
        }
    }

    public function toDataManage() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/dataManage");
        }
    }

    public function toNoticeManage() {
        if($this->isLogin()) {
            $permissions = A("Role");
            $permissions->findPermissions();
            $this->display("/noticeManage");
        }
    }
}