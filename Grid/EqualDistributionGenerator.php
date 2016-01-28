<?php
namespace GridWorld\Grid;
use GridWorld\Grid\TileGenerator;
require_once 'TileGenerator.php';

class EqualDistributionGenerator implements TileGenerator
{

    private $density;

    /**
     * Fills a region randomly with the specified tiles.
     *
     * @param float $density
     *            value between 0 and 1
     */
    public function __construct ($density)
    {
        $this->density = $density;
    }

    public function fillRegion ($grid, $region, $tile)
    {
        foreach (new RegionIterator($region) as $coordinates) {
            $score = mt_rand(0,100) / 100;
            if ($score <= $this->density) {
                $grid->setTile($coordinates, clone $tile);
            }
        }
    }
}