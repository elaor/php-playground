<?php 
use GridWorld\Grid\CartesianCoordinates;
use GridWorld\Grid\CartesianRegion;
use GridWorld\Grid\Grid;
use GridWorld\Grid\Tile;
use GridWorld\Grid\CartesianGridView;
use GridWorld\Search\AStarSearch;
require_once '../Grid/CartesianCoordinates.php';
require_once '../Grid/CartesianGridView.php';
require_once '../Search/AStarSearch.php';

if ($_POST) {
	// FIXME check input
	$width = $_POST['width'];
	$height = $_POST['height'];
	
}
else {
	$width = 20;
	$height = 20;
}
// Create a grid
$min = new CartesianCoordinates(0, 0);
$size = new CartesianCoordinates($width, $height);
$region = new CartesianRegion($min, $size);
$grid = new Grid();
$grid->setTile(new CartesianCoordinates(10, 13), new Tile(false));
$grid->setTile(new CartesianCoordinates(11, 14), new Tile(false));
$grid->setTile(new CartesianCoordinates(12, 16), new Tile(false));
$grid->setTile(new CartesianCoordinates(13, 17), new Tile(false));

// Create a view of the grid
$view = new CartesianGridView();
$output = $view->gridToHTML($grid, $region);

// Perform a search
$start = new CartesianCoordinates(5, 15);
$goal = new CartesianCoordinates(19, 3);
$search = new AStarSearch($start, $goal, $grid);
$found = $search->run();
if ($found) {
	$searchResult = "A* founds a path from start node to goal node";
}
else {
	$searchResult = "A* does not found a path...";
}

# display website
include("template.html");