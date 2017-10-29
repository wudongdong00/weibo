<?php
namespace Home\Controller;

class TopicController extends HomeController{
    public function Publish(){
        if(IS_AJAX){
            $Topic=D('Topic');
            $pic=$Topic->publish(I('post.content'),session('user_auth')['id']);
            if($pic){
                $img=I('post.img','',false);
                if(is_array($img)) {
                    $Image = D('Image');
                    $tid = $Image->SaveImg($img, $pic);
                    echo $tid ? $pic : 0;
                }else{
                    echo $pic;
                }
            }
        }else{
            $this->error('非法访问');
        }
    }

    //ajax获取微博列表
    public function ajaxList(){
        if(IS_AJAX) {
            $Topic = D('Topic');
            $ajaxList = $Topic->getList(I('post.first'), 10);
            $this->assign('ajaxList', $ajaxList);
            $this->display();
        }else{
            $this->error('非法访问');
        }
    }
    //转发微博
    public function reBoard(){
        if(IS_AJAX) {
            $Topic = D('Topic');
            $pic=$Topic->publish(I('post.content'),session('user_auth')['id'],I('post.reid'));
            echo $pic;
        }else{
            $this->error('非法访问');
        }
    }

    //ajax获取微博总页数
    public function ajaxCount(){
        if(IS_AJAX) {
            $Topic = D('Topic');
            $count = $Topic->where('1=1')->count();
            echo ceil($count/10);
        }else{
            $this->error('非法访问');
        }
    }
}