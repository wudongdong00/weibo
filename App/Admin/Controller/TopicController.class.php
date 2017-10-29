<?php
namespace Admin\Controller;
class TopicController extends AuthController {

    //显示微博列表
    public function index(){
            $this->display();
    }

    //获取微博数据
    public function getList() {
        if (IS_AJAX) {
            $Topic = D('Topic');
            $this->ajaxReturn($Topic->getList(I('post.page'),I('post.rows'), I('post.sort'), I('post.order')));
        } else {
            $this->error('非法操作！');
        }
    }
}