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
		return $this->isClear;
	}
	
	public function __toString() {
		if ($this->isClear) {
			return 0;
		}
		return 1;
	}
	
	public function toHTML() {
		$classTile = "tile_clear";
		if (!($this->isClear)) {
			$classTile = "tile_occupied";
		}
		return "<div class=\"$classTile\"></div>";
	}
}