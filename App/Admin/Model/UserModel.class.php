<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class UserModel extends RelationModel {
    protected $_auto = array(
        array('password','sha1',self::MODEL_BOTH,'function')
    );

    protected $_validate = array(
//-1,'帐号长度不合法！'
        array('user', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
//-2,'密码长度不合法！'
        array('password', '6,30', -2, self::EXISTS_VALIDATE,'length'),
//-2,'密码长度不合法！'
        array('password', '6,30', -2, self::VALUE_VALIDATE,'length', self::MODEL_UPDATE),
//-3,'邮箱格式不正确！'
        array('email', 'email', -3, self::EXISTS_VALIDATE),
//-5,'帐号被占用！'
        array('user', '', -4, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
//-6,'邮箱被占用！'
        array('email', '', -5, self::EXISTS_VALIDATE, 'unique', self::MODEL_UPDATE),

);
    protected $_link=array(
        extend=>array(
            'mapping_type'=>self::HAS_ONE,
            'class_name'=>'Extend',
            'foreign_key'=>'uid',
            'mapping_fields'=>'info'
        ),
    );

    //获取用户的所有资料
    public function getList($page,$rows,$sort,$order,$username,$date_from,$date_to){
        $map='';
        if($username){
            $map['user'] = array("like", "%".$username."%");
        }

        if ($date_from && $date_to) {
            $map['last_time'] = array(array('egt', strtotime($date_from)), array('elt', strtotime($date_to)));
        } else if ($date_from) {
            $map['last_time'] = array('egt', strtotime($date_from));
        } else if ($date_to) {
            $map['last_time'] = array('elt', strtotime($date_to));
        }

        $obj=$this->field('id,user,email,domin,last_time')
                  ->where($map)
                  ->limit($rows * ($page-1),$rows)
                  ->order(array($sort=>$order))
                  ->select();


        foreach ($obj as $key=>$value) {
            $obj[$key]['last_time'] = date("Y-m-d H:i:s", $value['last_time']) ;
        }
        return array(
            'total' => $this->where($map)->count(),
            'rows' => $obj ? $obj : '',
        );
    }

    //删除用户
    public function remove($ids){
        $this->relation(true)->delete($ids);
    }

    //新增一个用户
    public function register($user,$password,$email,$intro){
        $data = array(
            'user' => $user,
            'password' => $password,
            'email' => $email,
        );
        if($this->create($data)){
            $data['password'] = sha1($password);
            $uid=$this->relation(true)->add($data);
            return $uid ? $uid : 0;
        }else{
            return $this->getError();
        }
    }

    public function getUser($id){
        $map['id'] = $id ;
       $user= $this->relation(true)->field('id,user,email')->where($map)->find();
       return $user;
    }

    public function saveUser($id,$password,$email,$intro,$source_intro){
        $data = array(
            'id' => $id,
            'email' => $email,
            'extend' => array(
                'info' =>  $intro
            ),
        );

        if ($password) {
            $data['password'] = $password;
        }

        if($this->create($data)){
            if ($password) {
                $data['password'] = sha1($password);
            }
            $uid =$this->relation(true)->save($data);
            if ($uid || $intro != $source_intro) {
                return 1;
            } else {
                return 0;
            }
        }else{
            return $this->getError();
        }
    }
}