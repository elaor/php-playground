<?php
namespace GridWorld\Grid;
use GridWorld\Grid\TileGenerator;
require_once 'TileGenerator.php';

class RandomWallGenerator implements TileGenerator
{

    private $density;

    private $maxWallLength;

    /**
     * Fills a region randomly with the specified tiles.
     *
     * @param float $density
     *            value between 0 and 1
     * @param integer $maxWallLength       
     */
    public function __construct ($density, $maxWallLength = 3)
    {
        $this->density = $density;
        $this->maxWallLength = $maxWallLength;
    }

    public function fill_region ($grid, $region, $tile)
    {
        for ($i = 0; $i < $region->getTileCount(); $i ++) {
            $coordinates = $region->sample_random();
            $score = mt_rand() / mt_getrandmax();
            if ($score < $this->density) {
                $directions = $coordinates->getDirections();
                $direction = $directions[array_rand($directions)];
                for ($wall_length = 0; $wall_length < $this->maxWallLength; $wall_length++) {
                    $grid->setTile($coordinates, clone $tile);
                    $coordinates = $coordinates->add($direction);
                }
            }
        }
    }
}