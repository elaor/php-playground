<?php
require_once 'hex_grid.php';
require_once 'hex_coordinates.php';
echo "<h1>Hello World\n</h1>";
echo "Creating Grid...\n";
$test = new HexGrid(new HexCoordinates(5,5));
echo "printing grid...";
echo $test;
echo "testing geometry...";
$a = new HexCoordinates(1,0);
echo "a: ".$a." ,length: ".$a->length()."\n";
$b = new HexCoordinates(3,5);
echo "b: ".$b." ,length: ".$b->length()."\n";
$c = $a->subtract($b);
echo "a-b: ".$c." ,length: ".$c->length()."\n";
$n = $a->getNeighbor(HexDirections::SOUTH_WEST);
echo "n: ".$n." ,length: ".$n->length()."\n";
echo "done.\n\n";

# Test A* search
require_once 'rectangular_grid.php';
require_once 'search.php';

# create a grid
$grid = new RectangularGrid(new RectangularCoordinates(2, 2));
$start = new RectangularCoordinates(0, 0);
$goal = new RectangularCoordinates(2, 2);
$search = new AStarSearch($start, $goal, $grid);
$search->run();