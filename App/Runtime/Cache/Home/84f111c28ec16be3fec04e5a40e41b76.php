<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css"/>
<link rel="stylesheet" href="/weibo/Public/Home/css/base.css"/>


    <script type="text/javascript" src="/weibo/Public/Home/js/setting.js"></script>
    <link rel="stylesheet" href="/weibo/Public/Home/css/setting.css"/>

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
        <ul>
            <li><a href="<?php echo U('Setting/index');?>" >个人设置</a></li>
            <li><a href="<?php echo U('Setting/infoPic');?>">头像设置</a></li>
            <li><a href="<?php echo U('Setting/refer');?>" class="selected">消息提醒</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>消息提醒</h2>
           <dl>
               <?php if(is_array($getRefer)): $i = 0; $__LIST__ = $getRefer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><dd>昵称: <?php echo session('user_auth')['user'];?></dd>
               <?php switch($obj["read"]): case "0": ?><dd class="a"> 您被 ：<?php echo ($obj["refer"]["content"]); ?>这条微博@到啦<b class="read red" rid="<?php echo ($obj["id"]); ?>">[未读]</b></dd><?php break;?>
                       <?php case "1": ?><dd class="b"> 您被 ：<?php echo ($obj["refer"]["content"]); ?>这条微博@到啦<b class="read green">[已读]</b></dd><?php break; endswitch; endforeach; endif; else: echo "" ;endif; ?>
           </dl>
        </h2>
    </div>

</div>

<div id="error">...</div>
<div id="loading">...</div>


</body>
</html>