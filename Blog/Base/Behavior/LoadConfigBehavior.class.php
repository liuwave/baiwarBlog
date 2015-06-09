<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * CreateTime: 2015/6/6|17:02
 */

namespace Base\Behavior;
class LoadConfigBehavior{
    // 行为扩展的执行入口必须是run
    public function run(&$return){
        //var_dump(C("DEFAULT_LANG"));
        C(get_website_config());
        //var_dump(C("DEFAULT_LANG"));
    }

}