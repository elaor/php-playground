<?php
include_once 'coordinates.php';
class HexDirections {
	private static $neighbors = null;
	const EAST = 0;
	const NORTH_EAST = 1;
	const NORTH_WEST = 2;
	const WEST = 3;
	const SOUTH_WEST = 4;
	const SOUTH_EAST = 5;
	public static function getNeighbors()
	{
		if ($this->neighbors === null) {
			$this->neighbors[EAST] = HexCoordinates(1, 0);
			$this->neighbors[NORTH_EAST] = HexCoordinates(0, 1);
			$this->neighbors[NORTH_WEST] = HexCoordinates(-1, 1);
			$this->neighbors[WEST] = HexCoordinates(-1, 0);
			$this->neighbors[SOUTH_WEST] = HexCoordinates(0, -1);
			$this->neighbors[SOUTH_EAST] = HexCoordinates(1, -1);
		}
		return $this->neighbors;
	}
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
		return $this->x;
	}
	public function getY() {
		return $this->y;
	}
	public function getZ() {
		return $this->z;
	}
	public function add($other) {
		return new self($this->x + $other->x, $this->y + $other->y);
	}
	public function scale($factor){
		$this->x * $factor;
		$this->y * $factor;
		$this->z = - $this->x - $this->y;
		return $this;
	}
	public function getLength() {
		return max(abs($this->x), abs($this->y), abs($this->z));
	}
	function getNeighbor($direction) {
		return $this->add(HexDirections::getNeighbors()[$direction]);
	}
	private $x;
	private $y;
	private $z;
}