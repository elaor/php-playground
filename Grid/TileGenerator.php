<?php
namespace GridWorld\Grid;
use GridWorld\Grid\Grid;
use GridWorld\Grid\Region;
use GridWorld\Grid\Tile;

interface TileGenerator
{

    /**
     * @param Grid $grid            
     * @param Region $region            
     * @param Tile $tile            
     * @return void
     */
    public function fillRegion ($grid, $region, $tile);
}