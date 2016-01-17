<?php
include_once 'coordinates.php';
// class HexDirections {
// 	public static $EAST = new HexCoordinates(1, 0);
// 	public static $NORTH_EAST = new HexCoordinates(0, 1);
// 	public static $NORTH_WEST = new HexCoordinates(-1, 1);
// 	public static $WEST = new HexCoordinates(-1, 0);
// 	public static $SOUTH_WEST = new HexCoordinates(0, -1);
// 	public static $SOUTH_EAST = new HexCoordinates(1, -1);
// }
class HexCoordinates extends Coordinates {
// 	public static $EAST = static(1, 0);
// 	public static $directions = array(
// 		'EAST' => static(1, 0),
// 		'NORTH_EAST' => new HexCoordinates(0, 1),
// 		'NORTH_WEST' => new HexCoordinates(-1, 1),
// 		'WEST' => new HexCoordinates(-1, 0),
// 		'SOUTH_WEST' => new HexCoordinates(0, -1),
// 		'SOUTH_EAST' => new HexCoordinates(1, -1)
// 	);

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
			case HexDirections::$EAST:
				return new HexCoordinates($this->x + 1, $this->y);
				break;
			case "south":
				return new HexCoordinates($this->x, $this->y - 1);
				break;
			case HexDirections::$SOUTH:
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