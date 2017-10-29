<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller{
    public function index(){
        $this->display();
    }

    public function checkManage(){
        if(IS_AJAX){
            $Manage=D('Manage');
            $res=$Manage->checkManage(I('post.manager'),I('post.password'));
            echo $res;
        }else{
            $this->error('非法操作');
        }
    }

    public function Layout(){
        session('admin', null);
        $this->redirect('Login/index');
    }
}