<?php
namespace Home\Controller;
use Home\Model\UserModel;


class UserController extends HomeController{
    public function register(){
        if(IS_AJAX) {
            $User = D('User');
            $Uid=$User->register(I('post.user'), I('post.password'), I('post.repassword'), I('post.email'));
            echo $Uid;
        }
    }

    public function CheckUser(){
        if(IS_AJAX){
            $User = D('User');
            $Uid=$User->CheckField(I('post.user'),'user');
            echo $Uid>0 ? 'true' : 'false';
        }
    }

    public function CheckEmail(){
        if(IS_AJAX){
            $User = D('User');
            $Uid=$User->CheckField(I('post.email'),'email');
            echo $Uid>0 ? 'true' : 'false';
        }
    }

    public function CheckVerify(){
        if(IS_AJAX){
            $User = D('User');
            $Uid=$User->CheckField(I('post.verify'),'verify');
            echo $Uid>0 ? 'true' : 'false';
        }
    }

    public function CheckLogin(){
        if(IS_AJAX){
            $User = D('User');
            $Uid=$User->Login(I('post.user'), I('post.password'),I('post.auto'));
            echo $Uid;
        }
    }

    public function Loginout(){
        session(null);
        cookie('auto',null);
        $this->success('退出成功！', U('Login/index'));
    }
}