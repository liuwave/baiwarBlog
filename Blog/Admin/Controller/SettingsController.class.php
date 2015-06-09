<?php
namespace Admin\Controller;
use Think\Controller;
class SettingsController extends CommonController {
    public function index() {
        $this->display('index');
    }
    public function Update() {

        $data=I("post.");

        //var_dump($data);


        if(update_website_config($data)){

            $this->success('<p>修改配置成功！</p>');
        } else {
            $this->error('<p>修改配置失败</p>');
        }

    }
}

