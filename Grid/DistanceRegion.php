<?php
use GridWorld\Grid\Region;
use GridWorld\Grid\Coordinates;

class DistanceRegion implements Region
{

    /**
     * Constructs a region around a center with a given radius.
     * @param Coordinates $center
     * @param integer $radius
     */
    function __construct ($center, $radius)
    {
        $this->center = $center;
        $this->radius = $radius;
    }
    
    /**
     * Are the specified $coordinates contained in this region?
     * @param Coordinates $coordinates
     * @return boolean
     */
    public function contains ($coordinates) {
        if ($this->center->subtract($coordinates)->length() <= $this->radius) {
            return true;
        }
        return false;
    }
    
    /**
     * Produces random coordinates contained in this region. 
     * @return Coordinates
     */
    public function sample_random() {
        $coordinates = $this->center;
        $directions = $this->center->getDirections();
        foreach (array_slice($directions, 0, count($directions) / 2) as $direction) {
            $coordinates = $coordinates->add($direction->scale(mt_rand(0, $this->radius)));
        }
        return $coordinates;
    }
    
    private $center = null;
    private $radius = 0;
}