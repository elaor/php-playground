<?php
namespace GridWorld\Grid;

use GridWorld\Grid\Coordinates;
interface Region
{
    /**
     * Are the specified $coordinates contained in this region?
     * @param Coordinates $coordinates
     * @return boolean
     */
    public function contains ($coordinates);
    
    /**
     * Produces random coordinates contained in this region. 
     * @return Coordinates
     */
    public function sample_random();
}