<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * CreateTime: 2015/8/12|15:49
 */

namespace Admin\Controller;
use Think\Controller;


class ProductController extends CommonController{
    function index(){

    }
    function product(){
        $action=I("get.action","");
        if(!empty($action)){
            $product_id=I("get.pid","");
            if(!empty($product_id)){
                $product=M("Product")->where(array("pid"=>$product_id))->find();
                $this->assign("product",$product);

            }
        }
        $this->display();
    }
    function add(){
        if(!IS_POST)
            $this->error("非法请求");

        $pid=I("post.pid",0);
        $data["img"]=I("post.img","");
        $data["thumb"]=I("post.thumb","");
        $data["name"]=I("post.name","");
        $data["keywords"]=I("post.keywords","");
        $data["spec"]=I("post.spec","");
        $data["description"]=I("post.description","");

        if(empty($pid) || !is_numeric($pid)){
            if(M("Product")->add($data))
                $this->success("添加成功1",U("/Admin/Product/plist"));
            else
                $this->error("添加失败2");
        }else{
           $data["pid"]=$pid;

            if(M("Product")->save($data)!==false)
                $this->success("更改成功11",U("/Admin/Product/plist"));
            else
                $this->error("更改失败22");
        }
    }

    function plist(){
        $products=M("Product")->select();
        if($products)
            $this->assign("products",$products);

        $this->display();
    }
}