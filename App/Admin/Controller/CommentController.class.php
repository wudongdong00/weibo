<?php
namespace Admin\Controller;

class CommentController extends AuthController {

    //显示评论列表
    public function index(){
        $this->display();
    }

    //获取评论数据
    public function getList() {
        if (IS_AJAX) {
            $Comment = D('Commend');
            $this->ajaxReturn($Comment->getList(I('post.page'),I('post.rows'), I('post.sort'), I('post.order')));
        } else {
            $this->error('非法操作！');
        }
    }

}