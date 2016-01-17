<?php

abstract class Coordinates {
	
	public abstract function add($other);
	public abstract function scale($factor);
	public function multiply($factor) {
		return $this->clone()->scale($factor);
	}
	public function subtract($other) {
		return $this->add($other->multiply(-1));
	}
	public abstract function getLength();
	public abstract function getNeighbor($direction);
	
}