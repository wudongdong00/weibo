<?php if (!defined('THINK_PATH')) exit();?><ol class="commend">
  <?php if(is_array($getList)): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><li>
        <?php if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><?php echo ($obj["user"]); ?></a>
          <?php else: ?>
          <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><?php echo ($obj["user"]); ?></a><?php endif; ?>
       :<?php echo ($obj["content"]); ?>
     </li>
    <li class="line"><?php echo ($obj["time"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ol>
<div class="page">
  <?php $__FOR_START_13239__=1;$__FOR_END_13239__=$total+1;for($i=$__FOR_START_13239__;$i < $__FOR_END_13239__;$i+=1){ ?><a href="javascript:void(0)" page="<?php echo ($i); ?>" class="page_comment <?php echo ($page == $i ? 'select' : ''); ?>"><?php echo ($i); ?></a><?php } ?>
</div>