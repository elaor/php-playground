<?php
namespace GridWorld\Search;

use GridWorld\Grid\Coordinates;

interface Heuristic {
	
	/**
	 * @param Coordinates $currentPosition
	 * @param Coordinates $goalPosition
	 * @return number
	 */
	function getHeuristicValue(Coordinates $currentPosition, Coordinates $goalPosition);
}