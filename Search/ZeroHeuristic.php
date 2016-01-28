<?php
namespace GridWorld\Search;

use GridWorld\Grid\Coordinates;
require_once 'Heuristic.php';

class ZeroHeuristic implements Heuristic {
	
	public function getHeuristicValue(Coordinates $currentPosition, Coordinates $goalPosition) {
		return $currentPosition->getUniqueIndex() === $goalPosition->getUniqueIndex() ? 0 : 1;
	}
}