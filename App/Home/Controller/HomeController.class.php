<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {
    //获取已读条数
    public function getRefer(){
        if(IS_AJAX) {
            /*$Refer = D('Refer');
            $referCount = $Refer->getReferCount(session('user_auth')['id']);
            echo $referCount;*/
            echo S('refer'.session('user_auth')['id']);
        }else{
            $this->error('非法访问');
        }
    }

    //免登录
    public function login(){
        if (!is_null(cookie('auto')) && !session('?user_auth')) {
            $username = encryption(cookie('auto'), 1);
            $map['user'] = $username;
            $User = D('User');
            $userObj = $User->field('id,user')->where($map)->find();

            $update = array(
                'id'=>$userObj['id'],
                'last_time'=>NOW_TIME,
            );
            $User->save($update);



            //将记录写入到cookie和session中去
            $auth = array(
                'id'=>$userObj['id'],
                'user'=>$userObj['user'],
                'last_time'=>NOW_TIME,
            );

            //写入到session
            session('user_auth', $auth);
        }

        if(session('?user_auth')){
            return 1;
        }else{
            $this->redirect('Login/index');
        }

    }
}