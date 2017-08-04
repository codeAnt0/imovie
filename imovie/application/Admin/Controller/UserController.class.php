<?php  
//1.声明命名空间
namespace Admin\Controller;
//2.引入控制器基础类
use Think\Controller;
//3.编写控制器类，继承控制器基础类
class UserController extends Controller{
	function add(){
		echo "后台add方法";
	}
}