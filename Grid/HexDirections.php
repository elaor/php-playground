<?php
namespace GridWorld\Grid;

class HexDirections
{

	private static $neighbors = null;

	const EAST = 0;
	const NORTH_EAST = 1;
	const NORTH_WEST = 2;
	const WEST = 3;
	const SOUTH_WEST = 4;
	const SOUTH_EAST = 5;

	public static function getNeighbors ()
	{
		if (self::$neighbors === null) {
			self::$neighbors = [
					self::EAST => new HexCoordinates(1, 0),
					self::NORTH_EAST => new HexCoordinates(0, 1),
					self::NORTH_WEST => new HexCoordinates(- 1, 1),
					self::WEST => new HexCoordinates(- 1, 0),
					self::SOUTH_WEST => new HexCoordinates(0, - 1),
					self::SOUTH_EAST => new HexCoordinates(1, - 1)
			];
		}
		return self::$neighbors;
	}

	private function __construct ()
	{}
}