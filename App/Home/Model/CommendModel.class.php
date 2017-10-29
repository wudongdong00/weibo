<?php
namespace Home\Model;

use Think\Model;

class CommendModel extends Model {

    protected $_auto = array(
        array('create', 'time', self::MODEL_INSERT, 'function'),
    );

    //发布的评论入库
    public function publish($Content, $uid,$tid){

        $data=array(
            'content'=>$Content,
            'uid'=>$uid,
            'tid'=>$tid,
        );

        if ($this->create($data)){
            $cid = $this->add();
            if($cid){
                $Topic=D('Topic');
                $Topic->comCount($tid);
                return $cid;
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }
    //获取评论列表
    public function getList($tid,$page){
        $count=$this->table('__COMMEND__ a,__USER__ b')
            ->field('a.id,a.content,a.tid,a.uid,a.create,b.user,b.domin')
            ->order('a.create DESC')
            ->where('a.uid=b.id AND a.tid='.$tid)
            ->count();

        //得到总页数
        $total = ceil($count / 2);

        //当前first
        $first = ($page - 1) * 2;

        $list = $this->format($this->table('__COMMEND__ a,__USER__ b')
                    ->field('a.id,a.content,a.tid,a.uid,a.create,b.user,b.domin')
                    ->order('a.create DESC')
                    ->where('a.uid=b.id AND a.tid='.$tid)
                    ->limit($first,2)
                    ->select());

        $obj = array(
            'list'=>$list,
            'total'=>$total,
        );

        return $obj;
    }

    //格式化
    private function format($list)
    {
        foreach ($list as $key => $value) {
            //时间解析
            $time = NOW_TIME - $list[$key]['create'];
            if ($time < 60) {
                $list[$key]['time'] = '刚刚发布';
            } else if ($time < 60 * 60) {
                $list[$key]['time'] = floor($time / 60) . '分钟之前';
            } else if (date('Y-m-d') == date('Y-m-d', $list[$key]['create'])) {
                $list[$key]['time'] = '今天' . date('H:i', $list[$key]['create']);
            } else if (date("Y-m-d", strtotime("-1 day")) == date('Y-m-d', $list[$key]['create'])) {
                $list[$key]['time'] = '昨天' . date('H:i', $list[$key]['create']);
            } else if (date('Y') == date('Y', $list[$key]['create'])) {
                $list[$key]['time'] = date('m月d日 H:i', $list[$key]['create']);
            } else {
                $list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['create']);
            }

            //解析@帐号
            $list[$key]['content'] .= ' ';
            $pattern = '/(@\S+)\s/i';
            $list[$key]['content'] = preg_replace($pattern, '<a href="' . __ROOT__ . '/$1" class="space" target="_blank">$1</a>', $list[$key]['content']);
        }
        return $list;
    }

}