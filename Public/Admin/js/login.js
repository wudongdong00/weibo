/**
 * Created by Administrator on 2017/8/29.
 */
$(function () {
    //管理员登录界面
    $('#login').dialog({
        title : '登录后台',
        width : 300,
        height : 180,
        modal : true,
        iconCls : 'icon-tip',
        buttons : $('#btn')
    });

    //管理员帐号
    $('#manager').validatebox({
        required : true,
        missingMessage : '请输入管理员帐号',
        invaliMessage : '管理员帐号不得为空'
    });

    //管理员密码
    $('#password').validatebox({
        required : true,
        validtype : 'length[6,30]',
        missingMessage : '请输入管理员密码',
        invaliMessage : '管理员密码必须在6-30位'
    });

    //加载后定义光标
    if(!$('#manager').validatebox('isValid')){
        $('#manager').focus();
    }else if(!$('#password').validatebox('isValid')){
        $('#password').focus();
    }

    //提交管理员信息
    $('#btn a').click(function () {
        if(!$('#manager').validatebox('isValid')){
            $('#manager').focus();
        }else if(!$('#password').validatebox('isValid')){
            $('#password').focus();
        }else{
            $.ajax({
                url : ThinkPHP['MODULE'] + '/Login/checkManage',
                type : 'POST',
                data : {
                    manager : $('#manager').val(),
                    password : $('#password').val()
                },

                beforeSend : function () {
                    $.messager.progress({
                        text : '正在尝试登录...',
                    });
                },

                success : function (data) {
                    $.messager.progress('close');
                    if (data > 0) {
                        location.href = ThinkPHP['INDEX'];
                    } else {
                        $.messager.alert('登录失败！','用户名或密码错误！','warning', function () {
                        $('#password').select();
                        });
                    }
                }
            });
        }
    });
})