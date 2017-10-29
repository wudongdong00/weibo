$(function () {
    $('#nav').tree({
        url : ThinkPHP['MODULE'] + '/Index/getNav',
        lines : true,
        onLoadSuccess : function (node, data) {
            var _this = this;
            if (data) {
                $(data).each(function (index, value) {
                    if (this.state == 'closed') {
                        $(_this).tree('expandAll');
                    }
                });
            }
        },
        onClick : function (node,data) {
            if(node.url){
                if ($('#tabs').tabs('exists', node.text)) {
                    $('#tabs').tabs('select', node.text);
                }else{
                    $('#tabs').tabs('add',{
                        title : node.text,
                        closable : true,
                        href : ThinkPHP['MODULE'] + '/' + node.url
                    });
                }
            }
        }
    });

    $('#tabs').tabs();
});