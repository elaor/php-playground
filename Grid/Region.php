<?php
namespace GridWorld\Grid;

use GridWorld\Grid\Coordinates;
interface Region extends \Iterator
{
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
    public function contains ($coordinates);
    
    /**
     * Produces random coordinates contained in this region. 
     * @return Coordinates
     */
    public function sample_random();
}