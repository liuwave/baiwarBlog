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


function list_to_tree($list, $pk = 'cid', $pid = 'parent_id', $child = '_', $root = 0){
    //$list=is_array($list)?$list:(array) $list;
    $re=array();
    //todo 循环

    if(empty($list)){
        return false;
    }
    $re=array();
    foreach($list as $k=>$l){
        if($l[$pid]==$root){
            $re[$l[$pk]]=$l;
            unset($list[$k]);
            if(!empty($list)){
                $re1=list_to_tree($list,$pk,$pid,$child,$l[$pk]);
                if($re1!==false)
                    $re[$l[$pk]][$child]=$re1;
            }
        }
    }
    return $re;
}