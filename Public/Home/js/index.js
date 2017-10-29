/**
 * Created by Administrator on 2017/8/8.
 */
$(function () {
    $(window).load(function () {
        allHeigth();
        centerImg();
    });

    //微博高度保持一致
    function  allHeigth() {
        if ($('.main_left').height() > 0) {
            $('.main_right').height($('.main_left').height());
        }
    }


    function centerImg() {
        for (var i = 0; i < $('.lots_img img').length; i++) {
            if ($('.lots_img img').eq(i).width() > 100) {
                $('.lots_img img').eq(i).css('left', -($('.lots_img img').eq(i).width() - 100) / 2);
            } else {
                $('.lots_img img').eq(i).width(100);
            }
            if ($('.lots_img img').eq(i).height() > 100) {
                $('.lots_img img').eq(i).css('top', -($('.lots_img img').eq(i).height() - 100) / 2);
            } else {
                $('.lots_img img').eq(i).height(100);
            }
        }
    }


    //单图点击放大
    $('.weibo_content').on('click', '.img img', function () {
        $(this).parent().hide();
        var img_zoom = $(this).parent().next('.img_zoom');
        var img = img_zoom.find('img');
        img_zoom.show();
        img.attr('src', img.attr('data'));
        allHeigth();
    });

    //单图点击缩小
    $('.weibo_content').on('click', '.img_zoom img', function () {
        $(this).parent().hide();
        $(this).parent().prev('.img').show();
        allHeigth();
    });
    $('.weibo_content').on('click', '.img_zoom .in a', function () {
        $(this).parent().parent().parent().hide();
        $(this).parent().parent().parent().prev('.img').show();
        allHeigth();
    });
    //多图放大//
    $('.weibo_content').on('click', '.lots_img img', function () {
        $(this).parent().parent().find('.lots_img').hide();
        $(this).parent().parent().find('.scroll').show();
        allHeigth();
    });
    //多图缩小

    $('.weibo_content').on('click', '.scroll img', function () {
        $(this).parent().parent().parent().parent().hide();
        $(this).parent().parent().parent().parent().parent().find('.lots_img').show();
        allHeigth();
    });

    $('.weibo_content').on('click', '.scroll .in_box a', function () {
        $(this).parent().parent().parent().hide();
        $(this).parent().parent().parent().parent().find('.lots_img').show();
        allHeigth();
    });

    $('.form_button').button().click(function (e) {
        var img=[];
        var Image = $('input[name="image"]');
        var len=Image.length;
        for (var i=0;i<len;i++){
            img[i]=Image.eq(i).val();
        }
        if(img.length==0 && $('.form_text').val().length==0){
            $('#error').html('请输入微博内容...').dialog('open');
            setTimeout(function () {
                $('#error').html('...').dialog('close');
                $('.form_text').focus();
            },1000);
        }
        else if(img.length>0 && $('.form_text').val().length==0){
            $('.form_text').val('分享图片');
            ajax_send(img);
        }else{
            if(form_num()){
                ajax_send(img);
            }
        }
    })

    function ajax_send(img) {
        $.ajax({
            url : ThinkPHP['MODULE'] + '/Topic/Publish',
            type : 'POST',
            data : {
                content : $('.form_text').val(),
                img : img,
            },
            beforeSend : function () {
                $('#loading').html('微博发布中...').dialog('open');
            },
            success : function (data,response, status) {
                if(data) {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('微博发布成功...');
                    $('.pic_content,input[name="image"]').remove();
                    $('.pic_box').hide();
                    $('.pic_arrow_top').hide();
                    $('.pic_limit').text('8');
                    $('.pic_total').text('0');
                    window.uploadCount.clear();

                    var html = '';
                    switch (img.length) {
                        case 0 :
                            html = $('#ajax_html1').html();
                            break;
                        case 1 :
                            html = $('#ajax_html2').html();
                            img = $.parseJSON(img);
                            break;
                        default :
                            html = $('#ajax_html3').html();
                            for (var i = 0; i <img.length ; i ++) {
                                var img_arr = $.parseJSON(img[i]);

                                if (html.indexOf('#多图缩略'+i+'#')) {
                                    var reCat = new RegExp('#多图缩略'+i+'#','g');
                                    html = html.replace(reCat,img_arr['thumb']);

                                }
                                if (html.indexOf('#多图放大'+i+'#')) {
                                    var reCat = new RegExp('#多图放大'+i+'#','g');
                                    html = html.replace(reCat,img_arr['unfold']);
                                }

                                if (html.indexOf('#多图原图#')) {
                                    html = html.replace(/#多图原图#/g,img_arr['source']);
                                }
                            }


                    }

                    if (html.indexOf('#内容#')) {
                        html = html.replace(/#内容#/g, $('.form_text').val());
                    }

                    if (html.indexOf('#放大图#')) {
                        html = html.replace(/#放大图#/g, img['unfold']);
                    }

                    if (html.indexOf('#缩略图#')) {
                        html = html.replace(/#缩略图#/g,img['thumb']);
                    }

                    if (html.indexOf('#原图#')) {
                        html = html.replace(/#原图#/g,img['source']);
                    }

                    html = html.replace(/\[(a|b|c|d)_([0-9]+)\]/g, '<img src="' + ThinkPHP['FACE'] + '/$1/$2.gif" border="0">');

                    setTimeout(function () {
                        $('.form_text').val('');
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                        $('.weibo_content ul').after(html);
                        allHeigth();
                    }, 50);
                }
            },
        });
    }
    $('.form_text').on('keyup',form_num);

    $('.form_text').on('focus',function () {
       setTimeout(function () {
           form_num();
       },50);
    });

    function form_num() {
        var total=280;
        var len = $('.form_text').val().length;
        var temp = 0;
        if(len>0){
            for (var i=0;i<len;i++){
                if($('.form_text').val().charCodeAt(i)>255){
                    temp+=2;
                }else{
                    temp++;
                }
            }
            var result = parseInt((total-temp)/2-0.5);
            if(result>=0){
                $('.form_num').html('您还可以输入<strong>' + result + '</strong>个字');
                return true;
            }else{
                $('.form_num').html('已超过<strong>' + result + '</strong>个字');
            }
        }
    }

    var page= 1;
    var i = 1;//每版四个图片
//向右滚动
    $(".weibo_content").on('click','.next',function () {
        var v_wrap = $(this).parents(".scroll"); // 根据当前点击的元素获取到父元素
        var v_show = v_wrap.find(".scroll_list"); //找到视频展示的区域
        var v_cont = v_wrap.find(".box"); //找到视频展示区域的外围区域
        var v_width = v_cont.width();
        var len = v_show.find('.imgs').length; //我的视频图片个数

        var page_count = Math.ceil(len/i); //只要不是整数，就往大的方向取最小的整数
        if(!v_show.is(":animated")){
            if(page == page_count){
                v_show.animate({left:'0px'},"slow");
                page =1;
            }else{
                v_show.animate({left:'-='+v_width},"slow");
                page++;
            }
        }

    })

//向左滚动
    $(".weibo_content").on('click','.prev',function () { //点击事件
        var v_wrap = $(this).parents(".scroll"); // 根据当前点击的元素获取到父元素
        var v_show = v_wrap.find(".scroll_list"); //找到视频展示的区域
        var v_cont = v_wrap.find(".box"); //找到视频展示区域的外围区域
        var v_width = v_cont.width();
        var len = v_show.find(".imgs").length; //我的视频图片个数
        var page_count = Math.ceil(len/i); //只要不是整数，就往大的方向取最小的整数
        if(!v_show.is(":animated")){
            if(page == 1){
                v_show.animate({left:'-='+ v_width*(page_count-1)},"slow");
                page =page_count;
            }else{
                v_show.animate({left:'+='+ v_width},"slow");
                page--;
            }
        }
    });

    //得到总页码
    $.ajax({
        url : ThinkPHP['MODULE'] + '/Topic/ajaxCount',
        type : 'POST',
        data : {

        },
        success: function(data, response, status){
            window.count = parseInt(data);
        }
    });

    setUrl();
    function setUrl() {
        for (var i=0;i<$('.space').length;i++){
            var user=$('.space').eq(i).text().substr(1);
            if ($('.space').eq(i).attr('flag') != 'true') {
                $.ajax({
                    url: ThinkPHP['MODULE'] + '/Space/setUrl',
                    type: 'POST',
                    async: false,
                    data: {
                        'user': user
                    },
                    success: function (data, response, status) {
                        if (data) {
                            $('.space').css('text-decoration','none').css('color','red');
                            $('.space').eq(i).attr('href', data);
                            $('.space').eq(i).attr('flag', true);
                        }else{
                            $('.space').eq(i).after('@' + user);
                            $('.space').get(i).remove();
                        }
                    }
                });
            }
        }
    }

    //滚动条拖动
    window.scrollFlag = true;
    window.first = 10;
    window.page = 1;
    $(window).scroll(function () {
        if (window.page < window.count) {
            if (window.scrollFlag) {
                if ($(document).scrollTop() >= ($('#load_more').offset().top + $('#load_more').outerHeight() - $(window).height() - 20)) {
                    setTimeout(function(){
                        $.ajax({
                            url: ThinkPHP['MODULE'] + '/Topic/ajaxList',
                            type: 'POST',
                            data: {
                                first: window.first,
                            },
                            success: function(data, response, status){
                                $('#load_more').before(data);
                                allHeigth();
                                setUrl();
                            }
                        });
                        window.scrollFlag = true;
                        window.first += 10;
                        window.page += 1;
                    }, 500);
                    window.scrollFlag = false;
                }
            }
        } else {
            $('#load_more').html('没有更多数据');
        }
    });

    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '300', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: '', // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active
    });

    $('.re').click(function () {
        if($(this).parent().parent().find('.re_box').is(':hidden')){
            $(this).parent().parent().find('.com_box').hide();
            $(this).parent().parent().find('.re_box').show();
            $(this).parent().parent().find('.re_text').focus();
        }else{
            $(this).parent().parent().find('.re_box').hide();
        }
    });

   //转发微博
    $('.re_button').button().click(function () {
        var reid=$(this).parent().find('input[name="reid"]').val();
        var retext=$(this).parent().find('textarea[name="commend"]').val();
        var commend = $(this).parent().find('textarea[name="commend"]');
        var box=$(this).parent().parent().find('.re_box');
        $.ajax({
            url: ThinkPHP['MODULE'] + '/Topic/reBoard',
            type: 'POST',
            data: {
                reid : reid,
                content : retext,
            },
            beforeSend : function () {
                $('#loading').html('微博转发中...').dialog('open');
            },
            success : function(data, response, status){
                if (data) {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('微博转发成功...');
                    setTimeout(function(){
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                        commend.val('');
                        location.reload(true);
                        box.hide();
                    },500);
                }
            }
        });
    });

    //获取评论列表
    $('.com').click(function () {
        if ($(this).parent().parent().find('.com_box').is(':hidden')) {
            $(this).parent().parent().find('.re_box').hide();
            $(this).parent().parent().find('.com_box').show();
            $(this).parent().parent().find('.com_text').focus();
            var comment = $(this).parent().parent().find('.commend_content');
            var tid = $(this).parent().parent().find('input[name="tid"]').val();
            $.ajax({
                url : ThinkPHP['MODULE'] + '/Commend/getList',
                type : 'POST',
                data : {
                    tid : tid,
                    page : 1,
                },
                beforeSend : function () {
                    //加载中。。。
                    comment.append('<p style="text-align:center;">评论加载中<img src="' + ThinkPHP['IMG'] + '/load_more.gif" alt=""></p>');
                },
                success : function(data, response, status){
                    if (data) {
                        //删除子节点所有评论
                        comment.find('*').remove();
                        //添加评论内容
                        comment.append(data);
                        //@帐号
                        setUrl();
                        //高度
                    }
                }
            });
        } else {
            $(this).parent().parent().find('.com_box').hide();
        }
    });

    //分页点击
    $('.re_com_box').on('click', '.page_comment', function () {
        var page = $(this).attr('page');
        var comment = $(this).parent().parent().parent().find('.commend_content');
        var tid = $(this).parent().parent().parent().find('input[name="tid"]').val();
        //删除子节点所有评论
        comment.find('*').remove();
        $.ajax({
            url : ThinkPHP['MODULE'] + '/Commend/getList',
            type : 'POST',
            data : {
                tid : tid,
                page : page,
            },
            beforeSend : function () {
                //加载中。。。
                comment.append('<p style="text-align:center;">评论加载中<img src="' + ThinkPHP['IMG'] + '/load_more.gif" alt=""></p>');
            },
            success : function(data, response, status){
                if (data) {
                    //删除子节点所有评论
                    comment.find('*').remove();
                    //添加评论内容
                    comment.append(data);
                    //@帐号
                    setUrl();
                    //高度
                }
            }
        });
    })

    //评论微博
    $('.com_button').button().click(function () {
        var tid=$(this).parent().find('input[name="tid"]').val();
        var content=$(this).parent().find('textarea[name="commend"]').val();
        var commend = $(this).parent().find('textarea[name="commend"]');
        var box=$(this).parent().parent().find('.com_box');
        $.ajax({
            url: ThinkPHP['MODULE'] + '/Commend/Publish',
            type: 'POST',
            data: {
                tid : tid,
                content : content
            },
            beforeSend : function () {
                $('#loading').html('微博评论中...').dialog('open');
            },
            success : function(data, response, status){
                if (data) {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px 65%').html('微博评论成功...');
                    setTimeout(function(){
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px 65%').html('...').dialog('close');
                        commend.val('');
                        box.hide();
                    },500);
                }
            }
        });
    });

    getMsg();
    function getMsg() {
        $.ajax({
            url : ThinkPHP['MODULE'] + '/Index/getWeibo',
            type : 'POST',
            success : function(data, response, status){
                if (data) {
                    if (data.length > 0) {
                        $('.msg').show().text('约' + data.length + '条新广播，点击查看')
                    } else {
                        $('.msg').hide().text('');
                    }
                }
            }
        });
        setTimeout(function () {
            getMsg();
        }, 5000);
    };

    $('.msg').click(function () {
        location.reload();
    });

})