<?php
include_once 'AuctionStatus.php';
include_once 'AuctionType.php';
include_once 'Bid.php';

class Auction {
	
	/**
	 * @var string
	 */
	private $name;
	
	/**
	 * @var AuctionType
	 */
	private $type;
	
	/**
	 * @var AuctionStatus
	 */
	private $status;
	
	/**
	 * @var int
	 */
	private $startPrice;
	
	/**
	 * @var int
	 */
	private $buyNowPrice;
	
	/**
	 * @var Bid[]
	 */
	private $bids;
	
	/**
	 * @param string $name
	 * @param AuctionType $type
	 * @param AuctionStatus $status
	 * @param int $startPrice
	 * @param int $buyNowPrice
	 */
	public function __construct($name, $type, $status, $startPrice, $buyNowPrice) {
		$this->name = $name;
		$this->type = $type;
		$this->status = $status;
		
		if (AuctionType::BID == $type) {
			$this->startPrice = $startPrice;
			$this->bids = array();
		}
		
		if (AuctionType::BUY_NOW == $type) {
			$this->buyNowPrice = $buyNowPrice;
		}
	}
	
	/**
	 * @param int $price
	 */
	public function addBid($price) {
		$this->bids[] = new Bid($price);
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @return AuctionType
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * @return AuctionStatus
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * @return int
	 */
	public function getStartPrice() {
		return $this->startPrice;
	}
	
	/**
	 * @return int
	 */
	public function getBuyNowPrice() {
		return $this->buyNowPrice;
	}
	
	/**
	 * @return Bid[]
	 */
	public function getBids() {
		return $this->bids;
	}
}