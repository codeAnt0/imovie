<?php 
namespace Home\Model;
use Think\Model;
class MemberModel extends Model{
	protected $field=array(
		'mem_name','mem_mail','mem_passwd','mem_time','mem_salt'
		);
	protected $_validate=array(
		array('mem_name','require','管理员名字不能为空',1,'regex',3),
		array('mem_passwd','password','密码必须是6-12位字母数字下划线组合',1,'regex',3),
		array('re_passwd','mem_passwd','两次密码不一致',0,'confirm',3)
	);
	protected $_auto=array(
		array('mem_time','time',3,'function'),
		array('mem_salt','makeSalt',3,'function'),
	);
}



 ?>