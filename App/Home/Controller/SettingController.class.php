<?php
namespace Home\Controller;

class SettingController extends HomeController {
    //显示资料
    public function index(){
        if ($this->login()) {
            $user=D('User');
           $this->assign('user',$user->getUser());
           $this->display();
        }else{
            $this->error('非法访问');
        }
    }

    //更新个人资料
    public function updateUser(){
        if(IS_AJAX){
            $user=D('User');
            $uid=$user->updateUser(I('post.email'),I('post.info'));
            echo $uid;
        }else{
            $this->error('非法访问');
        }
    }

    //找到头像
    public function infoPic(){
        if ($this->login()) {
            $user=D('User');
            $user->findFace();
            $this->assign('bigFace',$user->findFace());
            $this->display();
        }else{
            $this->error('非法访问');
        }
    }

    //获取已读数据
    public function refer(){
        if ($this->login()) {
            $Refer=D('Refer');
            $getRefer=$Refer->getRefer(session('user_auth')['id']);
            print_r($getRefer);
            $this->assign('getRefer',$getRefer);
            $this->display();
        }else{
            $this->error('非法访问');
        }
    }

    public function readRefer() {
        if (IS_AJAX) {
            $Refer = D('Refer');
            $rid = $Refer->readRefer(I('post.id'));
            echo $rid;
        } else {
            $this->error('非法访问！');
        }
    }
}