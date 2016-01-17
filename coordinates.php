<?php

abstract class Coordinates {
	
	public abstract function add($other);
	public abstract function multiply($factor);
	public function subtract($other) {
		return $this->add($other->multiply(-1));
	}
	public abstract function getLength();
	public abstract function getNeighbor($direction);
	
}