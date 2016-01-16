<?php
include_once 'grid.php';
include_once 'rectangular_coordinates.php';
include_once 'tile.php';

class RectangularGrid extends Grid {
	
	private $tiles;
	private $maxCoordinate; 
	
	public function __construct($maxCoordinates) {
		$this->maxCoordinate = $maxCoordinates;
		if (!$this->isValid($maxCoordinates)) {
			# TODO: Raise error
		}
		for ($i = 0; $i < $maxCoordinates->getX() + 1; $i++) {
			for ($j = 0; $j < $maxCoordinates->getY() + 1; $j++) {
				$this->tiles[$i][$j] = new Tile();
			}
		}
		$this->directions = array(Directions::EAST, Directions::NORTH,
				                  Directions::SOUTH, Directions::WEST);
	}
	
	public function getTile($coordinates) {
		return $this->tiles[$coordinates->getX()][$coordinates->getY()];
	}
	
	public function isValid($coordinates) {
		$x = $coordinates->getX();
		$y = $coordinates->getY();
		if ($x <= 0 || $y <= 0) {
			return false;
		}
		if ($x > $this->maxCoordinate->getX() || $y > $this->maxCoordinate->getY()) {
			return false;
		}
		return true;
	}
	
	public function __toString() {
		$output = "";
		foreach ($this->tiles as $a) {
			foreach ($a as $tile) {
				$output .= $tile . " ";
			}
			$output .= "\n";
		}
		
		return $output;
	}
}

$c = new RectangularCoordinates(20, 10);
$test = new RectangularGrid($c);
echo $test;

