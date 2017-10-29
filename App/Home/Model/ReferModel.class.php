<?php
namespace Home\Model;

use Think\Model\RelationModel;

class ReferModel extends RelationModel {

    protected $_auto = array(
        array('create', 'time', self::MODEL_INSERT, 'function'),
    );

    protected $_link=array(
        'refer'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'class_name'=>'Topic',
            'foreign_key'=>'tid',
            'mapping_fields'=>'content'
        ),
    );

    //存取@数据
    public function referTo($uid,$tid){
        $data = array(
            'uid' => $uid,
            'tid' => $tid
        );
        if ($this->create($data)){
            $rid = $this->add();
            if(S('refer'.$uid)){
                $count=S('refer'.$uid);
                S('refer'.$uid,$count + 1);
            }else{
                S('refer'.$uid,1);
            }
            return $rid ? $rid : 0;
        }else{
            return $this->getError();
        }
    }

    //获取@数据
    public function getRefer($uid){
        $map['uid']=$uid;
        $count = S('refer'.session('user_auth')['id']);
        S('refer'.session('user_auth')['id'],$count-1);
        return $this->relation(true)->field('id,uid,tid,read')->where($map)->select();
    }

    //更新已读
    public function readRefer($id) {
        $map['id'] = $id;
        return $this->where($map)->save(array('read'=>1));
    }

    //获取@数量
    public function getReferCount($uid){
        $map = array(
            'uid' => $uid,
            'read'=>0
        );
        return $this->where($map)->count();
    }

}