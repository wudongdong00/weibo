<?php
namespace Home\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel {
    protected $_auto = array(
        array('password', 'sha1', self::MODEL_BOTH, 'function'),
    );



    protected $_validate = array(
        array('user','2,16',-1,0,'length'),
        array('password','2,16',-2,0,'length'),
        array('repassword','password',-3,0,'confirm'),
        array('email','email',-4,0),
        array('user','',-5,0,'unique',self::MODEL_INSERT),
        array('email','',-6,0,'unique',self::MODEL_INSERT),
        array('verify','Check_verify',-7,0,'function'),
        array('login_user','2,50',-8,0,'length'),
        array('login_user','email',noemail,0),
    );

    protected $_link=array(
        extend=>array(
          'mapping_type'=>self::HAS_ONE,
            'class_name'=>'Extend',
            'foreign_key'=>'uid',
            'mapping_fields'=>'info'
        ),
    );
        //  注册
    public function register($user,$password,$repassword,$email) {
        $data = array(
            'user'=>$user,
            'password'=>$password,
            'repassword'=>$repassword,
            'domin'=>substr(md5($user),0,10),
            'email'=>$email,
        );
        if ($this->create($data)){
            $Uid = $this->add();
            return $Uid ? $Uid : 0;
        }else{
            return $this->getError();
        }
    }

    public function CheckField($Field,$type){
        $data = array();
            switch($type){
                case 'user' :
                    $data['user']=$Field;
                    break;
                case 'email' :
                    $data['email']=$Field;
                    break;
                case 'verify' :
                    $data['verify']=$Field;
                    break;
                default :
                    return 0;
            }
        return $this->create($data) ? 1 :$this->GetError();
    }

    public function Login($user,$password,$auto){
        $map=array();
        $data = array(
            'login_user'=>$user,
            'password'=>$password,
        );
        if ($this->create($data)){
            $map['email']=$user;
        }else{
            if($this->getError()=='noemail'){
                $map['user']=$user;
            }else{
                return $this->getError();
            }
        }

        $find=$this->field('id,password,user,face')->where($map)->find();
        if ($find['password'] == sha1($password)){
            //登录验证后写入登录信息
            $update = array(
                'id'=>$find['id'],
                'last_time'=>NOW_TIME,
                'last_ip'=>get_client_ip(1),
            );
            $this->save($update);

            //将记录写入到cookie和session中去
            $auth = array(
                'id'=>$find['id'],
                'user'=>$find['user'],
                'face'=>json_decode($find['face']),
                'last_time'=>NOW_TIME,
            );

            //写入到session
            session('user_auth', $auth);

            if ($auto == 'on') {
                cookie('auto', encryption($find['user']), 3600 * 24 * 30);
            }

            return $find['id'];
        }else {
            return -9;
        }
    }
        //  一对一关联查询
    public function getUser($id = 0){
        if($id==0){
            $map['id']=session('user_auth')['id'];
        }else{
            $map['id']=$id;
        }
        $user= $this->relation(true)->field('id,user,email,face')->where($map)->select();
        if (!is_array($user[0]['extend'])) {
            $data = array(
                'uid'=>$map['id'],
            );
            $Extend = M('Extend');
            $Extend->add($data);
        }
        return $user;
    }

    public function getUser2($domin) {
        $map['domin'] = $domin;
        $user = $this->relation(true)->field('id,user,email,face')->where($map)->select();
        return $user;
    }

    public function getUser3($user) {
        $map['user'] = $user;
        $user = $this->field('id,domin')->where($map)->find();
        return $user;
    }
    //一对一修改用户资料
    public function updateUser($email,$info){
        $data=array(
            'email'=>$email,
            'extend'=>array(
                'info'=>$info,
            ),
        );
        $map['id'] = session('user_auth')['id'];
        return $this->relation(true)->where($map)->save($data);
    }

    public function saveFace($face){
        $data=array(
            'face'=>$face
        );
        $map['id'] = session('user_auth')['id'];
        return $this->where($map)->save($data);
    }

    public function findFace(){
        $map['id'] = session('user_auth')['id'];
        return json_decode($this->field('face')->where($map)->find()['face'])->big;
    }
}