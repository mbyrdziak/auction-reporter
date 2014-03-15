<?php

include_once 'User.php';

class RequestContext {
	
	/**
	 * @var User
	 */
	private $loggedInUser;
	
	/**
	 * @var DateTime
	 */
	private $now;
	
	/**
	 * @param User $loggedInUser
	 */
	public function __construct(User $loggedInUser = null) {
		$this->loggedInUser = $loggedInUser;
		$this->now = new DateTime('NOW');
	}
	
	/**
	 * @return User
	 */
	public function getLoggedInUser() {
		return $this->loggedInUser;
	}
	
	/**
	 * @return DateTime
	 */
	public function getNow() {
		return $this->now;
	}
}