<?php
return array(
   'app_begin' => array('Base\Behavior\LoadConfigBehavior','Behavior\CheckLangBehavior'),
   'view_filter' => array('Behavior\TokenBuildBehavior'),

);
?>