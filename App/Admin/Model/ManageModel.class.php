<?php
namespace Admin\Model;

use Think\Model;

class ManageModel extends Model{
    protected $_validate = array(
        array('manager','2,16',-1,0,'length'),
        array('password','6,30',-2,0,'length'),
    );

    //管理员认证
    public function checkManage($manager,$password){
        $data=array(
            'manager'=>$manager,
            'password'=>$password
        );

        if($this->create($data)){
            $map['manager'] = $manager;
            $map['password'] = sha1($password);
            $obj = $this->field('id,manager')->where($map)->find();
            if ($obj) {
                session('admin', array(
                    'id'=>$obj['id'],
                    'manager'=>$obj['manager'],
                ));
                $update = array(
                    'id' => $obj['id'],
                    'last_time' => NOW_TIME,
                );
                $this->save($update);
                return $obj['id'];
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }
}