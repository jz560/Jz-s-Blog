<?php
namespace app\admin\controller;

use think\Controller;
use app\index\model\Article;
use think\Session;

class Index extends Controller
{
    public function index()
    {
        if(!Session::has('id')){
            return $this->error('Login please...', 'user/showLogin');
        }
        //从数据库获取文章数据并分页
        $res = Article::paginate(10);
        //传给模板显示文章列表
        $this->assign('list', $res);
        return view();
    }

    public function create(){

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
        return view('edit');
    }

    public function delete(){
        //从前端获取文章id
        $id = input('param.id');
    }
}
