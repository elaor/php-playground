<?php
namespace GridWorld\Grid;
require_once 'CartesianCoordinates.php';
require_once 'Region.php';

class CartesianRegion implements Region
{

    private $min;

    private $max;

    private $size;

    private $current_element;

    private $current_key;

    /**
     * @param CartesianCoordinates $min
     * @param CartesianCoordinates $size
     */
    public function __construct ($min, $size)
    {
        $this->min = $min;
        $this->size = $size;
        $this->max = $min->add($size);
        $this->rewind();
    }

    public function getWidth ()
    {
        return $this->size->getX();
    }

    public function getHeight ()
    {
        return $this->size->getY();
    }

    public function getMin ()
    {
        return $this->min;
    }

    public function getMax ()
    {
        return $this->max;
    }

    public function getSize ()
    {
        return $this->size;
    }
    
    public function getTileCount()
    {
        return $this->size->getX() * $this->size->getY();
    }

    public function contains ($coordinates)
    {
        if ($coordinates->getX() < $this->min->getX()) {
            return false;
        }
        if ($coordinates->getX() >= $this->max->getX()) {
            return false;
        }
        if ($coordinates->getY() < $this->min->getY()) {
            return false;
        }
        if ($coordinates->getY() >= $this->max->getY()) {
            return false;
        }
        return true;
    }

    public function sample_random ()
    {
        $x = mt_rand($this->min->getX(), $this->max->getX());
        $y = mt_rand($this->min->getY(), $this->max->getY());
        return new CartesianCoordinates($x, $y);
    }

    public function rewind ()
    {
        $this->current_element = $this->min;
        $this->current_key = 0;
    }

    public function current ()
    {
        return $this->current_element;
    }

    public function next ()
    {
        $this->current_key ++;
        $next = $this->current_element->getNeighbor(CartesianCoordinates::EAST);
        if (! $this->contains($next)) {
            $next = $next->getNeighbor(CartesianCoordinates::NORTH);
            $next = $next->subtract(
                    (new CartesianCoordinates(1, 0))->scale($this->size->getX()));
        }
        $this->current_element = $next;
    }

    public function key ()
    {
        return $this->current_key;
    }

    public function valid ()
    {
        return $this->contains($this->current());
    }
}
if (! debug_backtrace()) {
    $min = new CartesianCoordinates(20, 10);
    $size = new CartesianCoordinates(3, 3);
    $region = new CartesianRegion($min, $size);
    foreach ($region as $coords) {
        echo $coords . ": \n";
    }
}
