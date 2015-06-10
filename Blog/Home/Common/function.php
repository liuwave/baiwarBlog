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
        ->order('sort ASC')
        ->select();
    $cur_url =$_SERVER['REQUEST_URI'];
    $noindex = false;
    $navlist = array();

    foreach ($res as $key => $row) {
        $navlist[] = array(
            'name' => $row['name'],
            'is_open_new' => $row['is_open_new'],
            'url' => U($row['url']),
            'is_cates'=>$row['is_cates'],
        );
    }
    /* 遍历自定义是否存在currentPage */
    $rule='/\.'.C(URL_HTML_SUFFIX).'/';

    //(strpos($cur_url, $v['url']) === 0 && strlen($cur_url) == strlen($v['url']));



    foreach ($navlist as $k => $v) {
        //$condition = empty($ctype) ? (strpos($cur_url, $v['url']) === 0) : (strpos($cur_url, $v['url']) === 0 && strlen($cur_url) == strlen($v['url']));
        $condition =empty($v['is_cates'])?
            (stripos($cur_url, preg_replace($rule,'',$v['url'])) === 0 && strlen($cur_url) == strlen($v['url']))
            :false;
        if ($condition && !$noindex) {
            $navlist[$k]['active'] = 1;
            $noindex = true;
            //continue;
        }
    }

    if($noindex==false){
        foreach($navlist as $k => $v){
            if(!empty($v['is_cates']) && stripos($v["url"],CONTROLLER_NAME)!==false && !$noindex){
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