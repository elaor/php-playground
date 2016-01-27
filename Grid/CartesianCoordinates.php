<?php
namespace GridWorld\Grid;
require_once 'Coordinates.php';

class CartesianCoordinates extends Coordinates
{
    const NORTH = "NORTH";
    const EAST = "EAST";
    const SOUTH = "SOUTH";
    const WEST = "WEST";
    
    private $x;

    private $y;
    
    private $neighbors;

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

    private function computeNeighbors() {
    	$this->neighbors[NORTH] = $this->add(new CartesianCoordinates(0, 1));
    	$this->neighbors[EAST] = $this->add(new CartesianCoordinates(1, 0));
    	$this->neighbors[SOUTH] = $this->add(new CartesianCoordinates(0, -1));
    	$this->neighbors[WEST] = $this->add(new CartesianCoordinates(-1, 0));
    }
    
    public function getNeighbor($direction)
    {
    	if (is_null($this->neighbors)) {
    		$this->computeNeighbors();
    	}
        return $this->neighbors[$direction];
    }
    
    public function getNeighbors() {
    	if (is_null($this->neighbors)) {
    		$this->computeNeighbors();
    	}
    	return $this->neighbors;
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
}

