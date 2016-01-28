<?php
namespace GridWorld\Search;

use GridWorld\Grid\Coordinates;

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
	public function __construct(Coordinates $coordinate, $gValue, $hValue, Node $parent = NULL, $label = "") {
		$this->coordinates = $coordinate;
		$this->gValue = $gValue;
		$this->hValue = $hValue;
		$this->parent = $parent;
		$this->label = $label;
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

	public function getParent() {
		return $this->parent;
	}
	
	public function setParent($node) {
		$this->parent = $node;
	}
	
	public function getLabel() {
		return $this->label;
	}

	public function __toString() {
		return "[" . $this->coordinates . ", g: " . $this->gValue . ", h: " . $this->hValue . ", f: " . $this->getFValue() . "]";
	}

}