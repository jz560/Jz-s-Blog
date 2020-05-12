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

    public function showEdit(){
        //从前端获取文章id
        $id = input('param.id');
        //数据库根据id查询
        $article = Article::get($id);
        //获取文章标题和内容
        $title = $article->title;
        $content = $article->content;
        //传给模板
        $this->assign('id', $id);
        $this->assign('title', $title);
        $this->assign('content', $content);
        return view('edit');
    }

    public function edit(){
        //取得文章数据
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        //更新数据库
        if(!empty($title) && !empty($content)){
            $article = new Article;
            // save方法第二个参数为更新条件
            $res = $article->save([
                'title'  => $title,
                'content' => $content
            ],['id' => $id]);
            
            if($res == 1){
                $this->success('Edit success!', 'index/index');
            }else{
                $this->error('Edit fail.');
            }
        }
    }

    public function delete(){
        //从前端获取文章id
        $id = input('param.id');
        $res = Article::destroy(['id' => $id]);
        if($res == 1){
            $this->redirect('index/index');
        }else{
            $this->error('Delete fail.');
        }
    }
}
