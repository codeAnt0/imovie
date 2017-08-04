<?php 
namespace Think;

class Cart{
	private $cart;
	function __construct(){
		if(session('?memid')){
			$class = "MysqlCart";
		}else{
			$class = "CookieCart";
		}
		$class = 'Think\\Cart\\Driver\\'.$class;
		$this->cart = new $class();
	}

	function addCart($goods_info){
		return $this->cart->addCart($goods_info);
	}
	
	function getPriceNumber(){
		return $this->cart->getPriceNumber();
	}

	function getCartList(){
		return $this->cart->getCartList();
	}

	function delCart($cart_id){
		return $this->cart->delCart($cart_id);
	}

	function modifyCart($cart_info){
		return $this->cart->modifyCart($cart_info);
	}
	
	function getPrice($cart_id){
		return $this->cart->getPrice($cart_id);
	}

	function delAll(){
		return $this->cart->delAll();
	}
}

 ?>