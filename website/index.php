<?php 
require_once '../rectangular_coordinates.php';
require_once '../rectangular_grid.php';

$coord = new RectangularCoordinates(20, 10);
$grid = new RectangularGrid($coord);

# display website
include("template.html");