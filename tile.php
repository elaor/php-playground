<?php

Class Tile {
	
	private $isClear;

	public function __construct($isClear = true) {
		$this->isClear = $isClear;
	}
	
	public function setObstacle() {
		$this->isClear = false;
	}
	
	public function isClear() {
		return $isClear;
	}
	
	public function __toString() {
		if ($this->isClear) {
			return "0";
		}
		return "1";
	}
}