<?php
namespace GridWorld\Grid;
use GridWorld\Grid\TileGenerator;
require_once 'TileGenerator.php';

class MazeGenerator implements TileGenerator
{

    private $grid;

    private $region;

    private $tile;

    /**
     * Fills a region with a random maze.
     */
    public function __construct ()
    {}

    public function fill_region ($grid, $region, $tile)
    {
        $this->grid = $grid;
        $this->region = $region;
        $this->tile = $tile;
        $coordinates = $region->sample_random();
        
        $this->grid->setTile($coordinates, clone $this->tile);
        $this->maze_recursion($coordinates);
    }

    /**
     *
     * @param Coordinates $coordinates            
     */
    private function maze_recursion ($coordinates)
    {
        $directions = $coordinates->getDirections();
        shuffle($directions);
        foreach ($directions as $direction) {
            $one_step = $coordinates->add($direction);
            $two_step = $one_step->add($direction);
            if (! $this->region->contains($two_step)) {
                continue;
            }
            if ($this->grid->getTile($two_step)->isClear()) {
                $this->grid->setTile($one_step, clone $this->tile);
                $this->grid->setTile($two_step, clone $this->tile);
                $this->maze_recursion($two_step);
            }
        }
    }
}