<?php
namespace GridWorld\Grid;

/**
 * Class to represent a tile on a grid. A tile is either clear or occupied.
 *
 */

Class Tile {
	
	private $isClear;
	private $hasStartMarker;
	private $hasGoalMarker;

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
	 * @return void
	 */
	public function setStartMarker() {
		$this->hasStartMarker = true;
	}
	
	/**
	 * @return void
	 */
	public function setGoalMarker() {
		$this->hasGoalMarker = true;
		$this->isClear = true;
		// TODO is this overwriting of occupied desired?
	}
	
	/**
	 * @return boolean
	 */
	public function hasStartMarker() {
		return $this->hasStartMarker;
		$this->isClear = true;
		// TODO is this overwriting of occupied desired?
	}
	
	/**
	 * return boolean
	 */
	public function hasGoalMarker() {
		return $this->hasGoalMarker;
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