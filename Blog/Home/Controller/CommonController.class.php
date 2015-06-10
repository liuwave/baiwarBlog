<?php
namespace Home\Controller {
use Think\Controller;
     
class CommonController extends Controller{

    public function _initialize(){
        $this->menu=get_menu();
        //var_dump(get_menu());
        //$this->assign("menu",get_menu());
        C(get_website_config());


    }

	
}

}