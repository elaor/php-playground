<?php
namespace GridWorld\Search;
use GridWorld\Grid\Coordinates;
use GridWorld\Grid\Grid;
require_once 'Search.php';
require_once 'Node.php';

class AStarSearch implements Search {

	private $grid;
	private $region;
	private $initNode;
	private $goalCoordinates;

	private $openList;
	private $closedList;

	# For each coordinate, there should be at most one corresponding node.
	# To avoid duplicates, they are stored in this node map.
	private $nodeMap;


	public function __construct(Coordinates $start, Coordinates $goal, Grid $grid, $region=null) {
		// Use start coordinates to create a search node
		$this->initNode = new Node($start, 0);
		$this->goalCoordinates = $goal;
		$this->grid = $grid;
		$this->region = $region;

		$this->openList = new \SplPriorityQueue();

		$nodeMap[$start->getX()][$start->getY()] = $this->initNode;
		$this->openList->insert($this->initNode, -$this->initNode->getFValue());
	}

	public function run() {
		while (!$this->openList->isEmpty()) {
			$node = $this->openList->extract();
			if ($this->closedList[$node->getCoordinates()->getX()][$node->getCoordinates()->getY()] != null) {
				continue;
			}
			if ($node->getCoordinates()->getX() == $this->goalCoordinates->getX() && $node->getCoordinates()->getY() == $this->goalCoordinates->getY()) {
				return true; // Path found
			}
			$this->closedList[$node->getCoordinates()->getX()][$node->getCoordinates()->getY()] = true;
			$this->expandNode($node);
		}
		return false; // No path found
	}

	private function expandNode(Node $node) {
		$nextCoordinates = $node->getCoordinates()->getNeighbors();
		foreach ($nextCoordinates as $direction => $next) {
			if (is_null ( $this->region ) || $this->region->contains ( $next )) {
				// Coordinates next lies in the region or we have an open world grid.
				// Check if the next tile is clear.
				if ($this->grid->getTile ( $next )->isClear ()) {
					// Get existing node or create a new one for this coordinate.
					if (is_null($this->nodeMap [$next->getX ()] [$next->getY ()])) {
						$successorNode = new Node ( $next, $node->getGValue () + 1, $node );
						$this->openList->insert ( $successorNode, - $successorNode->getFValue () );
					} else {
						$successorNode = $this->nodeMap [$next];
						if (is_null($this->closedList [$next->getX ()] [$next->getY ()])) {
							if ($node->getGValue () + 1 < $successorNode->getGValue ()) {
								// Shorter path found
								$successorNode->setGValue ( $node->getGValue () + 1 );
								$successorNode->setParent ( $node );
							}
							$this->openList->insert ( $successorNode, - $successorNode->getFValue () );
							// Note: nodes could exist multiple times in the open list with different g values
						}
					}
				}
			}
		}
	}
}