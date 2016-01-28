<?php
namespace GridWorld\Search;

use GridWorld\Grid\Coordinates;
require_once 'Heuristic.php';

class EuklidianHeuristic implements Heuristic {
	
	public function getHeuristic(Coordinates $currentPosition, Coordinates $goalPosition) {
		// TODO
		return sqrt($arg);
	}
}