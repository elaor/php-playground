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

    public function fill_region ($grid, $region, $tile)
    {
        $coordinates = $region->sample_random();
        $score = mt_rand() / mt_getrandmax();
        if ($score < $this->density) {
            $grid->setTile($coordinates, clone $tile);
        }
    }
}