<?php 
namespace Think\Cart\Driver;

class CookieCart{
	//定义购物车对象实例
	private $cart;

	function __construct(){
		$this->cart = cookie('cart');
		if(empty($this->cart)){
			$this->cart = array();
		}else{
			$this->cart = unserialize($this->cart);
		}
	}

	function addCart($goods_info){
		$length = count($this->cart);
		$goods_info['cart_id'] = $length;
		$result = array_push($this->cart,$goods_info);
		$this->saveData();
		return $result-$length;
	}

	function saveData(){
		cookie('cart',serialize($this->cart));
	}

	function getPriceNumber(){
		$sum = 0;
		$price = 0;
		foreach($this->cart as $value){
			$sum += $value['cart_num'];
			$tmp = D('Goods')->field('goods_price')->find($value['cart_goodsid']);
			$price += $tmp['goods_price']*$value['cart_num'];
		}
		//返回总数量和总价格
		return array('number'=>$sum,'price'=>$price);
	}

	function getCartList(){
		$result = $this->cart;
		foreach($result as $key => $value){
			$tmp_goods = D('goods')->find($value['cart_goodsid']);
			$result[$key]['goods_name'] = $tmp_goods['goods_name'];
			$result[$key]['goods_price'] = $tmp_goods['goods_price'];
			$result[$key]['goods_small_logo'] = $tmp_goods['goods_small_logo'];
			$result[$key]['total_price'] = $tmp_goods['goods_price']*$value['cart_num'];
		}
		return $result;
	}

	function delCart($cart_id){
		$length = count($this->cart);
		unset($this->cart[$cart_id]);
		$tmp = array();
		$i = 0;
		foreach($this->cart as $value){
			$value['cart_id'] = $i;
			$tmp[$i] = $value;
			$i ++;
		}
		$this -> cart =$tmp;
		$length1 = count($this->cart);
		$this->saveData();

		return $length-$length1;
	}

	function flow2(){
		$this->display();
	}
}


 ?>