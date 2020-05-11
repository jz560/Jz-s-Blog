<?php
namespace app\index\controller;

use think\Controller;
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
        //从数据库获取文章数据并分页
        $res = Article::paginate(10);
        //传给模板显示文章列表
        $this->assign('list', $res);
        return view('articleList');
    }

    public function getArticle()
    {
        //从前端获取文章id
        $id = input('param.id');
        //数据库根据id查询
        $article = Article::get($id);
        //获取文章标题和内容
        $title = $article->title;
        $content = $article->content;
        $create_at = $article->create_at;
        //将数据传给模板
        $this->assign('title', $title);
        $this->assign('content', $content);
        $this->assign('create_at', $create_at);
        return view('article');
    }

    public function getCategory()
    {
        //从前端获取文章分类
        $category = input('param.category');
        //根据分类查询数据库
        $res = Article::where('category', $category)->paginate(10);
        //将数据传给模板
        $this->assign('list', $res);
        return view('category');

    }

    public function temp()
    {
        return view('temp');
    }
}
