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
     * @return integer
     */
    public function getWidth();

    /**
     * @return integer
     */
    public function getHeight();

    /**
     * @return Coordinates
     */
    public function getMin();

    /**
     * @return Coordinates
     */
    public function getSize();

    /**
     * @return Coordinates
     */
    public function getMax();
    
    /**
     * @return integer
     */
    public function getTileCount();

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
    public function sample_random();
    
    private $center = null;
    private $radius = 0;
}