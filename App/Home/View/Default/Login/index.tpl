<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录-微博系统</title>
    <script type="text/javascript" src="__js__/jquery.js"></script>
    <script type="text/javascript" src="__js__/jquery.ui.js"></script>
    <script type="text/javascript" src="__js__/jquery.validate.js"></script>
    <script type="text/javascript" src="__js__/jquery.form.js"></script>
    <script type="text/javascript" src="__js__/Login.js"></script>
    <link rel="stylesheet" href="__css__/jquery.ui.css"/>
    <link rel="stylesheet" href="__css__/login.css"/>
    <script type="text/javascript">
        var ThinkPHP = {
            'IMG' : '__PUBLIC__/{:MODULE_NAME}/img',
            'MODULE' : '__MODULE__',
            'INDEX' : '{:U("Index/index")}',
        };
    </script>
</head>
<body>

<div id="header"></div>

<div id="main">
    <form id="login">
        <div class="top">
            <span class="user">
                <input type="text" name="user" placeholder="用户名"  />
            </span>
            <span class="user">
                <input type="password" name="password" placeholder="密码" />
                <label class="auto" for="auto"><input type="checkbox" name="auto" id="auto">自动登录</label>
            </span>
                <input type="submit" name="submit" value="登录">
        </div>
        <div class="up">
            <a href="javascript:void(0)" id="reg_link">注册新用户</a>
            <a href="javascript:void(0)">忘记密码？</a>
        </div>
    </form>
</div>

<p class="footer_text">&copy;2017 最厉害的围脖. Powered by 乌冬面</p>

    <form id="register">
        <p>
            <label for="user">帐号：</label>
            <input type="text" name="user" class="text" id="user" placeholder="昵称，不小于两位！">
            <span class="star">*</span>
        </p>
        <p>
            <label for="password">密码：</label>
            <input type="password" name="password" class="text" id="password" placeholder="密码，不小于6位！" />
            <span class="star">*</span>
        </p>
        <p>
            <label for="repassword">确认：</label>
            <input type="password" name="repassword" class="text" id="repassword" placeholder="密码和密码确认必须一致！" />
            <span class="star">*</span>
        </p>
        <p>
            <label for="email">邮箱：</label>
            <input type="text" name="email" class="text" id="email" placeholder="电子邮件，用于找回密码！" />
            <span class="star">*</span>
        </p>
    </form>
    <form id="verify_form" form_id="">
        <p>
            <label for="verify">验证码:</label>
            <input type="text" name="verify" class="text" id="verify">
            <span class="star">*</span>
            <a href="javascript:void(0)" class="change_img">换一换</a>
        </p>
        <p><img src="{:U(verify)}" class="change_img verifyimg"></p>
    </form>
<div id="loading">正在登录中....</div>
</body>
</html>