/**
 * Created by Administrator on 2017/7/26.
 */
$(function () {
    var rand = Math.floor(Math.random()*4)+1;
    $('body')
        .css('background','url(' +ThinkPHP['IMG']+ '/bg'+rand+'.jpg) no-repeat')
        .css('background-size','100%');

    $('#register').dialog( {
        width :450,
        height :380,
        title : '注册新用户',
        modal : true,
        resizable : false,
        closeText : '关闭',
        autoOpen : false,
        buttons : [{
            text : '提交',
            click : function (e) {
                $(this).submit();
            }
        }],
        }).validate({
            submitHandler : function (form) {
                $('#verify_form').attr('form_id', 'register');
                $('#verify_form').dialog('open');
                $('#register').dialog('widget').find('button').eq(1).button('disable');
            },

        showErrors : function () {
            var  errors = this.numberOfInvalids();
            if(errors>0){
                errors = 1;
                $('#register').dialog('option','width',580);
            }else{
                $('#register').find('.error').html('');
                $('#register').dialog('option','width',450);
            }
            this.defaultShowErrors();
        },

        highlight : function (element, errorClass) {
            $(element).css('border', '1px solid #630');
            $(element).parent().find('span').html('*').removeClass('succ');
        },

        unhighlight : function (element, errorClass) {
            $(element).css('border', '1px solid #ccc');
            $(element).parent().find('span').html('&nbsp;').addClass('succ');
        },
        rules : {
            user : {
                required : true,
                minlength : 2,
                maxlength : 16,
                remote : {
                    url : ThinkPHP['MODULE'] + '/User/CheckUser',
                    type : 'POST',
                }
            },
            password : {
                required : true,
                minlength : 2,
                maxlength : 16,
            },
            repassword : {
                required : true,
                equalTo : '#password',
            },
            email : {
                required : true,
                email : true,
                remote : {
                    url : ThinkPHP['MODULE'] + '/User/CheckEmail',
                    type : 'POST',
                }
            },
        },
        messages : {
            user : {
                required : '帐号不得为空',
                minlength: $.format('帐号不得小于{0}位！'),
                maxlength: $.format('帐号不得大于{0}位！'),
                remote : '帐号已存在',
            },
            password : {
                required : '密码不得为空',
                minlength: $.format('帐号不得小于{0}位！'),
                maxlength: $.format('帐号不得大于{0}位！'),
            },
            repassword : {
                required : '不得为空',
                equalTo : '两次输入密码必须一致',
            },
            email : {
                required : '邮箱不得为空',
                email : '请输入争取的邮箱格式',
                remote : '邮箱已存在',
            },
        },
    });

    $('#login input[type="submit"]').button();

    $('#login').validate({
        submitHandler : function (form) {
            $('#verify_form').attr('form_id','login');
            $('#verify_form').dialog('open');
        },

        rules : {
            user: {
                required: true,
                minlength: 2,
                maxlength: 16,
            },
            password: {
                required: true,
                minlength: 2,
                maxlength: 16,
            },
        },

        messages : {
            user: {
                required: '必填',
            },
            password: {
                required: '必填',
            },
        },
    });

    var verify = $('.verifyimg').attr('src');
    $('.change_img').click(function () {
        $('.verifyimg').attr('src',verify + '?random='+ Math.random());
    });

    $('#verify_form').dialog( {
        width :290,
        height :300,
        title : '验证',
        modal : true,
        resizable : false,
        closeText : '关闭',
        autoOpen : false,
        buttons : [{
            text : '提交',
            click : function (e) {
                $(this).submit();
            },
        }],
        close : function (e) {
            if ($('#verify_form').attr('form_id') == 'register') {
                $('#register').dialog('widget').find('button').eq(1).button('enable');
            }
        }
    }).validate({
        submitHandler : function (form) {
            if ($('#verify_form').attr('form_id') == 'register') {
                $('#register').ajaxSubmit({
                    url: ThinkPHP['MODULE'] + '/User/register',
                    type: 'POST',
                    beforeSubmit: function () {
                        $('#loading').dialog('open');
                        $('#register').dialog('widget').find('button').eq(1).button('disable');
                        $('#verify_form').dialog('widget').find('button').eq(1).button('disable');
                    },
                    success: function (responseText) {
                        if (responseText) {
                            $('#register').dialog('widget').find('button').eq(1).button('enable');
                            $('#verify_form').dialog('widget').find('button').eq(1).button('enable');
                            $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px center').html('注册成功...');
                            setTimeout(function () {
                                $('#register').dialog('close');
                                $('#verify_form').dialog('close');
                                $('#loading').dialog('close');
                                $('#register').resetForm();
                                $('#verify_form').resetForm();
                                $('span.star').html('*').removeClass('succ');
                                $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('正在注册中...');
                                $('.verifyimg').attr('src',verify + '?random='+ Math.random());
                            }, 1000);
                        }
                    },
                });
            }else if($('#verify_form').attr('form_id') == 'login'){
                $('#login').ajaxSubmit({
                    url: ThinkPHP['MODULE'] + '/User/CheckLogin',
                    type: 'POST',
                    beforeSubmit : function (){
                        $('#loading').dialog('open');
                    },
                    success : function (responseText) {
                        if (responseText == -9) {
                            $('#loading').dialog('option', 'width', 210).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('帐号或密码不正确...');
                            setTimeout(function () {
                                $('#loading').dialog('close');
                                $('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
                            }, 2000);
                        } else {
                            $('#loading').dialog('option', 'width', 240).css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px center').html('登录成功，正在跳转中...');
                            setTimeout(function () {
                                location.href=ThinkPHP['INDEX'];
                            }, 1000);
                        }
                    }
                });
            }
        },

        showErrors : function () {
            var  errors = this.numberOfInvalids();
            if(errors>0){
                errors = 1;
                $('#verify_form').dialog('option','width',400);
            }else{
                $('#verify_form').find('.error').html('');
                $('#verify_form').dialog('option','width',300);
            }
            this.defaultShowErrors();
        },

        highlight : function (element, errorClass) {
            $(element).css('border', '1px solid #630');
            $(element).parent().find('span').html('*').removeClass('succ');
        },

        unhighlight : function (element, errorClass) {
            $(element).css('border', '1px solid #ccc');
            $(element).parent().find('span').html('&nbsp;').addClass('succ');
        },

        rules : {
            verify : {
                required : true,
                remote : {
                    url: ThinkPHP['MODULE'] + '/User/CheckVerify',
                    type: 'POST',
                }
            },
        },
        messages : {
            verify : {
                required :'验证码不得为空',
                remote : '验证码不正确',
            },
        },
    });

    $('#reg_link').click(function () {
       $('#register').dialog('open');
    });

    $('#loading').dialog({
        autoOpen : false,
        modal : true,
        closeOnEscape : false,
        resizable : false,
        draggable : false,
        width : 180,
        height : 50,
    }).parent().find('.ui-widget-header').hide();

    $('#email').autocomplete({
        source : function (request,response) {
            var hosts = ['qq.com', '163.com', '263.com', 'sina.com.cn','gmail.com', 'hotmail.com'],
                term = request.term,
                name = term,
                host = '',
                ix = term.indexOf('@');
            result = [];

            result.push(term);
            if(ix>-1){
                name = term.slice(0,ix);
                host=term.slice(ix+1);
            }

            if(name){
                var findHost = (host ? $.grep(hosts,function (value,index) {
                    return value.indexOf(host) > -1}) : hosts), findResult=$.map(findHost,function (value,index) {
                    return name + '@' + value;
                });
                result = result.concat(findResult);
            }
            response(result);
        },
    });
});