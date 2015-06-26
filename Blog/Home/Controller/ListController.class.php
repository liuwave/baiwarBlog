<?php
namespace Home\Controller;
use Think\Controller;
class ListController extends CommonController {
	
    public function index(){

        $cid = I('get.id');
        $Cates=D('category');
        if(empty($cid)){
            $urlname = $_GET['name'];
            $cid = $Cates->where(array("urlname"=>$urlname))->getField('cid');
        }


        $where["is_show"]=1;
        if(!empty($cid)){
            $where["cid"]=$cid;
        }

		$Article=M('article');
	    $count = $Article->where($where)->count();
		$Page =new \Think\Page($count,C('LISTPAGESIZE'));
		$list=$Article->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
   	    $show = $Page->show();
	    $this->assign('page',$show);
        $currentCate=$Cates->getTree($cid);


        $pName=empty($currentCate["parent_id"])?
            $currentCate["name"]:
            $currentCate->where(array("cid"=>$currentCate["parent_id"]))->getField('name');

        $this->assign("currentCate",$currentCate);
        $this->assign("pName",$pName);
        $this->assign("list",$list);
		$this->display();
    }
}
