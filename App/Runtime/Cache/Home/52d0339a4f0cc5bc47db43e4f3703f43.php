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
        <li><a href="#"><?php echo session('user_auth')['user'];?></a></li>
        <li class="app">消息
          <dl class="list">
            <dd><a href="<?php echo U('Setting/refer');?>">@提到我的</a></dd>
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
            <li><a href="<?php echo U('Setting/index');?>" class="selected">个人设置</a></li>
            <li><a href="<?php echo U('Setting/infoPic');?>">头像设置</a></li>
            <li><a href="<?php echo U('Setting/refer');?>" >消息提醒</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>个人设置</h2>
           <dl>
               <dd>昵称: <?php echo ($user[0]["user"]); ?></dd>
               <dd>电子邮箱: <input type="text" name="email" value="<?php echo ($user[0]["email"]); ?>"></dd>
               <dd>个人简介: <span><textarea name="info" class="info"><?php echo ($user[0]["extend"]["info"]); ?></textarea></span></dd>
               <dd><input type="submit" value="修改" class="sumbit"></dd>
           </dl>
    </div>

</div>

<div id="error">...</div>
<div id="loading">...</div>


</body>
</html>