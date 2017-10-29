<?php
namespace Home\Controller;


use Think\Verify;

class LoginController extends HomeController{
    public function index(){
        if (!session('?user_auth')) {
            $this->display();
        } else {
            $this->redirect('Index/index');
        }
    }

    public function verify(){
        $verify = new Verify();
        $verify->bg=array(179,223,218);
        $verify->length=4;
        $verify->entry(1);

    }
}