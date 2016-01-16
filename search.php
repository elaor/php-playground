<?php

class Node {
	
	private $tile;
	private $gValue;
	private $hValue;
	
	public function __construct($tile, $gValue, $hValue) {
		$this->tile = $tile;
		$this->gValue = $gValue;
		$this->hValue = $hValue;
	}
	
	public function getFValue() {
		return $this->gValue + $this->hValue;
	}
	
	public function __toString() {
		return "(" . $this->tile . ", g: " . $this->gValue . ", h: " . $this->hValue . ", f: " . $this->getFValue() . ")\n"; 
	}
}


$nodeA = new Node(NULL, 0, 1);
#var_dump($nodeA);
$nodeB = new Node(NULL, 0, 10);
$nodeC = new Node(NULL, 1, 4);

$openList = new SplPriorityQueue();
$closedList = new SplObjectStorage();

$openList->insert($nodeA, -$nodeA->getFValue());
$openList->insert($nodeB, -$nodeB->getFValue());
$openList->insert($nodeC, -$nodeC->getFValue());

# TODO add initial node to openList

while (!$openList->isEmpty()) {
	$node = $openList->extract();
	echo $node;
}

