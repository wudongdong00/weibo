/**
 * Created by Administrator on 2017/8/15.
 */
$(function () {
    $('.sumbit').button().click(function () {
        $.ajax({
            url : ThinkPHP['MODULE'] + '/Setting/updateUser',
            type : 'POST',
            data : {
                email : $('input[name=email]').val(),
                info : $('textarea[name=info]').val(),
            },
            beforeSend : function () {
                $('#loading').html('正在修改中...').dialog('open');
            },
            success : function (data,response, status) {
                $('#loading').css('background', 'url(' + ThinkPHP['IMG']+ '/success.gif) no-repeat 20px 65%').html('资料修改成功...');
                setTimeout(function () {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                }, 500);
            }
        });
    });

    if ($('#file').length > 0) {
        $('#file').uploadify({
            swf: ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
            uploader: ThinkPHP['FACEURL'],
            width: 120,
            height: 35,
            fileTypeDesc: '图片类型',
            buttonCursor: 'pointer',
            buttonText: '上传头像',
            fileTypeExts: '*.jpeg; *.jpg; *.png; *.gif',
            fileSizeLimit: '1MB',
            overrideEvents: ['onSelectError', 'onSelect', 'onDialogClose'],

            onUploadStart: function () {
                $('#loading').html('头像上传中...').dialog('open');
            },
            onUploadSuccess: function (file, data, response) {
                if (data) {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('头像上传成功...');
                    $('#face, #crop_preview').attr('src', ThinkPHP['ROOT'] + '/' + $.parseJSON(data));
                    $('#preview_box').show();
                    $('#url').val($.parseJSON(data));
                    $('.save,.cancel').button().show();

                    //裁剪头像
                    $('#face').one('load', function () {
                        //裁剪头像
                        jcrop = $.Jcrop('#face', {
                            onChange: showPreview,
                            onSelect: showPreview,
                            //锁定纵横比
                            aspectRatio: 1,
                        });
                        //uploadify在没有图片加载完毕后，就消失导致错误
                        $('#file').hide();
                        jcrop.setSelect([0, 0, 200, 200]);
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                    });
                }
            }
        });
    }

    //取消当前图片裁剪
    $('.cancel').click(function (e) {
        jcrop.destroy();
        if(ThinkPHP['BIGFACE'].length>0){
            $('#face,#crop_preview').attr('src', ThinkPHP['IMG'] + ThinkPHP['BIGFACE']);
        }else{
            $('#face,#crop_preview').attr('src', ThinkPHP['IMG'] + '/big.jpg');
        }
        $('#preview_box').hide();
        $('.save,.cancel').hide();
        $('#file').show();
        return nothing(e);
    });

    //简单的事件处理程序，响应自onChange,onSelect事件，按照上面的Jcrop调用
    function showPreview(coords){
        $('#x').val(coords.x);
        $('#y').val(coords.y);
        $('#w').val(coords.w);
        $('#h').val(coords.h);
        if(parseInt(coords.w) > 0){
            //计算预览区域图片缩放的比例，通过计算显示区域的宽度(与高度)与剪裁的宽度(与高度)之比得到
            var rx = $("#preview_box").width() / coords.w;
            var ry = $("#preview_box").height() / coords.h;
            //通过比例值控制图片的样式与显示
            $("#crop_preview").css({
                width:Math.round(rx * $("#face").width()) + "px",	//预览图片宽度为计算比例值与原图片宽度的乘积
                height:Math.round(rx * $("#face").height()) + "px",	//预览图片高度为计算比例值与原图片高度的乘积
                marginLeft:"-" + Math.round(rx * coords.x) + "px",
                marginTop:"-" + Math.round(ry * coords.y) + "px"
            });
        }
    }

    // 处理程序阻止事件的继续进行，可能不是必须的，但是原作者(Kelly Hallman)很喜欢
    function nothing(e){
        e.stopPropagation();
        e.preventDefault();
        return false;
    };

    $('.save').click(function () {
        $.ajax({
            url: ThinkPHP['MODULE'] + '/File/savePic',
            type: 'POST',
            data: {
                x : $('#x').val(),
                y : $('#y').val(),
                w : $('#w').val(),
                h : $('#h').val(),
                url : $('#url').val()
            },
            beforeSend : function () {
                jcrop.destroy();
                $('.cancel,.save').hide();
                $('#loading').html('头像保存中...').dialog('open');
            },
            success: function(data, response, status){
                if (data) {
                    if(data) {
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('头像修改成功...');
                        $('#face').attr('src',ThinkPHP['ROOT'] + $.parseJSON(data)['big']+'?random='+Math.random());
                        $('#file').show();
                        $('#preview_box').hide();
                        setTimeout(function () {
                            $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                        }, 50);
                    }
                }
            }
        });
    });

    $('.read').click(function () {
        var _this = this;
        if ($(this).attr('class') == 'read red') {
            $.ajax({
                url: ThinkPHP['MODULE'] + '/Setting/readRefer',type: 'POST',
                data: {
                    id: $(_this).attr('rid'),
                },
                beforeSend: function(){
                    $('#loading').html('阅读确认中...').dialog('open');
                },
                success: function(data, response, status){
                    if (data) {
                        $('#loading').css('background', 'url(' +
                            ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('已读完毕...');
                        $(_this).text('[已读]');
                        $(_this).removeClass('red').addClass('green');
                        $(_this).parent().removeClass('a').addClass('b');
                        setTimeout(function(){
                            $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                        }, 500);
                    }
                }
            });
        }
    });
})