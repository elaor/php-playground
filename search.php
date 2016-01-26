<?php
require_once 'cartesian_coordinates.php';

class Node {
	
	private $coordinates;
	private $gValue;
	private $hValue;
	private $parent;
	
	public function __construct($coordinate, $gValue, $parent = NULL, $hValue = 1) {
		$this->coordinates = $coordinate;
		$this->gValue = $gValue;
		$this->hValue = $hValue;
		$this->parent = $parent;
	}
	
	public function getGValue() {
		return $this->gValue;
	}
	
	public function setGValue($gValue) {
		$this->gValue = $gValue;
	}
	
	public function getFValue() {
		return $this->gValue + $this->hValue;
	}
	
	public function getCoordinates() {
		return $this->coordinates;
	}
	
	public function setParent($node) {
		$this->parent = $node;
	}
	
	public function __toString() {
		return "[" . $this->coordinates . ", g: " . $this->gValue . ", h: " . $this->hValue . ", f: " . $this->getFValue() . "]"; 
	}

}

class AStarSearch {
	
	# grid world
	private $grid;
	private $initNode;
	private $goalCoordinates;
	
	private $openList;
	private $closedList;
	
	# For each coordinate, there should be at most one corresponding node.
	# To avoid duplicates, they are stored in this node map.
	private $nodeMap;
	
	
	public function __construct($start, $goal, $grid) {
		# use start coordinates to create a search node
		$this->initNode = new Node($start, 0);
		$this->grid = $grid;
		$this->goalCoordinates = $goal;
		
		$this->openList = new SplPriorityQueue();

		$nodeMap[$start->getX()][$start->getY()] = $this->initNode;
		$this->openList->insert($this->initNode, -$this->initNode->getFValue());
	}
	
	public function run() {
		while (!$this->openList->isEmpty()) {
			$node = $this->openList->extract();
			if ($this->closedList[$node->getCoordinates()->getX()][$node->getCoordinates()->getY()] != null) {
				continue;
			}
			#echo "Extract node " . $node . " from open list.\n";
			if ($node->getCoordinates()->getX() == $this->goalCoordinates->getX() && $node->getCoordinates()->getY() == $this->goalCoordinates->getY()) {
				echo "Path found!\n";
				return $node;
			}
			$this->closedList[$node->getCoordinates()->getX()][$node->getCoordinates()->getY()] = true;
			$this->expandNode($node);
		}
		echo "No path found!";
	}
	
	public function expandNode($node) {
		echo "Expand node " . $node . ".\n";
		foreach ($this->grid->getDirections() as $direction) {
			$nextCoordinates = $node->getCoordinates()->getNeighbor($direction);
			if ($this->grid->isValid($nextCoordinates)) {
				#echo "Next valid coordinate is " . $nextCoordinates . ".\n";
				if ($this->grid->getTile($nextCoordinates)->isClear()) {
					#echo "Next valid coordinate is " . $nextCoordinates . ".\n";
					// Get existing node or create a new one for this coordinate.
					if ($this->nodeMap[$nextCoordinates->getX()][$nextCoordinates->getY()] == NULL) {
						$successorNode = new Node($nextCoordinates, $node->getGValue() + 1, $node);
						$this->openList->insert($successorNode, -$successorNode->getFValue());
					}
					else {
						$successorNode = $this->nodeMap[$nextCoordinates];
						if (!$this->closedList[$nextCoordinates->getX()][$nextCoordinates->getY()] != null) {
							if ($node->getGValue() + 1 < $successorNode->getGValue()) {
								# Shorter path found
								$successorNode->setGValue($node->getGValue() + 1);
								$successorNode->setParent($node);
							}
							$this->openList->insert($successorNode, -$successorNode->getFValue());
							# Note: nodes could exist multiple times in the open list with different g values
						}
					}
				}
			}
		}
	}
}

