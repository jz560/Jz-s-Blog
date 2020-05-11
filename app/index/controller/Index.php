<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\model\User;
use app\index\model\Article;
class Index extends Controller
{
    public function index()
    {
        //$this->assign('name', 'jz');
        
        return view();
        
    }

    public function articleList()
    {
        $res = Article::column("id, title");
        //$res = $res->toArray();
        $this->assign('list', $res);
      	dump($res);
        return view('articleList');
    }

    public function getArticle()
    {
        //从前端获取文章id
        $id=input('param.id');
        //数据库根据id查询
        $article = Article::get($id);
        //获取文章标题和内容
        $title = $article->title;
        $content = $article->content;
        //传给模板
        $this->assign('title', $title);
        $this->assign('content', $content);
        return view('article');
    }
}
