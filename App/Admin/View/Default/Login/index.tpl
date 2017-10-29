<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微博系统</title>
    <script type="text/javascript" src="__easyui__/jquery.min.js"></script>
    <script type="text/javascript" src="__easyui__/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="__easyui__/locale/easyui-lang-zh_CN.js" ></script>
    <script type="text/javascript" src="__js__/login.js"></script>
    <link rel="stylesheet" type="text/css" href="__easyui__/themes/bootstrap/easyui.css" />
    <link rel="stylesheet" type="text/css" href="__easyui__/themes/icon.css" />
    <link rel="stylesheet" type="text/css" href="__css__/login.css" />
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