<?php
namespace GridWorld\Search;

class Node {

	private $coordinates;
	private $gValue;
	private $hValue;
	private $parent;

	public function __construct($coordinate, $gValue, $parent = NULL, $hValue = 1) {
		$this->coordinates = $coordinate;
		$this->gValue = $gValue;
		$this->hValue = $hValue;
		$this->parent = $parent;
	}

	public function getGValue() {
		return $this->gValue;
	}

	public function setGValue($gValue) {
		$this->gValue = $gValue;
	}

	public function getFValue() {
		return $this->gValue + $this->hValue;
	}

	public function getCoordinates() {
		return $this->coordinates;
	}

	public function setParent($node) {
		$this->parent = $node;
	}

	public function __toString() {
		return "[" . $this->coordinates . ", g: " . $this->gValue . ", h: " . $this->hValue . ", f: " . $this->getFValue() . "]";
	}

}