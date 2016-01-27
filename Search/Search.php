<?php
namespace GridWorld\Search;

interface Search {
	
	/**
	 * Starts search to the goal. Returns true iff goal is found and false otherwise.
	 * @return boolean
	 */
	public function run();
	
	/**
	 * Returns an array containing the nodes of the path induced by the found plan starting with the initial node.
	 * @return array
	 */
	public function extractPath();
	
	/**
	 * Returns the plan which is the sequence of actions to reach the goal.
	 * @return array
	 */
	public function extractPlan();
	
}


