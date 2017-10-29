/**
 * 图片插件
 */
$(function () {
    var wu_pic={
        uploadlimit : 8,
        uploadtotal : 0,
        uploadify : function () {
            $('#file').uploadify({
                swf : ThinkPHP['UPLOADIFY']+'/uploadify.swf',
                uploader :ThinkPHP['IMAGE'],
                fileTypeDesc : '图片类型',
                buttonCursor : 'pointer',
                buttonText : '上传图片',
                fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
                overrideEvents : ['onSelectError','onSelect','onDialogClose'],

                onUploadStart : function () {
                    if (wu_pic.uploadtotal == 8) {
                        $('#file').uploadify('stop');
                        $('#file').uploadify('cancel');
                        $('#error').dialog('open').html('限制为8张...');
                        setTimeout(function () {
                            $('#error').dialog('close').html('...');
                        }, 1000);
                    }else{
                        $('.pic_list').append('<div class="pic_content"><span class="remove"></span><span class="text">删除</span><img src="'+ThinkPHP['IMG']+'/loading_100.png" class="pic_img"></div>');
                    }
                },
                onUploadSuccess : function (file,data,response) {
                    $('.pic_list').append('<input type="hidden" name="image" value='+ data+'>');
                    var Image=$.parseJSON(data);
                    wu_pic.thumb(Image['thumb']);
                    wu_pic.hover();
                    wu_pic.remove();
                    wu_pic.uploadlimit--;
                    wu_pic.uploadtotal++;
                    $('.pic_limit').text(wu_pic.uploadlimit);
                    $('.pic_total').text(wu_pic.uploadtotal);
                }
            });
        },

        thumb : function (src) {
            var img = $('.pic_img');
            var len = img.length;
            $(img[len - 1]).attr('src', ThinkPHP['ROOT'] + src).hide();
            setTimeout(function () {
                if ($(img[len - 1]).width() > 100) {
                    $(img[len - 1]).css('left', -($(img[len - 1]).width() - 100) / 2);
                }
                if ($(img[len - 1]).height() > 100) {
                    $(img[len - 1]).css('top', -($(img[len - 1]).height() - 100) / 2);
                }
                $(img[len - 1]).attr('src', ThinkPHP['ROOT'] + src).fadeIn();
            }, 50);
        },
        
        hover :function () {
            var content=$('.pic_content');
            var len=content.length;
            $(content[len-1]).hover(function () {
                $(this).find('.remove').show();
                $(this).find('.text').show();
            },function () {
                $(this).find('.remove').hide();
                $(this).find('.text').hide();
            });
        },

        remove : function () {
            var remove=$('.pic_content .text');
            var len=remove.length;
            $(remove[len-1]).on('click',function () {
                $(this).parent().next('input[name="image"]').remove();
                $(this).parent().remove();
                wu_pic.uploadlimit++;
                wu_pic.uploadtotal--;
                $('.pic_limit').text(wu_pic.uploadlimit);
                $('.pic_total').text(wu_pic.uploadtotal);
            })
        },
        
        init :function () {
            $('#pic_btn').bind('click',function(){
                var w = $(this).position();
                $('#pic_boxed').css({left:w.left-44,top:w.top+30}).show();
                $('.pic_arrow_top').show();
                wu_pic.uploadify();
            });

            $('#pic_boxed a.close').bind('click',function(){
                $('#pic_boxed').hide();
                $('.pic_arrow_top').hide();
            });
/*
            $(document).bind('click',function(e){
                var target = $(e.target);
                if( target.closest("#pic_btn").length == 1 ||target.closest('.pic_content .text').length==1 )
                    return;
                if( target.closest("#pic_boxed").length == 0 ){
                    $('#pic_boxed').hide();
                    $('.pic_arrow_top').hide();
                }
            }); */
        }
    };
    wu_pic.init();
    window.uploadCount = {
        clear : function () {
            wu_pic.uploadtotal=0;
            wu_pic.uploadlimit=8
        }
    };
})