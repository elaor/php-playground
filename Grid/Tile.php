<?php
namespace GridWorld\Grid;

/**
 * Class to represent a tile on a grid. A tile is either clear or occupied.
 *
 */

Class Tile {
	
	private $isClear;

	public function __construct($isClear = true) {
		$this->isClear = $isClear;
	}
	
	/**
	 * @return void
	 */
	public function setObstacle() {
		$this->isClear = false;
	}
	
	/**
	 * @return boolean
	 */
	public function isClear() {
		return $this->isClear;
	}
	
	/**
	 * @return string
	 */
	public function __toString() {
		if ($this->isClear) {
			return "0";
		}
		return "1";
	}
	
}