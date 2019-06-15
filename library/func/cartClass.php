<?php

class Item {
	var $name;
	var $rate;
	var $num;

	function __construct($name,$rate,$num)
	{
		$this->name = $name;
		$this->rate = $rate;
		$this->num = $num;
	}
}

class Cart
{
	var $items = array();
	
	function __construct() { }

	function Add($id,$name,$rate,$num){
		if(isset($this->items[$id])){
			$this->items[$id]->num += $num;
		}
		else {
			$this->items[$id] = new Item($name,$rate,$num);
		}
		
	}

	function Edit($id,$num){
		if(isset($this->items[$id])){
			$this->items[$id]->num = $num;
		}
	}

	function Clear(){
		$this->items = array();
	}

	function getTotal(){
		$count = 0;
		foreach ($this->items as $key => $value) {
			$count += $value->num;
		}
		return $count;
	}
}



?>