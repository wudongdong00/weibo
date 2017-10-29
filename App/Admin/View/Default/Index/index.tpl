<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>微博—后台</title>
  <link rel="stylesheet" type="text/css" href="__easyui__/themes/bootstrap/easyui.css" />
  <link rel="stylesheet" type="text/css" href="__easyui__/themes/icon.css" />
  <link rel="stylesheet" type="text/css" href="__css__/index.css" />
  <script type="text/javascript">
      var ThinkPHP = {
          'ROOT':'__ROOT__',
          'IMG' : '__PUBLIC__/{:MODULE_NAME}/img',
          'MODULE' : '__MODULE__',
          'INDEX' : '{:U("Index/index")}',
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
      您好，{:session('admin')['manager']} | <a href="{:U('Login/Layout')}">退出</a>
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
<script type="text/javascript" src="__easyui__/jquery.min.js"></script>
<script type="text/javascript" src="__easyui__/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__easyui__/locale/easyui-lang-zh_CN.js" ></script>
<script type="text/javascript" src="__js__/index.js"></script>
</html>