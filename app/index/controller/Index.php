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

    public function article()
    {
        $article = Article::get(1);
        $title = $article->title;
        $content = $article->content;
        $this->assign('title', $title);
        $this->assign('content', $content);
        return view('article');
    }
}
