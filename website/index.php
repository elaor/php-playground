<?php 
use GridWorld\Grid\CartesianCoordinates;
use GridWorld\Grid\CartesianRegion;
use GridWorld\Grid\Grid;
use GridWorld\Grid\Tile;
use GridWorld\Grid\CartesianGridView;
require_once 'Grid/CartesianCoordinates.php';
require_once 'Grid/CartesianGridView.php';

$min = new CartesianCoordinates(10, 13);
$size = new CartesianCoordinates(4, 3);
$region = new CartesianRegion($min, $size);
$grid = new Grid();
$grid->setTile(new CartesianCoordinates(10, 13), new Tile(false));
$grid->setTile(new CartesianCoordinates(11, 14), new Tile(false));
$grid->setTile(new CartesianCoordinates(12, 16), new Tile(false));
$grid->setTile(new CartesianCoordinates(13, 17), new Tile(false));
$test = new CartesianGridView();
$output = $test->gridToHTML($grid, $region);
//$search = new AStarSearch($start, $goal, $grid);

# display website
include("template.html");