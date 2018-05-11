<?php
namespace Home\Controller;
class IndexController extends BaseController {
    public function index() {
        if($this->isLogin()){
            $this->display("/index");
        } else {
            $this->display("/login");
        }
    }
    //跳转到登录页面
    public function toLogin() {
        $this->display("/login");
    }

    //登录
    public function login() {
        session_start();
        $m = D("Driver");
        $rs = $m->login();
        $username = I('post.mobile_number');
        if ($rs) {
            $_SESSION['userLogined'] = true;
            $_SESSION['username1'] = $username;
            $this->ajaxReturn("/".$rs);
        } else {
            $_SESSION['userLogined'] = false;
            $this->ajaxReturn("登录失败");
        }
    }

    //判断是否登录
    public function isLogin() {
        if (isset($_SESSION['userLogined']) && $_SESSION['userLogined']) {
            return true;
        } else {
            $this->toLogin();
            return false;
        }
    }

    //退出登录
    public function loginOff() {
        session_destroy();
        $this->ajaxReturn("成功退出");
    }

    //跳转到公共订单页面
    public function toPublicOrder() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->selectUnTaking();
            $select->selectUnFinish();
            $select->selectFinish();
            $this->display("/publicOrder");
        }
    }

    //跳转到修改密码页面
    public function toAlertPassword() {
        if ($this->isLogin()) {
            $this->display("/alertPassword");
        }
    }

    //修改密码
    public function alertPassword() {
        $m = D("Driver");
        $rs = $m->alertPassword();
        echo $rs;
    }

    //跳转到订单详情页面
    public function toOrderDetail() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->showOrderDetail();
            $this->display("/orderDetail");
        }
    }

    //跳转到个人订单页面
    public function toPersonalOrder() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->selectPersonalUnFinish();
            $this->display("/personalOrder");
        }
    }

    //跳转到接订单页面
    public function toPersonalUnTakingOrder() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->selectUnTaking();
            $this->display("/personalUnTakingOrder");
        }
    }

    //跳转到个人订单详情页面，从个人订单已接订单进入
    public function toPersonalOrderDetail() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->showPersonalOrderDetail();
            $this->display("/personalOrderDetail");
        }
    }

    //跳转到个人订单管理页面
    public function toPersonalOrderManage() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->selectPersonalUnFinish();
            $select->selectPersonalFinish();
            $this->display("/personalOrderManage");
        }
    }

    //跳转到完成订单详情页面，从订单管理进入
    public function toFinishOrderDetail() {
        if ($this->isLogin()) {
            $select = A("Order");
            $select->showFinishOrderDetail();
            $this->display("/finishOrderDetail");
        }
    }

    //跳转到个人管理页面
    public function toPersonalMessage() {
        if ($this->isLogin()) {
            $select = A("Driver");
            $select->showDriverMessage();
            $this->display("/personalMessage");
        }
    }
}