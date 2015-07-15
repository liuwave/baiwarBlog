<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * CreateTime: 2015/7/15|9:58
 */

namespace Home\Controller;
class SitemapController extends CommonController{

    function index(){

        header("Content-type:text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";


        echo "<urlset
            xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
            xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
            xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n";



        $siteurl="http://www.mucaosu.com";

        echo "    <url>";
        echo "        <loc>$siteurl</loc>\r\n";
        echo "        <lastmod>".date('Y-m-d')."</lastmod>\r\n";
        echo "        <changefreq>daily</changefreq>\r\n";
        echo "        <priority>1</priority>\r\n";
        echo "    </url>\r\n";



        $category=list_to_tree(M("Category")->select());
        $article=M("Article")->where(array("is_show"=>1))->select();
        $product=M("Product")->where(array("is_delete"=>0))->select();

        foreach($category as $k=>$cate){
            $url=$siteurl.U('/'.$cate["urlname"]);
            $lastMod=empty($cate["add_time"])?date('Y-m-d'):date('Y-m-d',$cate["add_time"]);

            echo "    <url>";
            echo "        <loc>$url</loc>\r\n";
            echo "        <lastmod>".$lastMod."</lastmod>\r\n";
            echo "        <changefreq>daily</changefreq>\r\n";
            echo "        <priority>0.8</priority>\r\n";
            echo "    </url>\r\n";
        }

        echo "    <url>";
        echo "        <loc>$siteurl/product.html</loc>\r\n";
        echo "        <lastmod>".date('Y-m-d')."</lastmod>\r\n";
        echo "        <changefreq>daily</changefreq>\r\n";
        echo "        <priority>0.8</priority>\r\n";
        echo "    </url>\r\n";


        foreach($product as $k=>$pdt){
            $url=$siteurl.U('/product/'.$pdt['aid']);
            $lastMod=empty($pdt["add_time"])?date('Y-m-d'):date('Y-m-d',$pdt["add_time"]);
            echo "    <url>";
            echo "        <loc>$url</loc>\r\n";
            echo "        <lastmod>".$lastMod."</lastmod>\r\n";
            echo "        <changefreq>weekly</changefreq>\r\n";
            echo "        <priority>0.5</priority>\r\n";
            echo "    </url>\r\n";

        }
        foreach($article as $k=>$art){
            $url=$siteurl.U('/'.$category[$art['cid']]['urlname'].'/'.$art['aid']);
            $lastMod=empty($art["add_time"])?date('Y-m-d'):date('Y-m-d',$art["add_time"]);
            echo "    <url>";
            echo "        <loc>$url</loc>\r\n";
            echo "        <lastmod>".$lastMod."</lastmod>\r\n";
            echo "        <changefreq>weekly</changefreq>\r\n";
            echo "        <priority>0.5</priority>\r\n";
            echo "    </url>\r\n";
        }


        echo "</urlset>";

    /*
    $sql=$empire->query("SELECT classid FROM {$dbtbpre}enewsclass WHERE islast=1");
        while($r=$empire->fetch($sql))
        {
            echo "             <sitemap>
                <loc>$siteurl/sitemap.php?classid=$r[classid]</loc>\r\n";
            $csql=$empire->fetch1("SELECT newstime FROM {$dbtbpre}ecms_".$class_r[$r[classid]][tbname]." WHERE classid=$r[classid]  ORDER BY newstime DESC LIMIT 1");
            echo "                     <lastmod>".date('Y-m-d',$csql[newstime])."</lastmod>
        </sitemap>\r\n";
        }
        echo "</sitemapindex>";
    */
    }

}