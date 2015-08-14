<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController {
	
    public function index(){



        $field=	array('aid','summary','img');
        $article=M('article')->field($field)->find(8);
        $product=M('Product')->select();
        if($product){
            $this->assign("product",$product);
            $this->assign("productCount",count($product));
        }


        $this->assign("intro",$article);
//        var_dump(get_article_by_cate("news"));
        $this->assign("news",get_article_by_cate("news",7));
//        var_dump(get_article_by_cate("tech"));
        $this->assign("tech",get_article_by_cate("tech",7));
        $this->assign("server",get_article_by_cate("server",7));

		$this->display();
   
    }


		   
}