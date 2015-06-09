<?php
namespace Admin\Controller;
use Think\Controller;
class TemplateController extends CommonController {
    public function index() {
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

