<?php
namespace GridWorld\Search;

use GridWorld\Grid\Coordinates;
require_once 'Heuristic.php';

class ManhattanHeuristic implements Heuristic {
	
	public function getHeuristicValue(Coordinates $currentPosition, Coordinates $goalPosition) {
		return $currentPosition->subtract($goalPosition)->length();
	}
}