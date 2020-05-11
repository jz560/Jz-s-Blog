<?php
namespace app\admin\controller;

use think\Controller;
use app\index\model\Article;

class Index extends Controller
{
    public function index()
    {
        //从数据库获取文章数据并分页
        $res = Article::paginate(10);
        //传给模板显示文章列表
        $this->assign('list', $res);
        return view();
    }

    public function edit(){
        //从前端获取文章id
        $id = input('param.id');
        //数据库根据id查询
        $article = Article::get($id);
        //获取文章标题和内容
        $title = $article->title;
        $content = $article->content;
        $create_at = $article->create_at;
        dump($article);
    }

    public function delete(){
        //从前端获取文章id
        $id = input('param.id');
    }
}
