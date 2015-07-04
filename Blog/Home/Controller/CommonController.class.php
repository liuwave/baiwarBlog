<?php
namespace Home\Controller ;
use Think\Controller;

class CommonController extends Controller {

    public $seo=array();
    public function _initialize() {
        //$this->menu=get_menu();
        //var_dump(get_menu());
/*
        $Cates=D('category');
        $rootCate=$Cates->getTree(0);
        $this->assign("rootCate",$rootCate);
*/
        C(get_website_config());



        $this->seo["title"]=C("blogname")."_".C("subtitle");
        $this->seo["keywords"]=C("keywords");
        $this->seo["description"]=C("description");

        $this->assign($this->seo);
        $this->assign("menu", get_menu());




    }
}
