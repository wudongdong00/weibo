<?php
return array(
    //设置可访问目录
    'MODULE_ALLOW_LIST'=>array('Home','Admin'),
    //设置默认目录
    'DEFAULT_MODULE'=>'Home',
    'DEFAULT_THEME'=>'Default',
    'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
    'URL_MODEL'=>2,
    'DATA_CACHE_TYPE'=>'Memcache',
    'DATA_CACHE_TIME'=>600,

    'DB_TYPE'=>'mysql',
    'DB_USER'=>'root',
    'DB_PWD'=>'123456',
    'DB_PREFIX'=>'weibo_',
    'DB_DSN'=>'mysql:host=localhost;dbname=weibo;charset=UTF8',

);