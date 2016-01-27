<?php
namespace GridWorld\Search;

class Node {

	private $coordinates;
	
	/**
	 * The path costs to reach this node.
	 * @var double
	 */
	private $gValue;
	
	/**
	 * The expected costs assigned to this node by a heuristic function.
	 * @var double
	 */
	private $hValue;
	
	/**
	 * The parent node in the search graph.
	 * @var Node
	 */
	private $parent;
	
	/**
	 * The label describes which action was applied to reach this node.
	 * @var string
	 */
	private $label;

	/**
	 * 
	 * @param unknown $coordinate
	 * @param unknown $gValue
	 * @param unknown $parent
	 * @param number $hValue
	 */
	public function __construct(Coordinate $coordinate, $gValue, Node $parent = NULL, $hValue = 1) {
		$this->coordinates = $coordinate;
		$this->gValue = $gValue;
		$this->hValue = $hValue;
		$this->parent = $parent;
	}

	/**
	 * 
	 */
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