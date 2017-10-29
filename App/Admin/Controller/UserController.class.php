<?php
namespace Admin\Controller;
class UserController extends AuthController {
    public function index()
    {
        if(session('admin')) {
            $this->display();
        }else{
            $this->redirect('Login/index');
        }
    }

    public function getList(){
        if(IS_AJAX){
            $User=D('User');
            $this->ajaxReturn($User->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),I('post.username'),I('post.date_from'),I('post.date_to')));
        }else{
            echo "非法操作";
        }
    }

    public function remove(){
        if(IS_AJAX){
            $User=D('User');
            echo $User->remove(I('post.ids'));
        }else{
            echo "非法操作";
        }
    }

    public function register(){
        if(IS_AJAX){
            $User=D('User');
            echo $User->register(I('post.user'),I('post.password'),I('post.email'),I('post.intro'));
        }else{
            echo "非法操作";
        }
    }

    public function getUser()
    {
        if (IS_AJAX) {
            $User = D('User');
            $this->ajaxReturn($User->getUser(I('post.id')));
        } else {
            echo "非法操作";
        }
    }

    public function saveUser(){
        if (IS_AJAX) {
            $User = D('User');
            echo $User->saveUser(I('post.id'),I('post.password'),I('post.email'),I('post.intro'),I('post.source_intro'));
        } else {
            echo "非法操作";
        }
    }
}