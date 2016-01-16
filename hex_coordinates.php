<?php
include_once 'coordinates.php';
class HexDirections {
	public static $EAST = 0;
	public static $NORTH_EAST = 1;
	public static $NORTH_WEST = 2;
	public static $SOUTH_WEST = 3;
	public static $SOUTH = 4;
	public static $SOUTH_EAST = 5;
}
class HexCoordinates extends Coordinates {
	function __construct($x = 0, $y = 0) {
		$this->set ( $x, $y );
	}
	public function set($x, $y) {
		$this->x = $x;
		$this->y = $y;
		$this->z = - $y - $x;
	}
	public function getX() {
		return $x;
	}
	public function getY() {
		return $y;
	}
	public function getZ() {
		return $z;
	}
	function getNeighbor($direction) {
		switch($direction) {
			case HexDirections::$NORTH_EAST: 
				return new HexCoordinates($this->x, $this->y + 1);
				break;
			case "east":
				return new HexCoordinates($this->x + 1, $this->y);
				break;
			case "south":
				return new HexCoordinates($this->x, $this->y - 1);
				break;
			case "west":
				return new HexCoordinates($this->x - 1, $this->y);
				break;
			default:
				# TODO raise error
				return NULL;
		}
	}
	private $x;
	private $y;
	private $z;
}