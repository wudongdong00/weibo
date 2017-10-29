<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css"/>
<link rel="stylesheet" href="/weibo/Public/Home/css/base.css"/>


    <script type="text/javascript" src="/weibo/Public/Home/js/rl_exp.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/wu_pic.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.scrollUp.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/index.js"></script>
    <link rel="stylesheet" href="/weibo/Public/Home/css/rl_exp.css"/>
    <link rel="stylesheet" href="/weibo/Public/Home/uploadify/uploadify.css"/>
    <link rel="stylesheet" href="/weibo/Public/Home/css/public.css"/>
    <link rel="stylesheet" href="/weibo/Public/Home/css/index.css"/>

<script type="text/javascript">
    var ThinkPHP = {
        'ROOT':'/weibo',
        'IMG' : '/weibo/Public/<?php echo MODULE_NAME;?>/img',
        'MODULE' : '/weibo/Home',
        'INDEX' : '<?php echo U("Index/index");?>',
        'UPLOADIFY':'/weibo/Public/Home/uploadify',
        'IMAGE' : '<?php echo U("File/image");?>',
        'FACEURL' : '<?php echo U("File/face");?>',
        'BIGFACE':'<?php echo session("user_auth")["face"]->big;?>',
        'FACE' : '/weibo/Public/<?php echo MODULE_NAME;?>/face',
    };
</script>
</head>
<body>


<div id="header">
  <div class="header_main">
    <div class="logo">微博系统</div>
    <div class="nav">
      <ul>
        <li><a href="<?php echo U('Index/index');?>" >首页</a></li>
        <li><a href="#">广场</a></li>
        <li><a href="#">图片</a></li>
        <li><a href="#">找人</a></li>
      </ul>
    </div>
    <div class="person">
      <ul>
        <li class="user"><a href="#"><?php echo session('user_auth')['user'];?></a>
            <div class="refer">
              <span>x</span>
              您有<b>0</b>条@提及！
            </div>
        </li>
        <li class="app">消息
          <dl class="list">
            <dd><a href="<?php echo U('Setting/refer');?>">@提到我的<span>(0)</span></a></dd>
            <dd><a href="#">收到的评论</a></dd>
            <dd><a href="#">发出的评论</a></dd>
            <dd><a href="#">我的私信</a></dd>
            <dd><a href="#">系统消息</a></dd>
            <dd><a href="#" class="line">发私信>></a></dd>
          </dl>
        </li>
        <li class="app">帐号
          <dl class="list">
            <dd><a href="<?php echo U('Setting/index');?>">个人设置</a></dd>
            <dd><a href="#">排行</a></dd>
            <dd><a href="#">申请认证</a></dd>
            <dd><a href="<?php echo U('User/Loginout');?>" class="line">退出>></a></dd>
          </dl>
        </li>
      </ul>
    </div>
    <div class="search">
      <input type="text" name="search" id="search" placeholder="请输入关键字">
      <a href="javascript:void (0)"></a>
    </div>
  </div>
</div>

