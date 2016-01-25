<?php
require_once 'grid.php';
require_once 'rectangular_coordinates.php';
require_once 'tile.php';

class RectangularGrid extends Grid {
	
	private $tiles;
	private $maxCoordinate; 
	
	const TILE_SIZE_PX = 50;
	const TILE_BORDER_SIZE_PX = 1;
	
	public function __construct($maxCoordinate) {
		$this->maxCoordinate = $maxCoordinate;
		if (!($maxCoordinate->getX() > 0 && $maxCoordinate->getY() > 0)) {
			# TODO: Raise error
		}
		for ($i = 0; $i < $maxCoordinate->getX(); $i++) {
			for ($j = 0; $j < $maxCoordinate->getY(); $j++) {
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
		#echo "coord to check " . $coordinates . "\n";
		#echo "max coord " . $this->maxCoordinate , "\n";
		$x = $coordinates->getX();
		$y = $coordinates->getY();
		if ($x < 0 || $y < 0) {
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
				$output .= $tile->__toString() . " ";
			}
			$output .= "\n";
		}
		return $output;
	}
	
	public function toHTML() {
		$gridWidth = $this->maxCoordinate->getX() * (RectangularGrid::TILE_SIZE_PX + 2 * RectangularGrid::TILE_BORDER_SIZE_PX);
		$gridHeight = $this->maxCoordinate->getY() * (RectangularGrid::TILE_SIZE_PX + 2 * RectangularGrid::TILE_BORDER_SIZE_PX);
		$output .= "<div id=\"box\" style=\"width: " . $gridWidth . "px, \"height: " . $gridHeight ."\">";
		foreach ($this->tiles as $a) {
			foreach ($a as $tile) {
				$output .= $tile->toHTML();
			}
		}
		$output .= "</div>";
		return $output;
	}
}

if (!debug_backtrace()) {
	$c = new RectangularCoordinates(20, 10);
	$test = new RectangularGrid($c);
	echo $test->toHTML();
}



