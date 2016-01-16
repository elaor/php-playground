<?php
include_once 'coordinates.php';

class RectangularCoordinates extends coordinates {

	private $x;
	private $y;
	
	function __construct($x, $y) {
		$this->x = $x;
		$this->y = $y;
	}
	
	function getNeighbor($direction) {
		switch($direction) {
			case "north": 
				return new RectangularCoordinates($this->x, $this->y + 1);
				break;
			case "east":
				return new RectangularCoordinates($this->x + 1, $this->y);
				break;
			case "south":
				return new RectangularCoordinates($this->x, $this->y - 1);
				break;
			case "west":
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

$c0 = new RectangularCoordinates(4, 1);
echo $c0;

