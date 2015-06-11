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
            empty($v['type']) &&
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
            if(!empty($v['type'])  && stripos($cur_url,CONTROLLER_NAME)!==false && !$noindex){
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
