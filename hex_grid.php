<?php
include 'hex_coordinates.php';
class HexGrid {
	function __construct($max) {
		$this->max = $max;
		for($x = 0; $x < $this->max->x; $x ++) {
			for($y = 0; $y < $this->max->y; $y ++) {
				$this->tiles [$x] [$y] = 0;
			}
		}
	}
	public function getTile($index) {
	}
	public function __toString() {
		$output = "\n";
		for($y = 0; $y < $this->max->y; $y ++) {
			if ($y % 2 == 0) {
				$output .= " ";
			}
			for($x = 0; $x < $this->max->x; $x ++) {
				$output .= $this->tiles [$x] [$y] . " ";
			}
			$output .= "\n";
		}
		return $output;
	}
	private $max;
	private $tiles;
}