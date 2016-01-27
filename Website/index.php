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

// 1. Create a grid
if ($_POST) {
	// FIXME check input
	$width = $_POST['width'];
	$height = $_POST['height'];
}
else {
	$width = 20;
	$height = 20;
}
$min = new CartesianCoordinates(0, 0);
$size = new CartesianCoordinates($width, $height);
$region = new CartesianRegion($min, $size);
$grid = new Grid();

// 2. Set obstacles
$grid->setTile(new CartesianCoordinates(10, 13), new Tile(false));
$grid->setTile(new CartesianCoordinates(11, 14), new Tile(false));
$grid->setTile(new CartesianCoordinates(12, 16), new Tile(false));
$grid->setTile(new CartesianCoordinates(13, 17), new Tile(false));

// 3. Add start and goal position
if ($_POST) {
	// FIXME check input
	$startX = $_POST['start_x'];
	$startY = $_POST['start_y'];
	$goalX = $_POST['goal_x'];
	$goalY = $_POST['goal_y'];
}
else {
	$startX = 5;
	$startY = 15;
	$goalX = 19;
	$goalY = 3;
}
$start = new CartesianCoordinates($startX, $startY);
$startTile = new Tile();
$startTile->setStartMarker();
$grid->setTile($start, $startTile);
$goal = new CartesianCoordinates($goalX, $goalY);
$goalTile = new Tile();
$goalTile->setGoalMarker();
$grid->setTile($goal, $goalTile);

// 4. Create a view of the grid
$view = new CartesianGridView();
$output = $view->gridToHTML($grid, $region);

// // Perform a search
// $search = new AStarSearch($start, $goal, $grid);
// $found = $search->run();
// if ($found) {
// 	$searchResult = "A* founds a path from start node to goal node";
// }
// else {
// 	$searchResult = "A* does not found a path...";
// }

# display website
include("template.html");