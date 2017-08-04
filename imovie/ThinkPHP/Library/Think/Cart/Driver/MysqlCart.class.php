<?php 
namespace Think\Cart\Driver;

class MysqlCart{
	private $cart;
	private $memid;
	function __construct(){
		$this->cart = D('Cart');
		$this->memid=session('memid');
	}
	
	function addCart($goods_info){
		//dump($goods_info);die;
		$goods_info['cart_memid'] = $this->memid;
		return $this->cart->add($goods_info);
	}

	function getPriceNumber(){
		//获取总数量
		$sum = $this->cart->where("cart_memid=$this->memid")->sum('cart_num');
		//计算总价格,联合goods表和cart表
		$price=0;
		$info=$this->cart->alias('c')
			->field("g.goods_price,c.cart_num")
			->join("left join sp_goods g on g.goods_id=c.cart_goodsid")
			->where("c.cart_memid=".$this->memid)
			->select();
		//循环计算总价格
		foreach($info as $value){
			$price += $value['cart_num']*$value['goods_price'];
		}
		//返回总数量和总价格
		return array('number'=>$sum,'price'=>$price);
	}

	function getCartList(){
		$cart_list = $this->cart->alias('c')
				->field('c.cart_id,g.goods_id,g.goods_name,g.goods_price,c.cart_num,c.cart_attr,g.goods_small_logo,
						g.goods_price*c.cart_num total_price')
				->join('left join sp_goods g on c.cart_goodsid = g.goods_id')
				->where('cart_memid='.$this->memid)
				->select();
		return $cart_list;	
	}

	function delCart($cart_id){
		return $this->cart->delete($cart_id);
	}

	function modifyCart($cart_info){
		return $this->cart->save($cart_info);
	}

	function getPrice($cart_id){
		$result = $this->cart->alias('c')
				->field('c.cart_num*g.goods_price total_price')
				->join('left join sp_goods g on g.goods_id = c.cart_goodsid')
				->where('c.cart_id ='.$cart_id)
				->find();

		return $result['total_price'];
	}

	function delAll(){
		return $this->cart->where("cart_memid=$this->memid")->delete();
	}
}

 ?>