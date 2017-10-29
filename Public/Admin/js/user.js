/**
 * Created by Administrator on 2017/8/30.
 */
$(function () {
    $('#user').datagrid({
        url : ThinkPHP['MODULE'] + '/User/getList',
        pagination : true,
        pageSize : 4,
        pageList : [4, 5, 6, 7, 8],
        pageNumber : 1,
        fitColumns : true,
        striped : true,
        rownumbers : true,
        border : false,
        sortName : 'last_time',
        sortOrder : 'DESC',
        toolbar : '#user_tool',
        columns :[[
            {
                field : 'id',
                title : '会员编号',
                width : 100,
                checkbox :true
            },
            {
                field : 'user',
                title : '会员名',
                width : 100
            },
            {
                field : 'email',
                title : '邮箱',
                width : 100
            },
            {
                field : 'last_time',
                title : '注册时间',
                width : 100,
                sortable : true
            },
        ]],
    });

    $('#user_add').dialog({
        width : 350,
        height : 420,
        title : '新增用户',
        iconCls : 'icon-user-add',
        modal : true,
        closed : true,
        buttons : [
            {
                text : '提交',
                iconCls : 'icon-add-new',
                handler : function () {
                    if($('#user_add').form('validate')){
                        $.ajax({
                            url : ThinkPHP['MODULE'] + '/User/register',
                            type : 'POST',
                            data : {
                                user : $.trim($('input[name="user"]').val()),
                                password : $('input[name="password"]').val(),
                                email : $.trim($('input[name="email"]').val()),
                                intro : $.trim($('textarea[name="intro"]').val()),
                            },

                            beforeSend : function () {
                                $.messager.progress({
                                    text : '正在提交中...',
                                });
                            },

                            success : function (data) {
                                $.messager.progress('close');
                                if(data > 0){
                                    $.messager.show({
                                        title : '提示',
                                        msg : '新增用户成功'
                                    });
                                    $('#user_add').dialog('close');
                                } else if (data == -4) {
                                    $.messager.alert('警告操作', '用户帐号被占用！',
                                        'warning', function () {
                                            $('input[name="username"]').select();
                                    });
                                } else if (data == -5) {
                                    $.messager.alert('警告操作', '邮箱被占用！',
                                        'warning', function () {
                                            $('input[name="email"]').select();
                                        });
                                } else {
                                    $.messager.alert('警告操作', '未知操作，请重新提交！', 'warning');
                                }
                            }
                        });
                    }
                }
            },
            {
                text : '取消',
                iconCls : 'icon-redo',
                handler : function () {
                    $('#user_add').dialog('close');
                }
            }
        ],
        onClose : function () {
            $('#user_add').form('reset');
        }
    });

    $('#user_edit').dialog({
        width : 350,
        height : 420,
        title : '修改用户',
        iconCls : 'icon-user-add',
        modal : true,
        closed :true,
        buttons : [
            {
                text : '提交',
                iconCls : 'icon-add-new',
                handler : function () {
                    if($('#user_edit').form('validate')) {
                        var rows = $('#user').datagrid('getSelections');
                        $.ajax({
                            url: ThinkPHP['MODULE'] + '/User/saveUser',
                            type: 'POST',
                            data: {
                                id : rows[0].id,
                                password : $('input[name="edit_password"]').val(),
                                email : $.trim($('input[name="edit_email"]').val()),
                                intro : $.trim($('textarea[name="edit_intro"]').val()),
                                source_intro : $.trim($('input[name="source_intro"]').val()),
                            },
                            beforeSend: function () {
                                $.messager.progress({
                                    text: '正在提交中...',
                                });
                            },

                            success: function (data) {
                                $.messager.progress('close');
                                if (data > 0) {
                                    $('#user_edit').dialog('close');
                                    $.messager.show({
                                        title : '提示',
                                        msg : '修改用户成功'
                                    });
                                }
                            }
                        });
                    }
                }
            },
            {
                text : '取消',
                iconCls : 'icon-redo',
                handler : function () {
                    $('#user_edit').dialog('close');
                }
            }
        ],
        onClose : function () {
            $('#user_edit').form('reset');
        }
    });

    $('input[name="user"]').validatebox({
        required :true,
        validType : 'length[2,20]',
        missingMessage : '请输入会员帐号',
        invalidMessage : '帐号长度不正确'
    });

    $('input[name="password"]').validatebox({
        required : true,
        validType : 'length[6,30]',
        missingMessage : '请输入会员密码',
        invalidMessage : '会员密码在 6-30 位',
    });

    $('input[name="edit_password"]').validatebox({
        validType : 'length[6,30]',
        invalidMessage : '会员密码在 6-30 位',
    });


    $('input[name="email"],input[name="edit_email"]').validatebox({
        required :true,
        validType : 'email',
        missingMessage : '请输入会员邮箱',
        invalidMessage : '邮箱格式不正确'
    });


    user_tool = {
        seaaa : function () {
            $('#user').datagrid('load', {
                username : $.trim($('input[name="username"]').val()),
                date_from : $('input[name="date_from"]').val(),
                date_to : $('input[name="date_to"]').val(),
            });
        },
        remove : function () {
          var rows = $('#user').datagrid('getSelections');
          if(rows.length>0){
              $.messager.confirm('确定操作','您真的要删除所选的<strong>' + rows.length + '</strong>条记录吗？',function (flag) {
                  if(flag){
                      var ids=[];
                      for(var i = 0;i<rows.length;i++){
                          ids.push(rows[i].id);
                      }
                      $.ajax({
                              type : 'POST',
                              url : ThinkPHP['MODULE'] + '/User/remove',
                              data : {
                                  ids : ids.join(',')
                              },
                              beforeSend : function () {
                                  $('#user').datagrid('loading');
                              },success : function (data) {
                                  $('#user').datagrid('loaded');
                                  $('#user').datagrid('reload');
                                  $.messager.show({
                                      title : '提示',
                                      msg : data + '个用户被删除成功！',
                                  })
                              },
                      });
                  }
              });
          } else {
              $.messager.alert('警告', '删除记录至少选定一条数据！',
                  'warning');
          }
        },
        ediit : function () {
            var rows = $('#user').datagrid('getSelections');
            if(rows.length>1){
                $.messager.alert('警告','一次只能修改一个用户','warning');
            }else if(rows.length == 1){
                $.ajax({
                    type : 'POST',
                    url : ThinkPHP['MODULE'] + '/User/getUser',
                    data : {
                        id : rows[0].id,
                    },
                    beforeSend : function () {
                        $.messager.progress({
                            text : '正在尝试获取数据...',
                        });
                    },
                    success : function (data) {
                        $.messager.progress('close');
                        if (data) {
                            $('#user_edit').form('load', {
                                edit_user : data.user,
                                edit_email : data.email,
                                edit_intro : data.extend ? data.extend.info : '',
                                source_intro : data.extend ? data.extend.intro : '',
                            }).dialog('open');
                        }
                    },
                });
            }else if(rows.length == 0){
                $.messager.alert('警告','未选择任何用户','warning');
            }
        },
        add : function () {
          $('#user_add').dialog('open');
          $('inpue[name="user"]').focus();
        },
        redo : function () {
          $('#user').datagrid('unSelsctALL');
        },
        reload : function () {
            $('#user').datagrid('reload');
        },
    };
});