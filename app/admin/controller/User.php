<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\User as UserModel;
use think\Session;
class User extends Controller
{
    function showLogin(){
        return view("login");
    }

    function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $res = UserModel::where('name', $username)->where('pwd', $password)->column('id');
        if(count($res) == 1){
            Session::set('id', 1);
            $this->redirect('index/index', 302);
        }
    }

    function logout(){
        Session::delete('id');
        $this->redirect('user/showLogin', 302);
    }
}