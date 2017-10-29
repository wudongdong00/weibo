<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__js__' =>__ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__img__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/img',
        '__css__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/css',
        '__easyui__'=>__ROOT__.'/PUBLIC/'.MODULE_NAME.'/easyui',
    ),

    'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL)

);