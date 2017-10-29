/**
 * Created by Administrator on 2017/9/1.
 */
$(function () {

    $('#comment').datagrid({
        url : ThinkPHP['MODULE'] + '/Comment/getList',
        fitColumns : true,
        rownumbers : true,
        border : false,
        striped : true,
        pagination : true,
        pageList : [1, 2, 3, 4, 5],
        pageNumber : 1,
        pageSize : 1,
        sortName : 'create',
        sortOrder : 'DESC',
        columns : [[
            {
                field : 'id',
                title : '编号',
                width : 100,
                checkbox : true,
            },
            {
                field : 'content',
                title : '评论内容',
                width : 100,
            },
            {
                field : 'create',
                title : '评论时间',
                width : 100,
                sortable : true,
            },
        ]],
    });

});
