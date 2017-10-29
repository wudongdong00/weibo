<?php
namespace Home\Controller;

class CommendController extends HomeController{
    public function Publish(){
        if(IS_AJAX){
           $Commend=D('Commend');
           $cid=$Commend->Publish(I('post.content'),session('user_auth')['id'],I('post.tid'));
           echo $cid;
        }else{
            $this->error('非法访问');
        }
    }
    public function getList(){
        if(IS_AJAX) {
            $Commend = D('Commend');
            $getList = $Commend->getList(I('post.tid'), I('post.page'));
            $this->assign('getList', $getList['list']);
            $this->assign('total', $getList['total']);
            $this->assign('page', I('post.page'));
            $this->display();
        }else{
            $this->error('非法访问');
        }

    }
}