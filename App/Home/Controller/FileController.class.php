<?php
namespace Home\Controller;

class FileController extends HomeController{
    public function image() {
        $image = D('Image');
        $this->ajaxReturn($image->image());
    }

    public function face() {
        $image = D('Image');
        $this->ajaxReturn($image->face());
    }

    public function savePic(){
        $image=D('Image');
        $img=$image->savePic(I('post.x'),I('post.y'),I('post.w'),I('post.h'),I('post.url'));
        $User=D('User');
        $User->saveFace(json_encode($img));
        echo json_encode($img);
    }

}