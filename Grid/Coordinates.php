<?php
namespace GridWorld\Grid;

abstract class Coordinates {
	
	
	public abstract function add($other);
	public abstract function scale($factor);
	public function multiply($factor) {
		$result = clone $this;
		return $result->scale($factor);
	}
	public function subtract($other) {
		return $this->add($other->multiply(-1));
	}
	public abstract function length();
	public abstract function getNeighbor($direction);
	public abstract function getUniqueIndex();
}