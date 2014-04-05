<?php
class AuctionsReporter {
	
	/**
	 * @param Auction[] $auctions
	 * @return string
	 */
	public function createAllAuctionsReport(array $p_array, StringBuilder $report) {
		return "Sample Total Auctions Report";
	}
	
	/**
	 * @param Auction[] $auctions
	 * @return string
	 */
	public function createBidAuctionsReport(array $auctions) {
		return "Sample Bid Auctions Report";
	}
	
	/**
	 * @param Auction[] $auctions
	 * @return string
	 */
	public function createBuyNowAuctionsReport(array $auctions) {
		return "Sample Buy Now Auctions Report";
	}
}