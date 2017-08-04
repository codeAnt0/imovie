<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    //主页面视图
    public function index(){
       $this->display();
    }
    //详情页
    public function single(){
    	$this->display();
    }
    //游戏主页面
     public function game(){
    	$this->display();
    }
    //列表页
     public function movie(){
    	$this->display();
    }
  


    
}