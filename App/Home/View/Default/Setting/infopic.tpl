<extend name="Common/base" />
<block name="head">
  <script type="text/javascript" src="__js__/jquery-migrate-1.2.1.js"></script>
    <script type="text/javascript" src="__upload__/jquery.uploadify.js"></script>
  <script type="text/javascript" src="__js__/jquery.Jcrop.js"></script>
  <script type="text/javascript" src="__js__/setting.js"></script>
  <link rel="stylesheet" href="__css__/jquery.Jcrop.css">
    <link rel="stylesheet" href="__upload__/uploadify.css"/>
  <link rel="stylesheet" href="__css__/setting.css"/>
</block>
<block name="main">
  <div class="main_left">
    <ul>
        <li><a href="{:U('Setting/index')}">个人设置</a></li>
        <li><a href="{:U('Setting/infoPic')}" class="selected">头像设置</a></li>
        <li><a href="{:U('Setting/refer')}" >消息提醒</a></li>
    </ul>
  </div>
  <div class="main_right">
    <h2>头像设置</h2>
    <div class="face">
        <empty name="bigFace">
            <img id="face" src="__img__/big.jpg">
            <else />
        <img id="face" src="__ROOT__{$bigFace}">
        </empty>
       <span id="preview_box" class="crop_preview" ><img id="crop_preview" src="__img__/big.jpg" /></span>
        <a href="javascript:void(0)" class="save" style="display:none;margin:10px 0 0 0;">保存</a>
        <a href="javascript:void(0)" class="cancel" style="display:none;margin:10px 0 0 0;">取消</a>
        <input type="file" name="file" id="file">
        <input type="hidden" name="x" id="x">
        <input type="hidden" name="y" id="y">
        <input type="hidden" name="w" id="w">
        <input type="hidden" name="h" id="h">
        <input type="hidden" name="url" id="url">
    </div>
  </div>
</block>