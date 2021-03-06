<?php
namespace GridWorld\Grid;
require_once 'Coordinates.php';

class CartesianCoordinates extends Coordinates
{
    const NORTH = "NORTH";
    const EAST = "EAST";
    const SOUTH = "SOUTH";
    const WEST = "WEST";
    
    private static $directions = null;
    
    private static function getDirections_ ()
    {
        if (self::$directions === null) {
            self::$directions = [
                    self::EAST => new self(1, 0),
                    self::NORTH => new self(0, 1),
                    self::WEST => new self(- 1, 0),
                    self::SOUTH => new self(0, - 1)
            ];
        }
        return self::$directions;
    }
    
    private $x;

    private $y;
    
    public function __construct ($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX ()
    {
        return $this->x;
    }

    public function getY ()
    {
        return $this->y;
    }
    
    public function getDirections() {
        return self::getDirections_();
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

    public function __toString ()
    {
        return "(" . $this->x . ", " . $this->y . ")";
    }

    public function add (Coordinates $other)
    {
        return new self($this->x + $other->x, $this->y + $other->y);
    }

    public function scale ($factor)
    {
        return new self($this->x * $factor, $this->y * $factor);
    }

    public function length ()
    {
        return abs($this->x) + abs($this->y);
    }

    public function getUniqueIndex ()
    {
        return $this->__toString();
    }
}

if (! debug_backtrace()) {
    $a = new CartesianCoordinates(20, 10);
    $b = $a->scale(0.1);
    $c = $a->add($b->scale(-1));
    $d = $a->subtract($b);
    echo $a;
    echo $b;
    echo $c;
    echo $d;
    echo $d->length();
    var_dump($a->getNeighbors());
}

