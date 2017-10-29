<?php if (!defined('THINK_PATH')) exit(); if(is_array($ajaxList)): $i = 0; $__LIST__ = $ajaxList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><dl class="content_data">
    <dt><a href="javascript:void(0);">
        <?php if(empty($obj["face"])): ?><img src="/weibo/Public/Home/img/small_face.jpg" alt="">
          <?php else: ?>
          <img src="/weibo/<?php echo ($obj["face"]); ?>" alt=""><?php endif; ?>
      </a></dt>
    <dd>
      <h4><a href="javascript:void(0);"><?php echo ($obj["user"]); ?></a></h4>
      <p><?php echo ($obj["content"]); ?></p>
      <?php switch($obj["count"]): case "0": break;?>
        <?php case "1": ?><div class="img" ><img src="/weibo/<?php echo ($obj['image'][0]['thumb']); ?>" alt="" class="thumb"></div>
          <div class="img_zoom"  >
            <ol>
              <li class="in"><a href="javascript:void(0);">收起</a></li>
              <li class="source"><a href="/weibo/<?php echo ($obj['image'][0]['source']); ?>" target="_blank">查看原图</a></li>
            </ol>
            <img data="/weibo/<?php echo ($obj['image'][0]['unfold']); ?>" src="/weibo/Public/Home/img/loading_100.png" alt="" class="unfold">
          </div><?php break;?>
        <?php default: ?>
        <?php $__FOR_START_15131__=0;$__FOR_END_15131__=$obj['count'];for($i=$__FOR_START_15131__;$i < $__FOR_END_15131__;$i+=1){ ?><div class="lots_img" style="display: block"><img src="/weibo/<?php echo ($obj['image'][$i]['thumb']); ?>" alt=""></div><?php } ?>
        <div class="scroll" style="margin:0 auto;width:550px;display: none">
          <!-- "prev page" link -->
          <a class="prev" href="javascript:void(0)"></a>
          <ol>
            <li class="in_box"><a href="javascript:void(0);">收起</a></li>
            <li class="source_box"><a href="/weibo/<?php echo ($obj['image'][0]['source']); ?>" target="_blank">查看原图</a></li>
          </ol>
          <div class="box">
            <div class="scroll_list">
              <?php $__FOR_START_5304__=0;$__FOR_END_5304__=$obj['count'];for($i=$__FOR_START_5304__;$i < $__FOR_END_5304__;$i+=1){ ?><div class="imgs"><img src="/weibo/<?php echo ($obj['image'][$i]['unfold']); ?>" alt=""></div><?php } ?>
            </div>
          </div>
          <!-- "next page" link -->
          <a class="next" href="javascript:void(0)"></a>
        </div><?php endswitch;?>
      <div class="footer">
        <span class="time"><?php echo ($obj["time"]); ?></span>
        <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
      </div>
    </dd>
  </dl><?php endforeach; endif; else: echo "" ;endif; ?>