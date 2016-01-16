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
		#var_dump($this->tiles);
	}
	
}

$test = new RectangularGrid(10, 20);
