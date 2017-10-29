/**
 * Created by Administrator on 2017/8/15.
 */
$(function () {
    $('.app').hover(function () {
        $(this).css({
            background: '#fff',
            color: '#333',
        }).find('.list').show();
    }, function () {
        $(this).css({
            background: 'none',
            color: '#fff',
        }).find('.list').hide();
    });

    $('.refer span').click(function () {
        $(this).parent().remove();
    });

    $('#error').dialog({
        width : 190,
        height : 50,
        closeOnEscape : false,
        modal : true,
        resizable : false,
        draggable : false,
        autoOpen : false,
    }).parent().find('.ui-widget-header').hide();

    $('#loading').dialog({
        width : 190,
        height : 50,
        closeOnEscape : false,
        modal : true,
        resizable : false,
        draggable : false,
        autoOpen : false,
    }).parent().find('.ui-widget-header').hide();

    //ajax轮询显示@条数
    getRefer();
    function getRefer() {
        $.ajax({
            url : ThinkPHP['MODULE'] + '/Home/getRefer',
            type : 'POST',
            success : function(data, response, status){
                if (data > 0) {
                    $('.refer').show().find('b').text(data);
                    $('.list').find('span').text('('+data+')').css({
                        color: 'red',
                        fontWeight: 'bold'
                    });
                } else {
                    $('.refer').hide();
                    $('.list').find('span').text('(' + data + ')').css({
                        color : '#333',
                        fontWeight : 'normal',
                    });
                }
            }
        });
        setTimeout(function () {
            getRefer();
        },5000);
    }
})