<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>微博—后台</title>
  <link rel="stylesheet" type="text/css" href="/weibo/PUBLIC/Admin/easyui/themes/bootstrap/easyui.css" />
  <link rel="stylesheet" type="text/css" href="/weibo/PUBLIC/Admin/easyui/themes/icon.css" />
  <link rel="stylesheet" type="text/css" href="/weibo/PUBLIC/Admin/css/index.css" />
  <script type="text/javascript">
      var ThinkPHP = {
          'ROOT':'/weibo',
          'IMG' : '/weibo/Public/<?php echo MODULE_NAME;?>/img',
          'MODULE' : '/weibo/Admin',
          'INDEX' : '<?php echo U("Index/index");?>',
      };
  </script>
</head>
<body>
<div id="body" class="easyui-layout" fit="true">
  <div data-options="region:'north',title:'NorthTitle',split:true,noheader:true" style="height:60px;">
    <div class="logo">
      微博管理
    </div>
    <div class="logout">
      您好，<?php echo session('admin')['manager'];?> | <a href="<?php echo U('Login/Layout');?>">退出</a>
    </div>
  </div>
  <div data-options="region:'west',title:'导航',split:true,iconCls:'icon-world'" style="width:200px;">
    <ul id="nav"></ul>
  </div>
  <div data-options="region:'center'">
      <div id="tabs">
        <div title="起始页" iconCls="icon-house" ></div>
      </div>
  </div>
</div>
</body>
<script type="text/javascript" src="/weibo/PUBLIC/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/weibo/PUBLIC/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/weibo/PUBLIC/Admin/easyui/locale/easyui-lang-zh_CN.js" ></script>
<script type="text/javascript" src="/weibo/Public/Admin/js/index.js"></script>
</html>