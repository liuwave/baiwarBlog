<?php
namespace Home\Controller;
use Think\Controller;

class ProductController extends CommonController {
    public function index(){

        $where['is_delete']=0;
        $Product=M('Product');
        $count = $Product->where($where)->count();
        $Page =new \Think\Page($count,5);
        $list=$Product->where($where)->order("add_time desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $show = $Page->show();
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

        $this->display();
    }
}