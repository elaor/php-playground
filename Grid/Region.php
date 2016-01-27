<?php

use GridWorld\Grid\Coordinates;
interface Region extends Iterator
{
    
    public function getWidth();

    public function getHeight();

    public function getMin();

    public function getMax();

    /**
     * 
     * @param Coordinates $coordinates
     */
    public function contains ($coordinates);
}