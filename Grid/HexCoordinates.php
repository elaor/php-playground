<?php
namespace GridWorld\Grid;
require_once 'Coordinates.php';

class HexCoordinates extends Coordinates
{

	private static $directions = null;

	const EAST = 'EAST';
	const NORTH_EAST = 'NORTH_EAST';
	const NORTH_WEST = 'NORTH_WEST';
	const WEST = 'WEST';
	const SOUTH_WEST = 'SOUTH_WEST';
	const SOUTH_EAST = 'SOUTH_EAST';

	private static function getDirections_ ()
	{
		if (self::$directions === null) {
			self::$directions = [
					self::EAST => new HexCoordinates(1, 0),
					self::NORTH_EAST => new HexCoordinates(0, 1),
					self::NORTH_WEST => new HexCoordinates(- 1, 1),
					self::WEST => new HexCoordinates(- 1, 0),
					self::SOUTH_WEST => new HexCoordinates(0, - 1),
					self::SOUTH_EAST => new HexCoordinates(1, - 1)
			];
		}
		return self::$directions;
	}
	
    private $x;

    private $y;

    private $z;

    function __construct ($x = 0, $y = 0)
    {
        $this->set($x, $y);
    }

    private function set ($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = - $y - $x;
    }

    public function getX ()
    {
        return $this->x;
    }

    public function getY ()
    {
        return $this->y;
    }

    public function getZ ()
    {
        return $this->z;
    }

    public function add ($other)
    {
        return new self($this->x + $other->x, $this->y + $other->y);
    }

    public function scale ($factor)
    {
        return new self($this->x * $factor, $this->y * $factor);
    }

    public function length ()
    {
        return max(abs($this->x), abs($this->y), abs($this->z));
    }

    public function getNeighbor ($direction)
    {
        return $this->add(HexDirections::getNeighbors()[$direction]);
    }

    /**
     * @param $direction
     * @return Coordinates
     * {@inheritDoc}
     * @see \GridWorld\Grid\Coordinates::getNeighbor()
     */
    public function getNeighbor($direction)
    {
        return $this->add(self::getDirections_()[$direction]);
    }
    
    public function getNeighbors() {
        $neighbors = [];
        foreach (self::getDirections_() as $key => $direction) {
            $neighbors[$key] = $this->add($direction);
        }
    	return $neighbors;
    }
    
    public function getUniqueIndex ()
    {
        return $this->__toString();
    }

    public function __toString ()
    {
        return '(' . $this->x . ', ' . $this->y . ', ' . $this->z . ')';
    }
}

if (! debug_backtrace()) {
    $a = new HexCoordinates(20, 10);
    $b = $a->scale(0.1);
    $c = $a->add($b->scale(- 1));
    $d = $a->subtract($b);
    echo $a;
    echo $b;
    echo $c;
    echo $d;
    echo $d->length();
}
