<?php
namespace GridWorld\Grid;
require_once 'Grid.php';
require_once 'CartesianRegion.php';
require_once 'Tile.php';

class CartesianGridView
{

    const MAX_WIDTH = 1500;

    const MAX_HEIGHT = 1000;

    private $tile_size = 10;

    public function gridToHTML (Grid $grid, CartesianRegion $region, 
            Coordinates $startPosition = null, Coordinates $goalPosition = null)
    {
        $tile_size = $this->computeTileSize($region->getWidth(), 
                $region->getHeight());
        $output = '';
        $gridWidth = $region->getWidth() * $this->tile_size;
        $gridHeight = $region->getHeight() * $this->tile_size;
        $output .= '<div id="box" style="width: ' . $gridWidth . 'px; height:' .
                 $gridHeight . 'px;">';
        foreach ($region as $coordinates) {
            $tile = $grid->getTile($coordinates);
            $screenCoords = $this->coordsToScreen($coordinates, $region);
            $output .= $this->tileToHTML($tile, $screenCoords, $coordinates);
        }
        $output .= '</div>';
        return $output;
    }

    private function computeTileSize ($width, $height)
    {
        $tile_width = self::MAX_WIDTH / $width;
        $tile_height = self::MAX_HEIGHT / $height;
        echo $tile_height;
        $this->tile_size = max(1, floor(min($tile_width, $tile_height)));
    }

    private function tileToHTML (Tile $tile, array $screenCoords, 
            Coordinates $coordinates)
    {
        $classTile = 'clear';
        $label = '';
        if (! ($tile->isClear())) {
            $classTile = 'occupied';
        }
        if ($tile->hasStartMarker()) {
            $classTile = 'start';
            $label = 'start';
        }
        if ($tile->hasGoalMarker()) {
            $classTile = 'goal';
            $label = 'goal';
        }
        return '<div class="tile ' . $classTile . '" style="left:' .
                 $screenCoords[0] . 'px; top:' . $screenCoords[1] . 'px; width:' .
                 $this->tile_size .
                 'px; height:' . $this->tile_size . 'px;" title="' . 
                 $coordinates->__toString() . '">' . $label . '</div>';
    }

    private function coordsToScreen ($coordinates, $region)
    {
        $min = $region->getMin();
        $max = $region->getMax();
        $x = $coordinates->getX() - $min->getX();
        $y = $max->getY() - 1 - $coordinates->getY();
        return [
                $x * $this->tile_size,
                $y * $this->tile_size
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
    require '../Website/template.html';
}



