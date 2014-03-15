<?php
class Bid {
	
	/**
	 * @var int
	 */
	private $price;
	
	/**
	 * @param int $price
	 */
	public function __construct($price) {
		$this->price = $price;
	}
	
	/**
	 * @return int
	 */
	public function getPrice() {
		return $this->price;
	}
}