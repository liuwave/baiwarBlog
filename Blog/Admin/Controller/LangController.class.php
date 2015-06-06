<?php
namespace Admin\Controller {
use Think\Controller;
    class LangController extends CommonController
    {
        public function index()
        {

            $this->display('index');
        }
        public function Update()
        {

            $data["DEFAULT_LANG"]=I("post.DEFAULT_LANG");
            if(update_website_config($data)){
                $this->success('<p>'.L('lang_success').'</p>', (__ROOT__ . '/Admin/Lang?l=') . C('DEFAULT_LANG'));
            } else {
                $this->error('<p>'.L('lang_error').'</p>');
            }
        }
    }
}