<?php
namespace Home\Model;

use Think\Model\RelationModel;

class TopicModel extends RelationModel {
    protected $_validate = array(
        array('allContent','1,280',-1,0,'length'),
    );

    protected $_auto = array(
        array('create', 'time', self::MODEL_INSERT, 'function'),
    );

    protected $_link=array(
        'image'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'Image',
            'foreign_key'=>'tid',
            'mapping_fields'=>'data'
        ),
    );
    //发布的主题内容入库
    public function publish($allContent, $uid,$reid = 0,$tid=0){
        $len=mb_strlen($allContent,'utf8');
        $content=$content_over='';
        if($len>255){
            $content=mb_substr($allContent,0,255,'utf8');
            $content_over=mb_substr($allContent,255,25,'utf8');
        }else{
            $content=$allContent;
        }

        $data=array(
            'allContent'=>$allContent,
            'uid'=>$uid,
            'content'=>$content,
        );

        if(!empty($content_over)){
            $data['content_over']=$content_over;
        }

        if($reid > 0){
            $data['reid'] = $reid;
        }
        if ($this->create($data)){
            $tid = $this->add();
            if($tid){
                if (S('weibo'.$uid)) {
                    $weibo = S('weibo'.$uid);
                    $weibo[] = array($tid, NOW_TIME);
                    S('weibo'.$uid, $weibo);
                } else {
                    S('weibo'.$uid, array(array($tid, NOW_TIME)));
                }
                if($reid > 0) $this->reCount($reid,$tid);
                $this->refer($allContent,$tid);
                $map['recount']=0;
                $this->where($tid)->save($map);
                return $tid;
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }


    }

    //  @提醒
    public  function refer($content,$tid){
        $pattern = '/(@\S+)\s/i';
        preg_match_all($pattern,$content,$arr);
        if(!empty($arr[0])){
            $User=D('User');
            $Refer=D('Refer');
            foreach ($arr[0] as$key=>$value){
                $user=substr($value,1);
                $uid=$User->getUser3($user)['id'];
                if($uid){
                    $rid=$Refer->referTo($uid,$tid);
                        if(!$rid){
                            return $this->getError();
                        }
                }
            }
        }
    }

    //被转发的微博加1{}
    private function reCount($reid,$tid) {
        $map['id'] = $reid;
        $this->where($map)->setInc('recount');
        $data['reid'] = $reid;
        $this->where($data)->setInc('recount');
    }

    //被评论的微博加1{}
    public function comCount($tid) {
        $map['id'] = $tid;
        $this->where($map)->setInc('comcount');
    }


    //获取微博发布的内容
    public function getList($first,$total){
        return $this->format($this->relation(true)
            ->table('__TOPIC__ a,__USER__ b')
            ->field('a.id,a.content,a.content_over,a.create,a.uid,a.recount,a.comcount,a.reid,b.user,b.face,b.domin')
            ->limit($first,$total)
            ->order('a.create DESC')
            ->where('a.uid=b.id')
            ->select());
    }

    //格式化Json配图
    public function format($list){
        //print_r($list);
        foreach ($list as $key=>$value){
            if(!is_null($value['image'])) {
                foreach ($value['image'] as $key2 => $value2) {
                    $value['image'][$key2] = json_decode($value2['data'], true);
                }
                $list[$key] = $value;
                $list[$key]['count']=count($value['image']);
                $time = NOW_TIME - $list[$key]['create'];
                if ($time < 60) {
                    $list[$key]['time'] = '刚刚发布';
                } else if ($time < 60 * 60) {
                    $list[$key]['time'] = floor($time / 60).'分钟之前';
                } else if (date('Y-m-d') == date('Y-m-d', $list[$key]['create'])) {
                    $list[$key]['time'] = '今天'.date('H:i', $list[$key]['create']);
                } else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list[$key]['create'])) {
                    $list[$key]['time'] = '昨天'.date('H:i', $list[$key]['create']);
                } else if (date("Y") == date('Y',$list[$key]['create'])) {
                    $list[$key]['time'] = date('m月d日 H:i', $list[$key]['create']);
                } else {
                    $list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['create']);
                }
                $list[$key]['content'] .= $list[$key]['content_over'];
                //图片不转换
                $list[$key]['textarea']=$list[$key]['content'];
                //表情解析
                $list[$key]['content'] = preg_replace('/\[(a|b|c|d)_([0-9])+\]/i', '<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/face/$1/$2.gif" border="0">', $list[$key]['content']);
                //头像解析
                $list[$key]['face']=json_decode($list[$key]['face'])->small;
                //@账号解析
                $list[$key]['content'] .= ' ';
                $pattern = '/(@\S+)\s/i';
                $list[$key]['content']= preg_replace($pattern,'<a href="'.__ROOT__.'/$1" class="space" target="_blank">$1</a> ',$list[$key]['content']);

                if($list[$key]['reid']>0){
                    $list[$key]['recontent']=$this->getRecount($list[$key]['reid']);
                }
            }
        }
       return $list;
    }

    //获取被转发的微博内容
    private function getRecount($reid){
        return $this->format2($this->relation(true)
            ->table('__TOPIC__ a, __USER__ b')
            ->field('a.id,a.content,a.content_over,a.create,a.uid,a.recount,a.reid,b.user,b.face,b.domin')
            ->where('a.uid=b.id AND a.id='.$reid)
            ->find());
    }

    private function format2($list){
        if (!is_null($list['image'])) {
            foreach ($list['image'] as $key=>$value) {
                $list['image'][$key] = json_decode($value['data'], true);
            }
        }
        $list['count'] = count($list['image']);

        //表情解析
        $list['content'] .= $list['content_over'];

        $list['content'] = preg_replace('/\[(a|b|c|d)_([0-9])+\]/i', '<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/face/$1/$2.gif" border="0">', $list['content']);

        //解析@帐号
        $list['content'] .= ' ';
        $pattern = '/(@\S+)\s/i';
        $list['content'] = preg_replace($pattern, '<a href="'.__ROOT__.'/$1" class="space" target="_blank">$1</a>', $list['content']);

        //原微博时间
        $time = NOW_TIME - $list['create'];
        if ($time < 60) {
            $list['time'] = '刚刚发布';
        } else if ($time < 60 * 60) {
            $list['time'] = floor($time / 60).'分钟之前';
        } else if (date('Y-m-d') == date('Y-m-d', $list['create'])) {
            $list['time'] = '今天'.date('H:i', $list['create']);
        } else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list['create'])) {
            $list['time'] = '昨天'.date('H:i', $list['create']);
        } else if (date('Y') == date('Y', $list['create'])) {
            $list['time'] = date('m月d日 H:i', $list['create']);
        } else {
            $list['time'] = date('Y年m月d日 H:i', $list['create']);
        }

        return $list;
    }
}