<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Category;
class ArticleController extends CommonController
{
    public function index()
    {
        $News = D('Article');
        $count = $News->count();
        $Page = new \Think\Page($count, 20);

        $show = $Page->show();
        $list = $News->relation(true)->order('aid DESC')->limit(($Page->firstRow . ',') . $Page->listRows)->select();
        //var_dump($News->relation(true)->order('aid DESC'));
        //var_dump($list);
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display('article_list');
    }
    public function Article_add()
    {

        $cate=M('category')->select();
        $cate = Category::zifenlei($cate,'&nbsp;&nbsp;|--');
        //var_dump($cate);
        $this->assign('cate',$cate);
        $this->display('write');
    }
    public function addcontent()
    {

        $article = M('article');

        $data['title'] = I('post.title');

        $data['content'] = I('post.content');
        $data['cid'] = I('post.cid');
        $data['add_time'] = time();
        $data['tag'] = I('post.tag');
        $data['hot'] = I('post.hot',0);
        $data['is_top'] = I('post.is_top',0);
        $data['summary'] = I('post.summary');
        $data['img']=I('post.img');

        if(empty($data['title']) || empty($data['content'])){
            $this->error("标题或内容不能为空");
        }
        if(empty($data['summary'])){
            $data['summary']=msubstr(strip_tags($data['content']),0,500);
        }

        if ($article->add($data)) {
            $this->success(L('Write_success'));
        } else {
            $this->error(L('Write_error'));
        }
    }



    function newsDate() {
        return date('Y-m-d H:i:s');
    }



    public function mod()
    {

        $id = I('get.id');

        if (!empty($id)) {
            $art = M('Article');
            $data = $art->where(array('aid' => $id))->find();
            $this->assign('article', $data);
            $cat = M('category')->select();
            $cat = Category::zifenlei($cat,'&nbsp;&nbsp;|--');
            $this->assign('clist', $cat);
            //var_dump($data);
        }

        $this->display('article_mod');
    }
    public function del()
    {
        if (IS_POST) {
            $ids = $_POST;
            $db = M('Article');
            if ($ids) {
                foreach ($ids as $id) {
                    $db->where(array('aid' => $id))->delete();
                }
            }
            $this->success('<p>'.L('batchdell_success').'</p>');
        } else {
            $id = I('get.id');
            $db = M('Article');
            $status = $db->where(array('aid' => $id))->delete();
            if ($status) {
                $this->success(L('dell_success'));
            } else {
                $this->error(L('dell_error'));
            }
        }
    }
    public function hot()
    {
        $id = $_GET['id'];
        $hot = $_GET['hot'];
        $result = $this->setHot($id, $hot);
        if ($result) {
            $this->success(L('set_success'));
        } else {
            $this->error(L('set_error'));
        }
    }
    public function update()
    {

        $Form = M('Article');


        if ($Form->create()) {

            $result = $Form->save();
            if ($result) {
                $this->success(L('success'));
            } else {
                $this->error(L('error'));
            }
        } else {
            $this->error($Form->getError(L('error')));
        }
    }
}
