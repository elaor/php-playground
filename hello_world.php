<?php
include_once 'hex_grid.php';
echo "Hello World\n";
echo "Creating Grid...\n";
$test = new HexGrid(new HexIndex(5,5));
echo "printing grid...";
echo $test;
echo "done.\n";