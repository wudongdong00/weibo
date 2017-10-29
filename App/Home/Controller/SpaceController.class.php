<?php
namespace Home\Controller;

class SpaceController extends HomeController
{
    public function index($id = 0,$domin=''){
        if ($this->login()) {
            if ($id == 0 && $domin=='') $this->error('非法访问！');
            $User = D('User');
            $getUser = $User->getUser($id);
            if ($getUser) {
                $this->assign('user', $getUser);
                $this->assign('bigFace', json_decode($getUser[0]['face'])->big);
                $this->display();
            } else {
                $this->error('不存在此用户！');
            }
            if ($domin) {
                $getUser = $User->getUser2($domin);
                if ($getUser) {
                    $this->assign('user', $getUser);
                    $this->assign('bigFace', json_decode($getUser[0]['face'])->big);
                    $this->display();
                } else {
                    $this->error('不存在此用户！');
                }
            }
        }
    }

    public function setUrl($user=''){
        if (IS_AJAX && $user != '') {
            $User=D('User');
            $getUser=$User->getUser3($user);
            if(is_array($getUser)) {
                if (empty($getUser['domin'])) {
                    echo U('Space/index', array('id' => $getUser['id']));
                } else {
                    echo __ROOT__ . '/' . 'i/' . $getUser['domin'];
                }
            }
        } else {
            $this->error('非法访问！');
        }

    }
}