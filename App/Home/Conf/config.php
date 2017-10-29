<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__js__' =>__ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__img__'=>__ROOT__.'/Public/'.MODULE_NAME.'/img',
        '__css__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
        '__upload__'=>__ROOT__.'/Public/'.MODULE_NAME.'/uploadify',
    ),
    'SHOW_PAGE_TRACE'=>true,
    'COOKIE_key'=>'www.facai.com',
    'TMPL_ACTION_ERROR' => 'Public/jump',
    //默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Public/jump',
    'UPLOAD_PATH'=>'./Uploads/',
    'FACE_PATH'=>'./Uploads/face/',
    //启用路由功能
    'URL_ROUTER_ON'=>true,
    //配置路由规则
    'URL_ROUTE_RULES'=>array(
        //每条键值对，对应一个路由规则
        'i/:domin'=>'Space/index',
    ),
);