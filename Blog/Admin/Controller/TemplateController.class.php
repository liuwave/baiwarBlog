<?php
namespace Admin\Controller;
use Think\Controller;
class TemplateController extends CommonController {
    public function index() {
        //自动检测模板
        $dirs=glob(TEMPLATE_PATH."*",GLOB_ONLYDIR);
        if($dirs){
            $template=array();
            foreach($dirs as $dir){
                $pos=strrpos($dir,"/");
                if($pos!==false){
                    $dirName=substr($dir,$pos+1);
                    if($dirName){
                        $template[]=$dirName;
                    }
                }
            }
            if(!empty($template)){
                $templateString=implode(",",$template);
                M("websiteConfig")->where(array("code"=>"templateName"))->setField("store_range",$templateString);
                $this->assign("settingArray",get_websit_config_by_code("template"));
            }
        }


        $this->display();
    }
    public function Update() {

        $data=I("post.");

        //var_dump($data);


        if(update_website_config($data)){

            $this->success('<p>' . L('success') . '</p>');
        } else {
            $this->error('<p>修改配置失败</p>');
        }

    }
}
?>         

