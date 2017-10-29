/**
 * Created by Administrator on 2017/9/1.
 */
$(function () {

    $('#topic').datagrid({
        url : ThinkPHP['MODULE'] + '/Topic/getList',
        fitColumns : true,
        rownumbers : true,
        border : false,
        striped : true,
        pagination : true,
        pageList : [4, 6, 8, 10, 12],
        pageNumber : 1,
        pageSize : 4,
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
                title : '微博内容',
                width : 100,
            },
            {
                field : 'reid',
                title : '是否转发',
                width : 30,
                formatter : function (value) {
                    if (value == 0) {
                        return '否';
                    } else {
                        return '是';
                    }
                },
            },
            {
                field : 'recount',
                title : '转发次数',
                width : 30,
            },
            {
                field : 'comcount',
                title : '评论次数',
                width : 30,
            },
            {
                field : 'create',
                title : '发表时间',
                width : 100,
                sortable : true,
            },
        ]],
    });

})