<div id="main">
  
    <div class="main_left">
        <div class="form_mes">
            <span class="left">和大家分享一点新鲜事吧！</span>
            <span class="num form_num" >可以输入<strong>140</strong>个字</span>
            <textarea class="form_text" id="rl_exp_input"></textarea>
            <a href="javascript:void(0);" class="form_face" id="rl_exp_btn">表情<span class="face_arrow_top"></span></a>
                <div class="rl_exp" id="rl_bq" style="display:none;">
                    <ul class="rl_exp_tab clearfix">
                        <li><a href="javascript:void(0);" class="selected">默认</a></li>
                        <li><a href="javascript:void(0);">拜年</a></li>
                        <li><a href="javascript:void(0);">浪小花</a></li>
                        <li><a href="javascript:void(0);">暴走漫画</a></li>
                    </ul>
                    <ul class="rl_exp_main clearfix rl_selected"></ul>
                    <ul class="rl_exp_main clearfix" style="display:none;"></ul>
                    <ul class="rl_exp_main clearfix" style="display:none;"></ul>
                    <ul class="rl_exp_main clearfix" style="display:none;"></ul>
                    <a href="javascript:void(0);" class="close">×</a>
                </div>
            <a href="javascript:void(0);" class="form_pic" id="pic_btn">图片<span class="pic_arrow_top"></span></a>
            <div class="pic_box" id="pic_boxed" style="display:none;">
                <div class="pic_header"><span class="pic_line">共<span class="pic_total">0</span>张  还可以选择<span class="pic_limit">8</span>张 （按Ctrl可选择多张）</span> </div>
                <a href="javascript:void(0);" class="close">×</a>
                <div class="pic_list"></div>
                <input type="file" name="file" id="file">
            </div>
            <input type="button" class="form_button" value="发布">
        </div>
        <div class="weibo_content">
            <ul>
                <li><a href="javascript:void(0);" class="selected">我关注的<i class="content_arrow"></i></a></li>
                <li><a href="javascript:void(0);">互相关注</a></li>
            </ul>
            <div class="msg">约 0 条新广播，点击查看</div>
            <?php if(is_array($topList)): $i = 0; $__LIST__ = $topList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i; if(empty($obj["reid"])): ?><dl class="content_data">
                            <dt><a href="javascript:void(0);">
                                    <?php if(empty($obj["face"])): if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><img src="/weibo/Public/Home/img/small_face.jpg" border="0" alt=""></a>
                                            <?php else: ?>
                                            <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><img src="/weibo/Public/Home/img/small_face.jpg" border="0" alt=""></a><?php endif; ?>
                                        <?php else: ?>
                                        <?php if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><img src="/weibo/<?php echo ($obj["face"]); ?>" border="0" alt=""></a>
                                            <?php else: ?>
                                            <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><img src="/weibo/<?php echo ($obj["face"]); ?>" border="0" alt=""></a><?php endif; endif; ?>
                                </a></dt>
                            <dd>
                                <h4>
                                    <?php if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><?php echo ($obj["user"]); ?></a>
                                        <?php else: ?>
                                        <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><?php echo ($obj["user"]); ?></a><?php endif; ?>
                                </h4>
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
                                    <?php $__FOR_START_6215__=0;$__FOR_END_6215__=$obj['count'];for($i=$__FOR_START_6215__;$i < $__FOR_END_6215__;$i+=1){ ?><div class="lots_img" style="display: block"><img src="/weibo/<?php echo ($obj['image'][$i]['thumb']); ?>" alt=""></div><?php } ?>
                                    <div class="scroll" style="margin:0 auto;width:550px;display: none">
                                        <!-- "prev page" link -->
                                        <a class="prev" href="javascript:void(0)"></a>
                                        <ol>
                                            <li class="in_box"><a href="javascript:void(0);">收起</a></li>
                                            <li class="source_box"><a href="/weibo/<?php echo ($obj['image'][0]['source']); ?>" target="_blank">查看原图</a></li>
                                        </ol>
                                        <div class="box">
                                            <div class="scroll_list">
                                                    <?php $__FOR_START_10356__=0;$__FOR_END_10356__=$obj['count'];for($i=$__FOR_START_10356__;$i < $__FOR_END_10356__;$i+=1){ ?><div class="imgs"><img src="/weibo/<?php echo ($obj['image'][$i]['unfold']); ?>" alt=""></div><?php } ?>
                                            </div>
                                        </div>
                                        <!-- "next page" link -->
                                        <a class="next" href="javascript:void(0)"></a>
                                    </div><?php endswitch;?>
                                <div class="footer">
                                    <span class="time"><?php echo ($obj["time"]); ?></span>
                                    <span class="handler">赞（0）| <a href="javascript:void (0)" class="re">转发(<?php echo ($obj["recount"]); ?>)</a> | <a href="javascript:void (0)" class="com">评论(<?php echo ($obj["comcount"]); ?>)</a> | 收藏 </span>
                                    <div class="re_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="re_text re_com_text" name="commend"></textarea>
                                        <input type="hidden" name="reid" value="<?php echo ($obj["id"]); ?>">
                                        <input type="button" value="转发" class="re_button">
                                    </div>
                                    <div class="com_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="com_text re_com_text" name="commend"></textarea>
                                        <input type="hidden" name="tid" value="<?php echo ($obj["id"]); ?>">
                                        <input type="button" value="评论" class="com_button">
                                        <div class="commend_content">

                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    <?php else: ?>
                        <dl class="content_data">
                            <dt><a href="javascript:void(0);">
                                    <?php if(empty($obj["face"])): if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><img src="/weibo/Public/Home/img/small_face.jpg" border="0" alt=""></a>
                                            <?php else: ?>
                                            <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><img src="/weibo/Public/Home/img/small_face.jpg" border="0" alt=""></a><?php endif; ?>
                                        <?php else: ?>
                                        <?php if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><img src="/weibo/<?php echo ($obj["face"]); ?>" border="0" alt=""></a>
                                            <?php else: ?>
                                            <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><img src="/weibo/<?php echo ($obj["face"]); ?>" border="0" alt=""></a><?php endif; endif; ?>
                                </a></dt>
                            <dd>
                                <h4>
                                    <?php if(empty($obj["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['uid']));?>"><?php echo ($obj["user"]); ?></a>
                                        <?php else: ?>
                                        <a href="/weibo/i/<?php echo ($obj["domin"]); ?>"><?php echo ($obj["user"]); ?></a><?php endif; ?>
                                </h4>
                                <p><?php echo ($obj["content"]); ?></p>
                                <div class="re_content" style="overflow: auto">
                                    <h5>
                                        <?php if(empty($obj["recontent"]["domin"])): ?><a href="<?php echo U('Space/index', array('id'=>$obj['recontent']['uid']));?>">@<?php echo ($obj["recontent"]["user"]); ?></a>
                                        <?php else: ?>
                                            <a href="/weibo/i/<?php echo ($obj["recontent"]["domin"]); ?>">@<?php echo ($obj["recontent"]["user"]); ?></a><?php endif; ?>
                                    </h5>
                                    <p><?php echo ($obj["recontent"]["content"]); ?></p>
                                    <?php switch($obj["recontent"]["count"]): case "0": break;?>
                                        <?php case "1": ?><div class="img" ><img src="/weibo/<?php echo ($obj['recontent']['image'][0]['thumb']); ?>" alt="" class="thumb"></div>
                                            <div class="img_zoom"  >
                                                <ol>
                                                    <li class="in"><a href="javascript:void(0);">收起</a></li>
                                                    <li class="source"><a href="/weibo/<?php echo ($obj['recontent']['image'][0]['source']); ?>" target="_blank">查看原图</a></li>
                                                </ol>
                                                <img data="/weibo/<?php echo ($obj['recontent']['image'][0]['unfold']); ?>" src="/weibo/Public/Home/img/loading_100.png" alt="" class="unfold">
                                            </div><?php break;?>
                                        <?php default: ?>
                                            <?php $__FOR_START_16797__=0;$__FOR_END_16797__=$obj['recontent']['count'];for($i=$__FOR_START_16797__;$i < $__FOR_END_16797__;$i+=1){ ?><div class="lots_img" style="display: block"><img src="/weibo/<?php echo ($obj['recontent']['image'][$i]['thumb']); ?>" alt=""></div><?php } ?>
                                        <div class="scroll" style="margin:0 auto;width:550px;display: none">
                                            <!-- "prev page" link -->
                                            <a class="prev" href="javascript:void(0)"></a>
                                            <ol>
                                                <li class="in_box"><a href="javascript:void(0);">收起</a></li>
                                                <li class="source_box"><a href="/weibo/<?php echo ($obj['recontent']['image'][0]['source']); ?>" target="_blank">查看原图</a></li>
                                            </ol>
                                            <div class="box">
                                                <div class="scroll_list">
                                                    <?php $__FOR_START_30226__=0;$__FOR_END_30226__=$obj['count'];for($i=$__FOR_START_30226__;$i < $__FOR_END_30226__;$i+=1){ ?><div class="imgs"><img src="/weibo/{obj['recontent']['image'][$i]['unfold']}" alt=""></div><?php } ?>
                                                </div>
                                            </div>
                                            <!-- "next page" link -->
                                            <a class="next" href="javascript:void(0)"></a>
                                        </div><?php endswitch;?>
                                        <div class="footer">
                                        <span class="time"><?php echo ($obj["recontent"]["time"]); ?></span>
                                        <span class="handler">赞(0) 　<a href="javascript:void (0)" class="re">转发(<?php echo ($obj["recontent"]["recount"]); ?>)</a> 　评论  </span>
                                        </div>
                                </div>
                                <div class="footer">
                                    <span class="time"><?php echo ($obj["time"]); ?></span>
                                    <span class="handler">赞（0）| <a href="javascript:void (0)" class="re">转发</a> | <a href="javascript:void (0)" class="com">评论()</a> | 收藏 </span>
                                    <div class="re_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="re_text re_com_text" name="commend"> || @<?php echo ($obj["user"]); ?> :<?php echo ($obj["textarea"]); ?></textarea>
                                        <input type="hidden" name="reid" value="<?php echo ($obj["reid"]); ?>">
                                        <input type="button" value="转发" class="re_button">
                                    </div>
                                    <div class="com_box re_com_box" style="display: none;">
                                        <p>表情、字数限制自行完成</p>
                                        <textarea class="com_text re_com_text" name="commend"></textarea>
                                        <input type="hidden" name="tid" value="<?php echo ($obj["reid"]); ?>">
                                        <input type="button" value="评论" class="com_button">
                                        <div class="commend_content">

                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </dl><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <div id="load_more">加载更多中哦<img src="/weibo/Public/Home/img/load_more.gif"></div>
            <div id="ajax_html1" style="display: none">
                <dl class="content_data">
                    <dt><a href="javascript:void(0);">
                            <?php if(empty($smallFace)): ?><img src="/weibo/Public/Home/img/small_face.jpg" alt="">
                                <?php else: ?>
                                <img src="/weibo/<?php echo ($smallFace); ?>" alt=""><?php endif; ?>
                        </a></dt>
                    <dd>
                        <h4><a href="javascript:void(0);"><?php echo session('user_auth')['user'];?></a></h4>
                        <p>#内容#</p>
                        <div class="footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
                        </div>
                    </dd>
                </dl>
            </div>
            <div id="ajax_html2" style="display: none">
                <dl class="content_data">
                    <dt><a href="javascript:void(0);">
                            <?php if(empty($smallFace)): ?><img src="/weibo/Public/Home/img/small_face.jpg" alt="">
                                <?php else: ?>
                                <img src="/weibo/<?php echo ($smallFace); ?>" alt=""><?php endif; ?>
                        </a></dt>
                    <dd>
                        <h4><a href="javascript:void(0);"><?php echo session('user_auth')['user'];?></a></h4>
                        <p>#内容#</p>
                                <div class="img" ><img src="/weibo/#缩略图#" alt="" class="thumb"></div>
                                <div class="img_zoom"  >
                                    <ol>
                                        <li class="in"><a href="javascript:void(0);">收起</a></li>
                                        <li class="source"><a href="/weibo/#原图#" target="_blank">查看原图</a></li>
                                    </ol>
                                    <img data="/weibo/#放大图#" src="/weibo/Public/Home/img/loading_100.png" alt="" class="unfold">
                                </div>
                        <div class="footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
                        </div>
                    </dd>
                </dl>
            </div>
            <div id="ajax_html3" style="display: none">
                <dl class="content_data">
                    <dt><a href="javascript:void(0);">
                            <?php if(empty($smallFace)): ?><img src="/weibo/Public/Home/img/small_face.jpg" alt="">
                                <?php else: ?>
                                <img src="/weibo/<?php echo ($smallFace); ?>" alt=""><?php endif; ?>
                        </a></dt>
                    <dd>
                        <h4><a href="javascript:void(0);"><?php echo session('user_auth')['user'];?></a></h4>
                        <p>#内容#</p>
                        <?php $__FOR_START_29155__=0;$__FOR_END_29155__=$obj['count'];for($i=$__FOR_START_29155__;$i < $__FOR_END_29155__;$i+=1){ ?><div class="lots_img" style="display: block"><img src="/weibo/#多图缩略<?php echo ($i); ?>#" alt=""></div><?php } ?>
                        <div class="scroll" style="margin:0 auto;width:550px;display: none">
                            <!-- "prev page" link -->
                            <a class="prev" href="javascript:void(0)"></a>
                                <ol>
                                    <li class="in_box"><a href="javascript:void(0);">收起</a></li>
                                    <li class="source_box"><a href="/weibo/#多图原图#"  target="_blank">查看原图</a></li>
                                </ol>
                            <div class="box">
                                <div class="scroll_list">
                                    <?php $__FOR_START_22496__=0;$__FOR_END_22496__=$obj['count'];for($i=$__FOR_START_22496__;$i < $__FOR_END_22496__;$i+=1){ ?><div class="imgs"><img src="/weibo/#多图放大<?php echo ($i); ?>#" alt=""></div><?php } ?>
                                </div>
                            </div>
                            <!-- "next page" link -->
                            <a class="next" href="javascript:void(0)"></a>
                        </div>
                        <div class="footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞（0）| 转发 | 评论 | 收藏 </span>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="main_right">
        <?php if(empty($bigFace)): ?><img src="/weibo/Public/Home/img/big.jpg" alt="" class="face">
            <?php else: ?>
            <img src="/weibo/<?php echo ($bigFace); ?>" alt="" class="face"><?php endif; ?>
        <span class="user">
            <a href="#"><?php echo session('user_auth')['user'];?></a>
        </span>
    </div>

</div>

<div id="error">...</div>
<div id="loading">...</div>


</body>
</html>