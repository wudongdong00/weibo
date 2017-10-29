<?php
namespace Home\Controller;

class IndexController extends HomeController {
        public function index(){
            if ($this->login()) {
                $Topic=D('Topic');
                $topicList=$Topic->getList(0,10);
                $this->assign('topList',$topicList);
                $this->assign('smallFace',session('user_auth')['face']->small);
                $this->assign('bigFace',session('user_auth')['face']->big);
                S('user'.session('user_auth')['id'], NOW_TIME);
                $this->display();
            }
        }

        public function getWeibo() {
        //将要推送的微博 ID 集合//
            $ids = array();
            $weibo = S('weibo31');
            foreach ($weibo as $value) {
                if ($value[1] > S('user'.session('user_auth')['id'])) {
                    $ids[] = $value[0];
                }
            }
            $this->ajaxReturn($ids);
        }


}