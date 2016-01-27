<?php
namespace GridWorld\Grid;

use GridWorld\Grid\Coordinates;
interface Region extends \Iterator
{
    /**
     * @return int
     */
    public function getWidth();

    /**
     * @return int
     */
    public function getHeight();

    /**
     * @return Coordinates
     */
    public function getMin();

    /**
     * @return Coordinates
     */
    public function getMax();

    /**
     * 
     * @param Coordinates $coordinates
     */
    public function contains ($coordinates);
}