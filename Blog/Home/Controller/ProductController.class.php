<?php
namespace Home\Controller;
use Think\Controller;

class ProductController extends CommonController {
    public function index(){

        $where['is_delete']=0;
        $Product=M('Product');
        $count = $Product->where($where)->count();
        $Page =new \Think\Page($count,15);

        $list=$Product->where($where)->order("add_time desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $show = $Page->show();

        $this->seo["title"].="_". "产品列表";
        $keywordArr=explode(",",$this->seo["keywords"]);
        $keywordArr[]="产品列表";

        $this->seo["keywords"]=implode(",",array_unique($keywordArr));
        $this->seo["description"].="这是苜草素产品列表，由四川蓝海洋科技有限公司生产";
        $this->assign($this->seo);

        $this->assign('page',$show);
        $this->assign('list',$list);
		$this->display();
    }
    public function detail(){
        $pid=I("id","");
        if(empty($pid)){
            //todo
        }
        $where["pid"]=$pid;
        $product=M("Product")->where($where)->find();
        if($product){
            $this->assign("product",$product);
        }

        $this->seo["title"].="_".$product["name"];
        $keywordArr=explode(",",$this->seo["keywords"]);

        if(!empty($product["keywords"])){
            $keywordArr1=explode(" ",$product["keywords"]);
            $keywordArr=array_merge($keywordArr,$keywordArr1);
        }

        $this->seo["keywords"]=implode(",",array_unique($keywordArr));
        $this->seo["description"].="这是{$product["name"]}，由四川蓝海洋科技有限公司生产";
        $this->assign($this->seo);

        $this->display();
    }
}