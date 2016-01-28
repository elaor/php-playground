<?php

use GridWorld\Grid\CartesianCoordinates;
use GridWorld\Grid\CartesianRegion;
use GridWorld\Grid\Grid;
use GridWorld\Grid\Tile;
use GridWorld\Grid\CartesianGridView;
use GridWorld\Search\AStarSearch;
use GridWorld\Grid\EqualDistributionGenerator;
use GridWorld\Grid\RandomWallGenerator;
// TODO how to use autoload?
// spl_autoload_extensions(".php"); // comma-separated list
// spl_autoload_register();
require_once '../Grid/CartesianCoordinates.php';
require_once '../Grid/CartesianGridView.php';
require_once '../Search/AStarSearch.php';
require_once '../Grid/EqualDistributionGenerator.php';
require_once '../Grid/RandomWallGenerator.php';
require_once 'utility.php';

$invalidInput = false;

// all default values
$width = 20;
$height = 20;
$startX = 5;
$startY = 15;
$goalX = 19;
$goalY = 3;

// 1. Create a grid
if ($_POST) {
	$givenWidth = stripcleantohtml($_POST['width']);	
	$givenHeight = stripcleantohtml($_POST['height']);	
	$givenStartX = stripcleantohtml($_POST['start_x']);
	$givenStartY = stripcleantohtml($_POST['start_y']);
	$givenGoalX = stripcleantohtml($_POST['goal_x']);
	$givenGoalY = stripcleantohtml($_POST['goal_y']);
	$numbers = [$givenWidth, $givenHeight, $givenStartX, $givenStartY, $givenGoalX, $givenGoalY];
	foreach ($numbers as $number) {
		if (!ctype_digit($number)) {
			$invalidInput = true;
			break;
		}
	}
	if ($givenWidth <= 0 || $givenHeight <= 0) {
		$invalidInput = true;
	}
	if (!$invalidInput) {
		$width = $givenWidth;
		$height = $givenHeight;
		$startX = $givenStartX;
		$startY = $givenStartY;
		$goalX = $givenGoalX;
		$goalY = $givenGoalY;
	}
}
if (!$invalidInput) {
	$min = new CartesianCoordinates(0, 0);
	$size = new CartesianCoordinates($width, $height);
	$region = new CartesianRegion($min, $size);
	$grid = new Grid();
	
	// 2. Set obstacles
	$equal_sampler = new RandomWallGenerator(0.1);
	$equal_sampler->fill_region($grid, $region, new Tile(false));
	
	// 3. Set start and goal
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
	
	// Perform a search
	$search = new AStarSearch($start, $goal, $grid);
	$found = $search->run();
	if ($found) {
		$plan = join(", ", $search->extractPlan());
	}
}

# display website
include("template.html");