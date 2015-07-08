<?php
namespace Home\Controller;
use Think\Controller;

class ContentController extends CommonController {
    public function index(){

		$id = I('get.id');
		$field=	array('aid','cid','title','tag','summary','content','add_time');
		$article=M('article')->field($field)->find($id);
        $Cates=D('category');
        $currentCate=$Cates->getTree($article["cid"]);
        $pName=empty($currentCate["parent_id"])?
            $currentCate["name"]:
            $currentCate->where(array("cid"=>$currentCate["parent_id"]))->getField('name');


        $this->seo["title"].="_".$article["title"];
        $keywordArr=explode(",",$this->seo["keywords"]);
        if(!empty($article["tag"])){
            $keywordArr1=explode(" ",$article["tag"]);
            $keywordArr=array_merge($keywordArr,$keywordArr1);
        }
        $keywordArr[]=$pName;
        $keywordArr[]=$currentCate["name"];

        $this->seo["keywords"]=implode(",",array_unique($keywordArr));
        $this->seo["description"].=$article["summary"];
        $this->assign($this->seo);

        $this->assign("currentCate",$currentCate);
        $this->assign("pName",$pName);
        $this->assign("article",$article);





		$this->display();
    }
	public function add(){
		
		
		 //判断验证码
            if (I('verify', '', 'strtolower') == session('verify')) {
                $this->error('验证码错误！');
            }
     
            $article = M('comment');
			$article->find($_GET["coid"]); 
            $data['aid'] = $_POST['aid'];
			$data['couname'] = $_POST['couname'];
            $data['content'] = $_POST['content'];
            if ($_POST['time'] == '') {
                $data['time'] = time();
            } else {
                $data['time'] = strtotime($_POST['time']);
            }
            $data['email'] = $_POST['email'];
           
            if ($article->add($data)) {
                $this->success('<p>提交成功</p>');
            } else {
                $this->error('<p>'.L('Write_error').'</p>');
            }

		
    }
	 //导入验证码，4为文字
        public function verify()
        {
            $config = array('fontSize' => 18, 'length' => 4, 'imageW' => 130, 'bg' => array(57, 179, 215), 'imageH' => 42, 'useCurve' => false, 'useNoise' => false);
            $verify = new \Think\Verify($config);
            $verify->entry();
        }
	
	
	
}