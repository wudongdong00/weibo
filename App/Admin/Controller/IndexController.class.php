<?php
namespace Admin\Controller;

use Think\Auth;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        if (session('admin')) {
        $this->display();
        }else {
        $this->redirect('Login/index');
        }
    }

    public function getNav(){
        $Auth = new Auth();

        $groups = $Auth->getGroups(session('admin')['id'])[0]['rules'];

        $AuthRule = M('AuthRule');
        $map['id'] = array('in', $groups);
        $obj = $AuthRule->field('title')->where($map)->select();

        $texts = '';

        foreach ($obj as $key=>$value) {
            $texts .= $value['title'].',';
        }

        $Nav = D('Nav');
        $this->ajaxReturn($Nav->getNav(I('post.id'), substr($texts, 0, -1)));
    }
}