<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * CreateTime: 2015/6/10|13:36
 */
/**
 * 取得导航栏列表
 * @param   string      $position    位置，如top、bottom、middle、side
 * @return  array         列表
 */
function get_menu($position = "top") {

    $res=M("Menu")
        ->where(array("is_show"=>1,"position"=>$position))
        ->order('sort_order ASC')
        ->select();
    $cur_url =$_SERVER['REQUEST_URI'];
    $noindex = false;
    $navlist = array();

    foreach ($res as $key => $row) {
        $url=__ROOT__."/".ltrim($row['url'],"/");
        $navlist[] = array(
            'name' => $row['name'],
            'is_open_new' => $row['is_open_new'],
            'url' => $url,
            'category_urlname' => $row['category_urlname'],
            'type'=>$row['type'],
        );
    }
    /* 遍历自定义是否存在currentPage */
    //$rule='/\.'.C(URL_HTML_SUFFIX).'/';

    //$rule='/\?[\s\S]*/';

    //(strpos($cur_url, $v['url']) === 0 && strlen($cur_url) == strlen($v['url']));
    //判断单页面
    foreach ($navlist as $k => $v) {
        //$condition = empty($ctype) ? (strpos($cur_url, $v['url']) === 0) : (strpos($cur_url, $v['url']) === 0 && strlen($cur_url) == strlen($v['url']));

        $condition =
//            empty($v['type']) &&
            stripos($cur_url, $v['url']) === 0 &&
            strlen($cur_url) == strlen($v['url']) &&
            !$noindex;

        if ($condition) {
            $navlist[$k]['active'] = 1;
            $noindex = true;

            //continue;
        }
    }



// 判断子目录
    if($noindex==false){
        foreach($navlist as $k => $v){
            if(!empty($v['type']) && !empty($v["category_urlname"]) && stripos($cur_url,$v["category_urlname"])!==false && !$noindex){
                $navlist[$k]['active'] = 1;
                $noindex = true;
            }
        }
    }

//判断CONTROLLER_NAME
    if($noindex==false){
        foreach($navlist as $k => $v){
            //todo 判断$v["cname"] 是否为空
            if(!empty($v['type'])  && stripos($v['url'],CONTROLLER_NAME)!==false && !$noindex){
                $navlist[$k]['active'] = 1;
                $noindex = true;
            }
        }
    }




    if ($noindex == false) {
        $navlist[0]['active'] = 1;
    }
    return $navlist;
}
/**
 * 字符串截取，支持中文和其他编码
 * static
 * access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(function_exists("mb_substr")){
        $slice= mb_substr($str, $start, $length, $charset);
    }elseif(function_exists('iconv_substr')) {
        $slice= iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $fix='';
    if(strlen($slice) < strlen($str)){
        $fix='...';
    }
    return $suffix ? $slice.$fix : $slice;
}


function list_to_tree($list, $pk = 'cid', $pid_key = 'parent_id', $child = '_', $pid = 0){
    $arr=array();
    foreach($list as $l){
        if($l[$pid_key]==$pid){
            $l[$child]=list_to_tree($list,$pk,$pid_key,$child,$l[$pk]);
            $arr[$l[$pk]]=$l;
        }
    }
    return $arr;



}


function get_article_by_cate($cate=0,$limit=5){
    $cates=array();
    $Cate=M("Category");
    if($cate===0){
        $cateMap["parent_id"]=0;
    }else if(is_numeric($cate)){
        $cates[]=$cateMap["parent_id"]=$cate;
    }else{
        $c=$Cate->where(array("urlname"=>$cate))->getField("cid");
        if($c){
            $cates[]=$cateMap["parent_id"]=$c;
        }else{
            return false;
        }
    }

    $childCates=$Cate->where($cateMap)->getField("cid",true);
    if($childCates)
        $cates=array_merge($childCates,$cates);

    $map['cid']  = array('in',$cates);
    $field="aid,cid,title"; 
    return M("Article")->where($map)->field($field)->limit($limit)->order("is_top desc,add_time desc")->select();
}


/**
 * 判断是否是通过手机访问
 * @return bool 是否是移动设备
 */
 function is_mobile_agent() {
//判断手机发送的客户端标志
    if(isset($_SERVER['HTTP_USER_AGENT'])) {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $clientkeywords = array(
            'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-'
        ,'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu',
            'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini',
            'operamobi', 'opera mobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'
        );
// 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if(preg_match("/(".implode('|',$clientkeywords).")/i",$userAgent)&&strpos($userAgent,'ipad') === false)
        {
            return true;
        }
    }
    return false;
}