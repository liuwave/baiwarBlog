<?php
$config = require './config.inc.php';
$array = array(
	'URL_CASE_INSENSITIVE'=>true,
	'URL_HTML_SUFFIX' => '', 
	'LOAD_EXT_CONFIG' => 'Settings,Lang,Picture,Temp',
	'LANG_SWITCH_ON' => true,
    "LANG_AUTO_DETECT"=>true,
    'LANG_LIST'        => 'zh-cn,zh-tw,ja-jp,en-us', // 允许切换的语言列表 用逗号分隔
	'DEFAULT_LANG'          =>  'zh-cn', 
	'VAR_LANGUAGE'     => 'l', 
	'rootPath' => './Uploads/Picture/', 
	'DATA_BACKUP_PATH' => './Blog/Backups',
	'DATA_BACKUP_PART_SIZE' => 20971520,
	'DATA_BACKUP_COMPRESS' => 1,
	'DATA_BACKUP_COMPRESS_LEVEL' => 9,
	'MODULE_DENY_LIST'      =>  array('Common','Runtime'), 
	'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),

    'WEBSITE_CONFIG_TAG' => "WEBSITE_CONFIG_TAG"
);
return array_merge($config,$array);
?> 