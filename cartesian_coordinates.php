<?php
require_once 'coordinates.php';

class CartesianCoordinates extends Coordinates
{
    private static $neighbors = null;
    
    const NORTH = 0;
    
    const EAST = 1;
    
    const SOUTH = 2;
    
    const WEST = 3;
    
    public static function getNeighbors ()
    {
        if (self::$neighbors === null) {
            self::$neighbors = [
                    self::EAST => new self(1, 0),
                    self::NORTH => new self(0, 1),
                    self::WEST => new self(- 1, 0),
                    self::SOUTH => new self(0, - 1)
            ];
        }
        return self::$neighbors;
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

    function getNeighbor ($direction)
    {
        return $this->add(self::getNeighbors()[$direction]);
    }

    function __toString ()
    {
        return "(" . $this->x . ", " . $this->y . ")";
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
}

