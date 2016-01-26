<?php
include_once 'cartesian_coordinates.php';

class CartesianRegion implements Iterator
{

    private $min;

    private $max;

    private $size;

    private $current_element;

    private $current_key;

    public function __construct ($min, $size)
    {
        $this->min = $min;
        $this->size = $size;
        $this->max = $min->add($size);
        $this->rewind();
    }
    
    public function getWidth() {
        return $this->size->getX();
    }

    public function getHeight() {
        return $this->size->getY();
    }

    public function getMin() {
        return $this->min;
    }

    public function getMax() {
        return $this->max;
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
        $this->current_key++;
        $next = $this->current_element->getNeighbor(CartesianCoordinates::EAST);
        if (! $this->contains($next)) {
            $next = $next->getNeighbor(CartesianCoordinates::NORTH);
            $next = $next->subtract(CartesianCoordinates::getNeighbors()[CartesianCoordinates::EAST]->scale($this->size->getX()));
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
