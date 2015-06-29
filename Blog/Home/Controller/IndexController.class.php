<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController {
	
    public function index(){



        $field=	array('aid','summary','img');
        $article=M('article')->field($field)->find(8);
        $this->assign("intro",$article);
//        var_dump(get_article_by_cate("news"));
        $this->assign("news",get_article_by_cate("news"));

		$this->display();
   
    }


		   
}