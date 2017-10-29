<extend name="Common/base" />
<block name="head">
    <script type="text/javascript" src="__js__/setting.js"></script>
    <link rel="stylesheet" href="__css__/setting.css"/>
</block>
<block name="main">
    <div class="main_left">
        <ul>
            <li><a href="{:U('Setting/index')}" class="selected">个人设置</a></li>
            <li><a href="{:U('Setting/infoPic')}">头像设置</a></li>
            <li><a href="{:U('Setting/refer')}" >消息提醒</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>个人设置</h2>
           <dl>
               <dd>昵称: {$user[0].user}</dd>
               <dd>电子邮箱: <input type="text" name="email" value="{$user[0].email}"></dd>
               <dd>个人简介: <span><textarea name="info" class="info">{$user[0].extend.info}</textarea></span></dd>
               <dd><input type="submit" value="修改" class="sumbit"></dd>
           </dl>
    </div>
</block>