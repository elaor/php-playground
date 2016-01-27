<?php
namespace GridWorld\Grid;
require_once 'Grid.php';
require_once 'CartesianRegion.php';
require_once 'Tile.php';

class CartesianGridView
{

    const TILE_SIZE_PX = 50;

    public function gridToHTML (Grid $grid, CartesianRegion $region, Coordinates $startPosition=null, Coordinates $goalPosition=null)
    {
        $output = '';
        $gridWidth = $region->getWidth() * self::TILE_SIZE_PX;
        $gridHeight = $region->getHeight() * self::TILE_SIZE_PX;
        $output .= '<div id="box" style="width: ' . $gridWidth . 'px; height:' . $gridHeight . 'px;">';
        foreach ($region as $coordinates) {
            $tile = $grid->getTile($coordinates);
            $screenCoords = $this->coordsToScreen($coordinates, $region);
            $output .= $this->tileToHTML($tile, $screenCoords, $coordinates);
        }
        $output .= '</div>';
        return $output;
    }

    private function tileToHTML (Tile $tile, array $screenCoords, Coordinates $coordinates)
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
        return '<div class="tile ' . $classTile . '" style="left:' . $screenCoords[0] .
               'px; top:' . $screenCoords[1] . 'px; width:' . self::TILE_SIZE_PX . 'px; 
               height:' . self::TILE_SIZE_PX . 'px;" title="'. $coordinates->__toString() . '">' . $label . '</div>';
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
    require '../Website/template.html';
}



