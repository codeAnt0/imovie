<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if(IS_POST){
    		$code = I('post.code');
    		// dump($code);die;
    		$verify = new \Think\Verify();

    		if(!$verify->check($code)){
    			$this->error('您输入的验证码有误',U('index'),3);
    		}
    		$username = I('post.name');
    		$password = I('post.password');
    		$manager_model = D('Manager');
    		if($manager_model->checkLogin($username,$password)){
    			$this->success('登录成功!',U('Main/index'),3);
    		}else{
    			$this->error('用户名或密码错误',U('index'),3);
    		}
    	}else{
        	$this->display();
    	}
    }
    
    function verify(){
    	$config = array(
    		'useCurve' => false,
    		'useNoist' => false,
    		'fontSize' => 15,
    		'fontttf' => '4.ttf',
    	);
    	$verify = new \Think\Verify($config);
    	$verify -> entry();
    } 

    public function sendTest(){
    	dump(sendMail('php59','我是你','123490389@qq.com'));
    }
}