<?php 
namespace Admin\Model;
use Think\Model;
class ManagerModel extends Model{
	protected $fields = array(
		'manager_id','manager_name','manager_passwd',
		'manager_status','manger_ctime',
		'manager_login'
	);
	protected $_auto = array(
		//自动补全盐
		array('manager_salt','makeSalt',1,'function'),
		//自动补全创建时间
		array('manager_ctime','time',1,'function'),
		//自动补全最后登录时间
		array('manager_login','time',1,'function'),
	);

	function checkLogin($username,$password){
		$info = $this->where("manager_name='$username'")->find();
		if(empty($info)){
			return false;
		}
		$password = salt($password,$info['manager_salt']);
		if($info['manager_passwd']==$password){
			$arr = array(
				'manager_id' => $info['manager_id'],
				'manager_login'=> time()
			);
			$this->save($arr);
			session('id',$info['manager_id']);
			session('name',$info['manager_name']);
			session('roleid',$info['manager_roleid']);
			return true;
		}else{
			return false;
		}
	}
}



 ?>