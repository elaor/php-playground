<?php
namespace GridWorld\Grid;

abstract class Coordinates {
	
	/**
	 * @param Coordinates $other
	 * @return Coordinates
	 */
	public abstract function add(Coordinates $other);
	
	/**
	 * @param integer $factor
	 * @return Coordinates
	 */
	public abstract function scale($factor);
	
	/**
	 * @param integer $factor
	 * @return Coordinates
	 */
	public function multiply($factor) {
		$result = clone $this;
		return $result->scale($factor);
	}
	
	/**
	 * @param Coordinates $other
	 * @return Coordinates
	 */
	public function subtract($other) {
		return $this->add($other->multiply(-1));
	}
	
	/**
	 * @return double
	 */
	public abstract function length();
	
	/**
	 * @param string $direction
	 * @return Coordinates
	 */
	public abstract function getNeighbor($direction);
	
	/**
	 * @return array
	 */
	public abstract function getNeighbors();
	
	/**
	 * @return array
	 */
	public abstract function getDirections();
	
	/**
     * @return string unique string representation of these coordinates.
     */
	public abstract function getUniqueIndex();
}