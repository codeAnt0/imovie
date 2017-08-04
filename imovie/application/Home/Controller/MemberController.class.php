<?php
namespace Home\Controller;
use Think\Controller;

class MemberController extends Controller{
	//登录
	function login(){
        if(IS_POST){
            $code = I('post.code');
            $verify = new \Think\Verify();
            if(!$verify->check($code)){
                $this->error('验证码填写错误,请重新输入',U('login'),3);
            }
            $email = I('post.mem_mail');
            $pass = I('post.mem_passwd');
            //dump($email);die;
            $mem_info = D('Member')->where("mem_mail = '$email'") ->find();
            if(empty($mem_info)){
                $this->error('您的用户名错误');
            }else{
                if($pass == $mem_info['mem_passwd']){
                    session('memid',$mem_info['mem_id']);
                    session('memname',$mem_info['mem_name']);

                    $tc = I('get.tc','Index');
                    $ta = I('get.ta','index');
                    $this->success('登录成功!',U("Index/index"),3);
                }else{
                    $this->error('您的密码错误');
                }
            }
        }else{
          $this->display();  
        }
		
	}
	//验证码
	function verify(){
    	$config = array(
    		'useImgBg'  =>true,
    		'useCurve' => false,
    		'useNoise' => false,
    		'fontSize' => 15,
    		'fontttf' => '4.ttf',
            'imageH' => 45,
            'imageW' => 120,
    	);
    	$verify = new \Think\Verify($config);
    	$verify->entry();
    }	
    
    function register(){
        if(IS_POST){
            $mem_model = D('Member');
            $form_data = $mem_model->create();
            if($form_data){
                //dump($form_data);die;
                $result = $mem_model -> add($form_data);
            if($result){
                $this->success('注册成功',U('login'),3);
            }else{
                $this->error('注册失败',U('login'),3);
            }
            }else{
                echo $mem_model->getError();
                die;
            }
            
            
            
        }else{
            $this->display();
        } 
    }
}