<?php
require_once 'grid.php';
require_once 'cartesian_coordinates.php';
require_once 'cartesian_region.php';
require_once 'tile.php';

class CartesianGridView
{

    const TILE_SIZE_PX = 50;

    public function gridToHTML ($grid, $region)
    {
        $output = '';
        $gridWidth = $region->getWidth() * self::TILE_SIZE_PX;
        $gridHeight = $region->getHeight() * self::TILE_SIZE_PX;
        $output .= '<div id="box">';
        foreach ($region as $coordinates) {
            $tile = $grid->getTile($coordinates);
            $screenCoords = $this->coordsToScreen($coordinates, $region);
            $output .= $this->tileToHTML($tile, $screenCoords);
        }
        $output .= '</div>';
        return $output;
    }

    private function tileToHTML ($tile, $screenCoords)
    {
        $classTile = 'tile_clear';
        if (! ($tile->isClear())) {
            $classTile = 'tile_occupied';
        }
        return '<div class="' . $classTile . '" style="left:' . $screenCoords[0] .
                 '; top:' . $screenCoords[1] . ';"></div>';
    }

    private function coordsToScreen ($coordinates, $region)
    {
        $min = $region->getMin();
        $max = $region->getMax();
        $x = $coordinates->getX() - $min->getX();
        $y = $max->getY() - 1 - $coordinates->getY();
        return [
                $x * self::TILE_SIZE_PX,
                $y * self::TILE_SIZE_PX
        ];
    }
}

if (! debug_backtrace()) {
    $min = new CartesianCoordinates(10, 13);
    $size = new CartesianCoordinates(4, 1);
    $region = new CartesianRegion($min, $size);
    $grid = new Grid();
    $grid->setTile(new CartesianCoordinates(10, 13), new Tile(false));
    $grid->setTile(new CartesianCoordinates(11, 14), new Tile(false));
    $grid->setTile(new CartesianCoordinates(12, 16), new Tile(false));
    $grid->setTile(new CartesianCoordinates(13, 17), new Tile(false));
    $test = new CartesianGridView();
    $output = $test->gridToHTML($grid, $region);
    // display website
    require 'website/template.html';
}



