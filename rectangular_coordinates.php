<?php
include_once 'coordinates.php';

class Directions {
	const NORTH = 0;
	const EAST = 1;
	const SOUTH = 2;
	const WEST = 3;
}

class RectangularCoordinates extends coordinates {
	
	private $x;
	private $y;
	
	public function __construct($x, $y) {
		$this->x = $x;
		$this->y = $y;
	}
	
	public function getX() {
		return $this->x;
	}
	
	public function getY() {
		return $this->y;
	}
	
	function getNeighbor($direction) {
		switch($direction) {
			case Directions::NORTH: 
				return new RectangularCoordinates($this->x, $this->y + 1);
				break;
			case Directions::EAST:
				return new RectangularCoordinates($this->x + 1, $this->y);
				break;
			case Directions::SOUTH:
				return new RectangularCoordinates($this->x, $this->y - 1);
				break;
			case Directions::WEST:
				return new RectangularCoordinates($this->x - 1, $this->y);
				break;
			default:
				# TODO raise error
				return NULL;
		}
	}
	
	function __toString() {
		return "(" . $this->x . ", " . $this->y . ")";
	}
}

#$c0 = new RectangularCoordinates(4, 1);
#echo $c0;

