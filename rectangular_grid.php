<?php
include_once 'grid.php';

class RectangularGrid extends Grid {
	
	private $tiles;
	
	function __construct($x, $y) {
		for ($i = 0; $i < $x; $i++) {
			for ($j = 0; $j < $y; $j++) {
				$this->tiles[$i][$j] = 0;
			}
		}
	}
	
	function __toString() {
		foreach ($this->tiles as $a) {
			foreach ($a as $tile) {
				$output .= $tile . " ";
			}
			$output .= "\n";
		}
		return $output;
	}
}


$test = new RectangularGrid(10, 20);
echo $test;