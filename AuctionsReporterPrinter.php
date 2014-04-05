<?php
include_once 'AuctionsReporter.php';
include_once 'RequestContext.php';
include_once 'Auction.php';
include_once 'StringBuilder.php';

class AuctionsReporterPrinter extends AuctionsReporter {
	
	public $totalBid = 0;
	public $totalBidPrice = 0;
	public $totalBuyNow = 0;
	public $totalBuyNowPrice = 0;
	public $totalNewAuctions = 0;
	public $totalActiveAuctions = 0;
	public $totalFinishedAuctions = 0;
	
	public function createAllAuctionsReport(array $p_array, StringBuilder $report) {
		
		$c = $this->getRequestContext();
		
		$report->append("ANNUAL SUMMARY OF ALL AUCTIONS.\n");
		$report->append("*******************************\n\n");
		
		$now = $c->getNow();
		$month = (int) $now->format('n');
		
		echo "\r\nMonth -> " . $month . "\r\n";
		
		if ($month > 0 && $month <= 2) {
			$report->append("Report period: 01/01/2012 and 31/03/2012\n");
		} else if ($month > 2 && $month <= 5) {
			$report->append("Report period: 01/04/2012 and 30/06/2012\n");
		} else if ($month > 5 && $month <= 8) {
			$report->append("Report period: 01/07/2012 and 30/09/2012\n");
		} else if ($month > 8 && $month <= 11) {
			$report->append("Report period: 01/10/2012 and 31/12/2012\n");
		} else {
			throw new Exception("Critical issue");
		}
		
		$report->append("Total number of auctions: " . count($p_array));
		$report->append("\n");
		
		foreach ($p_array as $value) {
			$this->data($value);
		}
		
		$report->append("Including ");
		$report->append($this->totalBid);
		$report->append(" bid auctions and ");
		$report->append($this->totalBuyNow);
		$report->append(" buy now auctions\n");
		
		$report->append($this->totalNewAuctions);
		$report->append(" auctions are ");
		$report->append($this->getDescription(AuctionStatus::NEW_));
		$report->append("\n");
		
		$report->append($this->totalActiveAuctions);
		$report->append(" auctions are ");
		$report->append($this->getDescription(AuctionStatus::ACTIVE));
		$report->append("\n");
		
		$report->append($this->totalFinishedAuctions);
		$report->append(" auctions are ");
		$report->append($this->getDescription(AuctionStatus::FINISHED));
		$report->append("\n");

		$report->append("Total buy now price: ");
		$report->append(number_format($this->totalBuyNowPrice / 100, 2));
		$report->append(" zl\n");
		
		$report->append("Total bid price: ");
		$report->append(number_format($this->totalBidPrice / 100, 2));
		$report->append(" zl\n");
		
		return $report;
	}
	
	private function getDescription($status) {
		if (AuctionStatus::NEW_ == $status)
			return "new";
		else if (AuctionStatus::ACTIVE == $status)
			return "active";
		else
			return "finished";
	}
	
	private function data(Auction $auction) {
		switch ($auction->getType()) {
			case AuctionType::BID:
				$this->totalBid++;
				if (count($auction->getBids()) == 0) {
					$this->totalBidPrice += $auction->getStartPrice();
				} else {
					$this->totalBidPrice += array_pop($auction->getBids())->getPrice();
				}
				break;
			case AuctionType::BUY_NOW:
				$this->totalBuyNow++;
				$this->totalBuyNowPrice += $auction->getBuyNowPrice();
				break;
			default:
				throw new Exception("Not recognized auction type");
		}
		
		switch ($auction->getStatus()) {
			case AuctionStatus::NEW_:
				$this->totalNewAuctions++;
				break;
			case AuctionStatus::ACTIVE:
				$this->totalActiveAuctions++;
				break;
			case AuctionStatus::FINISHED:
				$this->totalFinishedAuctions++;
				break;
			default:
				throw new Exception("Not recognized auction status");
		}
	}

	/**
	 * @return RequestContext
	 */
	private function getRequestContext() {
		return new RequestContext(null);
	}
	
	/**
	 * Use this methods to clear state after execution
	 */
	public function clear() {
		$this->totalBid = 0;
		$this->totalBidPrice = 0;
		$this->totalBuyNow = 0;
		$this->totalBuyNowPrice = 0;
		$this->totalNewAuctions = 0;
		$this->totalActiveAuctions = 0;
		$this->totalFinishedAuctions = 0;
	}
	
	public function createBidAuctionsReport(array $p_array) {
		throw new Exception("Report type not supported");
	}
	
	public function createBuyNowAuctionsReport(array $p_array) {
		return parent::createBuyNowAuctionsReport($p_array);
	}
}