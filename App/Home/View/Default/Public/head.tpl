<script type="text/javascript" src="__js__/jquery.js"></script>
<script type="text/javascript" src="__js__/jquery.ui.js"></script>
<script type="text/javascript" src="__js__/base.js"></script>
<link rel="stylesheet" href="__css__/jquery.ui.css"/>
<link rel="stylesheet" href="__css__/base.css"/>

<block name="head"></block>
<script type="text/javascript">
    var ThinkPHP = {
        'ROOT':'__ROOT__',
        'IMG' : '__PUBLIC__/{:MODULE_NAME}/img',
        'MODULE' : '__MODULE__',
        'INDEX' : '{:U("Index/index")}',
        'UPLOADIFY':'__upload__',
        'IMAGE' : '{:U("File/image")}',
        'FACEURL' : '{:U("File/face")}',
        'BIGFACE':'{:session("user_auth")["face"]->big}',
        'FACE' : '__PUBLIC__/{:MODULE_NAME}/face',
    };
</script>