<?php
include_once 'hex_grid.php';
echo "Hello World\n";
echo "Creating Grid...\n";
$test = new HexGrid(new HexCoordinates(5,5));
echo "printing grid...";
echo $test;
echo "done.\n\n";

# Test A* search
include_once 'rectangular_grid.php';
include_once 'search.php';

# create a grid
$grid = new RectangularGrid(new RectangularCoordinates(2, 2));
$start = new RectangularCoordinates(0, 0);
$goal = new RectangularCoordinates(2, 2);
$search = new AStarSearch($start, $goal, $grid);
$search->run();