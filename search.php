<?php
include_once 'rectangular_coordinates.php';

class Node {
	
	private $coordinate;
	private $gValue;
	private $hValue;
	private $parent;
	
	public function __construct($coordinate, $gValue, $hValue = 1, $parent = NULL) {
		$this->coordinate = $coordinate;
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
	
	public function __toString() {
		return "[" . $this->coordinate . ", g: " . $this->gValue . ", h: " . $this->hValue . ", f: " . $this->getFValue() . "]"; 
	}
	
	public function getCoordinate() {
		return $this->coordinate;
	}
}

class AStarSearch {
	
	# grid world
	private $grid;
	private $initNode;
	private $goalCoordinate;
	
	private $openList;
	private $closedList;
	
	# For each coordinate, there should be at most one corresponding node.
	# To avoid duplicates, they are stored in this node map.
	private $nodeMap;
	
	
	public function __construct($start, $goal, $grid) {
		$this->openList = new SplPriorityQueue();
		$this->closedList = new SplObjectStorage();
		# use start coordinates to create a search node
		$this->initNode = new Node($start, 0);
		$nodeMap[$start] = $this->initNode;
		$this->openList->insert($this->initNode, -$this->initNode->getFValue());
		$this->goalCoordinate->$goal;
	}
	
	public function search() {
		while (!$openList->isEmpty()) {
			$node = $openList->extract();
			if ($node->getCoordinate() == $this->goalCoordinate) {
				return $node;
			}
			$this->closedList->attach($node);
			$this->expandNode($node);
		}
	}
	
	public function getSuccessors($node) {
		foreach ($this->grid->getDirections() as $direction) {
			$nextCoordinate = $node->getCoordinate()->getNeighbour($direction);
		}
	}
	
	public function expandNode($node) {
		$successors = $this->getSuccessors($node);
		foreach ($successors as $s) {
			if ($this->closedList->contains($s)) {
				continue;
			}
			$newGValue = $node->getGValue() + 1;
			if ($newGValue < $s->getGValue()) {
				# shorter path found or new node with unintialized g value
				$s->setGValue($newGValue);
				# Note: node s could exist multiple times in the open list with different g values
				$openList->insert($s, -$s->getFValue());
			}
		}
	}
}
$coord = new RectangularCoordinates(0, 0);
$nodeA = new Node($coord, 0);
echo "Node A: " . $nodeA . "\n";
$nodeB = new Node($coord, 1);
echo "Node B: " . $nodeB . "\n";
if ($nodeA == $nodeB) {
	print "yes";
}
else {
	print "false";
}
$queue = new SplPriorityQueue();
