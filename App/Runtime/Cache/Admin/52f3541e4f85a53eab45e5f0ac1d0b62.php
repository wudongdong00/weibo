<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微博系统</title>
    <script type="text/javascript" src="/weibo/PUBLIC/Admin/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/weibo/PUBLIC/Admin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/weibo/PUBLIC/Admin/easyui/locale/easyui-lang-zh_CN.js" ></script>
    <script type="text/javascript" src="/weibo/Public/Admin/js/login.js"></script>
    <link rel="stylesheet" type="text/css" href="/weibo/PUBLIC/Admin/easyui/themes/bootstrap/easyui.css" />
    <link rel="stylesheet" type="text/css" href="/weibo/PUBLIC/Admin/easyui/themes/icon.css" />
    <link rel="stylesheet" type="text/css" href="/weibo/PUBLIC/Admin/css/login.css" />
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
<div id="login">
    <p>管理员帐号：<input type="text" id="manager" class="textbox"></p>
    <p>管理员密码：<input type="password" id="password"
                    class="textbox"></p>
</div>
<div id="btn">
    <a href="#" class="easyui-linkbutton">登录</a>
</div>
</body>
</html>