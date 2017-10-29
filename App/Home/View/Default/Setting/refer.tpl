<extend name="Common/base" />
<block name="head">
    <script type="text/javascript" src="__js__/setting.js"></script>
    <link rel="stylesheet" href="__css__/setting.css"/>
</block>
<block name="main">
    <div class="main_left">
        <ul>
            <li><a href="{:U('Setting/index')}" >个人设置</a></li>
            <li><a href="{:U('Setting/infoPic')}">头像设置</a></li>
            <li><a href="{:U('Setting/refer')}" class="selected">消息提醒</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>消息提醒</h2>
           <dl>
               <volist name="getRefer" id="obj">
               <dd>昵称: {:session('user_auth')['user']}</dd>
               <switch name="obj.read">
                       <case value="0"><dd class="a"> 您被 ：{$obj.refer.content}这条微博@到啦<b class="read red" rid="{$obj.id}">[未读]</b></dd></case>
                       <case value="1"><dd class="b"> 您被 ：{$obj.refer.content}这条微博@到啦<b class="read green">[已读]</b></dd></case>
               </switch>
               </volist>
           </dl>
        </h2>
    </div>
</block>