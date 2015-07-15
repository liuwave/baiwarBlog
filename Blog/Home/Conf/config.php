<?php
//$tempconfig = require('./Blog/Common/Conf/Temp.php');
//$webconfig = require('./Blog/Common/Conf/Settings.php');
$tempconfig=get_website_config(0,5);
$webconfig=get_website_config(0,3);
$dbconfig = require('./config.inc.php');
//var_dump($tempconfig);
$config =  array(

   'LOG_RECORD' => false,
   'LOG_EXCEPTION_RECORD'  =>  false,
	'DEFAULT_THEME'    =>   $tempconfig['templateName'],


	'VIEW_PATH'=>'./Template/',
	
	'TMPL_PARSE_STRING'=>array(     
        '[!TEMPLATE]'=>TMPL_PATH.'',
        '[!CSS]'=>__ROOT__.'/Template/'.$tempconfig['templateName'].'/Style/Css/',
        '[!JS]'=>__ROOT__.'/Template/'.$tempconfig['templateName'].'/Style/Js/',
        '[!IMG]'=>__ROOT__.'/Template/'.$tempconfig['templateName'].'/Style/Img/',
        '__ROOT__'=>__ROOT__.'/',
        '__PUBLIC__'=>__ROOT__.'/Public/',
	  ),
	  

	'URL_HTML_SUFFIX'=>'html' ,
	'URL_MODEL'=>2,
    'URL_ROUTER_ON'=>true,
	'URL_ROUTE_RULES' => array(
     '/^news\/(\d*)$/'=>'Home/Content/index?catename=news&id=:1',
     '/^intro\/(\d+)$/'=>'Home/Content/index?catename=intro&id=:1',
     '/^tech\/(\d+)$/'=>'Home/Content/index?catename=tech&id=:1',
     '/^server\/(\d+)$/'=>'Home/Content/index?catename=server&id=:1',
     '/^product\/(\d+)$/'=>'Home/Product/detail?id=:1',

     '/^news$/'=>'Home/List/index?name=news',
     '/^intro$/'=>'Home/List/index?name=intro',
     '/^tech$/'=>'Home/List/index?name=tech',
     '/^server$/'=>'Home/List/index?name=server',
     '/^product$/'=>'Home/Product/index',
     '/^sitemap$/'=>'Home/Sitemap/index',

	 '/^page\/([A-Za-z0-9]+$)/' => 'Home/Page/index?name=:1',
	 '/^other\/([A-Za-z0-9]+$)/' => 'Home/other/index?name=:1',
	 '/^content\/(\d+)$/' => 'Home/Content/index?id=:1',
	 '/^list\/(\d+)$/' => 'Home/List/index?id=:1',
     '/^list\/([A-Za-z0-9]+$)/' => 'Home/List/index?name=:1',
	 ),
	'DEFAULT_FILTER' => 'htmlspecialchars,stripslashes',
	'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
	'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
	'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5\
	'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

);
return array_merge($dbconfig,$config,$webconfig,$tempconfig);