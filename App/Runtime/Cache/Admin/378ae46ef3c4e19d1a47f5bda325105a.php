<?php if (!defined('THINK_PATH')) exit();?><table id="user"></table>

<div id="user_tool" style="padding:5px;">
    <div style="margin-bottom:5px;">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-new" plain="true" onclick="user_tool.add();">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="user_tool.ediit();">修改</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="user_tool.remove();">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="user_tool.reload();">刷新</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="user_tool.redo();">刷新</a>
    </div>
    <div style="padding:0 0 0 7px;color:#333;">
        查询帐号：<input type="text" class="textbox" name="username" style="width:110px;">
        创建时间从：<input type="text" name="date_from" editable="false" class="easyui-datebox"  style="width:110px;">
        到：<input type="text" name="date_to" editable="false" class="easyui-datebox"  style="width:110px;">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="user_tool.seaaa();">查询</a>
    </div>
</div>

<form id="user_add" style="margin:0;padding:5px 0 0 25px;color:#333;">
    <p>用户帐号：<input type="text" name="user" class="textbox" style="width:200px;"></p>
    <p>用户密码：<input type="password" name="password" value="" class="textbox" style="width:200px;"></p>
    <p>电子邮件：<input type="text" name="email" class="textbox" style="width:200px;"></p>
    <p><span style="vertical-align:37px">默认头像：</span><img src="/weibo/PUBLIC/Admin/img/small_face.jpg" alt="默认头像" style="cursor:pointer;"></p>
    <p><span style="vertical-align:60px">个人简介：</span><textarea name="intro" style="width:200px;height:70px;resize:none;"></textarea></p>
</form>

<form id="user_edit" style="margin:0;padding:5px 0 0 25px;color:#333;">
    <input type="hidden" name="source_intro">
    <p>用户帐号：<input type="text" name="edit_user" disabled="true" class="textbox" style="width:200px;"></p>
    <p>用户密码：<input type="password" name="edit_password" value="" class="textbox" style="width:200px;"></p>
    <p>电子邮件：<input type="text" name="edit_email" class="textbox" style="width:200px;"></p>
    <p><span style="vertical-align:37px">默认头像：</span><img src="/weibo/PUBLIC/Admin/img/small_face.jpg" alt="默认头像" style="cursor:pointer;"></p>
    <p><span style="vertical-align:60px">个人简介：</span><textarea name="edit_intro" style="width:200px;height:70px;resize:none;"></textarea></p>
</form>
<script type="text/javascript" src="/weibo/Public/Admin/js/user.js"></script>