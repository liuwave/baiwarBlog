<?php

function p($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}
function filecontents()
{
	$content = file_get_contents(__flel__);
}



/*msubstr*/
function subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length) 
     return mb_substr($text, 0, $length, 'utf8').'...';
     return $text;
}

/**
 * 获取网站参数，key=>value
 * @param int $id 配置id
 * @param int $parent_id 配置父id
 * @param bool $force 是否强制更新
 * @return array|empty
 */
function get_website_config($id=0,$parent_id=0,$force=true){

    $tag=C("WEBSITE_CONFIG_TAG")."/".$id."_".$parent_id;
    if( F($tag) && !$force ){
        return F($tag);
    };



    $WebsiteConfig=M("WebsiteConfig");
    $map=array();
    $re=array();
    //id存在 ，返回单条
    if($id>0){
        $map["id"]=$id;
        $wc=$WebsiteConfig->where($map)->find();
        if($wc){
            if($wc["parent_id"]>0){


                $re[$wc["code"]]=$wc["value"];
                //return $re;
            }else{
                $parent_id=$id;
            }
        }
    }
    //$parent_id存在，返回某一类
    if($parent_id>0 && empty($re)){
        unset($map["id"]);
        $map["parent_id"]=$parent_id;
        $wcs=$WebsiteConfig->where($map)->select();

        if($wcs){
            $re=array();
            foreach($wcs as $w ){
                $re[$w["code"]]=$w["value"];
            }

            //return $re;
        }

    }
// $id $parent_id 均不存在
    if(empty($re)){
        $map['parent_id']  = array('GT',0);
        $wca=$WebsiteConfig->where($map)->select();
        if($wca){
            $re=array();
            foreach($wca as $w ){
                $re[$w["code"]]=$w["value"];
            }

        }
    }


    if(!empty($re)){
        F($tag,$re);
        return $re;
    }
    return false;



}
/**
 * 获取网站参数，多维数组形式 id，parent_id，code，type，store_range，value
 * @param int $id 配置id
 * @param int $parent_id 配置父id
 * @param bool $force 是否强制更新
 * @return array|empty
 */
function get_websit_config_by_code($code="",$force=true){
    if(empty($code)){
        return false;
    }
    $tag=C("WEBSITE_CONFIG_TAG")."/".$code;
    if( F($tag) && !$force ){
        return F($tag);
    };

    $WebsiteConfig=M("WebsiteConfig");

    $parent_id=$WebsiteConfig->where(array("code"=>$code))->getField("id");
    //$parent_id=empty($parent_id)?0:$parent_id;

    //var_dump($parent_id);
    //var_dump($code);
    $wConfig=array();
    if($parent_id){
        $wcs=$WebsiteConfig
            ->where(array("parent_id"=>$parent_id))
            ->order("sort_order")
            ->select();

        //var_dump($wcs);
        if($wcs){
            foreach($wcs as $wc){
                $temp=array();
                $temp["id"]=$wc["id"];
                $temp["parent_id"]=$wc["parent_id"];
                $temp["code"]=$wc["code"];
                $temp["type"]=$wc["type"];
                if($temp["type"]=="select"){
                    $temp["store_range"]=explode(",",$wc["store_range"]);
                }
                $temp["value"]=$wc["value"];

                $wConfig[]=$temp;

            }
        }

    }

    if(!empty($wConfig)){
        F($tag,$wConfig);
        return $wConfig;
    }else{
        return false;
    }


}

/**
 * 获取和设置配置参数 支持批量定义
 * @param string|array $name 配置变量
 * @param mixed $value 配置值
 * @param mixed $default 默认值
 * @return mixed
 */
function update_website_config($name=null, $value=null) {


    // 优先执行设置获取或赋值
    $WebsiteConfig=M("WebsiteConfig");

    if (is_string($name)) {
        $map["code"]=$name;
        $id = $WebsiteConfig->where($map)->getField('id');
        if($id){
            if(!empty($value)){
                $data["id"]=$id;
                $data["value"]=$value;
                if($WebsiteConfig->save($data)!==false){
                    return true;
                }
            }
        }
        return false;
    }

    // 批量设置
    if (is_array($name)){
        $re=true;
        foreach($name as $k=>$val){
            $re=update_website_config($k,$val)?$re:false;
        }
        //$_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
        return $re;
    }
    return false;

}

?>
