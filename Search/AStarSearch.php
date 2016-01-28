<?php
namespace GridWorld\Search;
use GridWorld\Grid\Coordinates;
use GridWorld\Grid\Grid;
use GridWorld\Grid\Region;
require_once 'Search.php';
require_once 'Node.php';

class AStarSearch implements Search
{

    private $grid;

    private $region;

    private $initNode;

    private $goalNode;

    private $goalCoordinates;

    private $openList;

    private $closedList = [];
    
    private $heuristic;

    /**
     * For each coordinate, there should be at most one corresponding node.
     *
     * To avoid duplicates, they are stored in this node map.
     */
    private $nodeMap;

    public function __construct (Coordinates $start, Coordinates $goal, 
            Grid $grid, Heuristic $heuristic, Region $region = null)
    {
        $this->goalCoordinates = $goal;
        $this->grid = $grid;
        $this->heuristic = $heuristic;
        $this->region = $region;
        
        // Use start coordinates to create a search node
        $this->initNode = new Node($start, 0, $heuristic->getHeuristicValue($start, $goal));
        
        $this->openList = new \SplPriorityQueue();
        
        $nodeMap[$start->getX()][$start->getY()] = $this->initNode;
        $this->openList->insert($this->initNode, - $this->initNode->getFValue());
    }

    public function run ()
    {
        while (! $this->openList->isEmpty()) {
            $node = $this->openList->extract();
            if (array_key_exists($node->getCoordinates()->getUniqueIndex(), $this->closedList)) {
                continue;
            }
            if ($node->getCoordinates()->getX() == $this->goalCoordinates->getX() &&
                     $node->getCoordinates()->getY() ==
                     $this->goalCoordinates->getY()) {
                $this->goalNode = $node;
                return true;
            }
            $this->closedList[$node->getCoordinates()->getUniqueIndex()] = true;
            $this->expandNode($node);
        }
        return false;
    }

    private function expandNode (Node $node)
    {
        $nextCoordinates = $node->getCoordinates()->getNeighbors();
        foreach ($nextCoordinates as $direction => $next) {
            if (is_null($this->region) || $this->region->contains($next)) {
                // Coordinates next lies in the region or we have an open world
                // grid.
                // Check if the next tile is clear.
                if ($this->grid->getTile($next)->isClear()) {
                    // Get existing node or create a new one for this
                    // coordinate.
                    if (is_null(
                            $this->nodeMap[$next->getUniqueIndex()])) {
                        $successorNode = new Node($next, $node->getGValue() + 1, 
                        		$this->heuristic->getHeuristicValue($next, $this->goalCoordinates), 
                                $node, $direction);
                        $this->openList->insert($successorNode, 
                                - $successorNode->getFValue());
                    } else {
                        $successorNode = $this->nodeMap[$next->getUniqueIndex()];
                        if (is_null($this->closedList[$next->getUniqueIndex()])) {
                            if ($node->getGValue() + 1 <
                                     $successorNode->getGValue()) {
                                // Shorter path found
                                $successorNode->setGValue(
                                        $node->getGValue() + 1);
                                $successorNode->setParent($node);
                            }
                            $this->openList->insert($successorNode, 
                                    - $successorNode->getFValue());
                            // Note: nodes could exist multiple times in the
                        // open list with different g values
                        }
                    }
                }
            }
        }
    }

    public function extractPath ()
    {
        $path = [];
        if (! is_null($this->goalNode)) {
            $node = $this->goalNode->getParent();
            while (! is_null($node->getParent())) {
                $path[] = $node;
                $node = $node->getParent();
            }
        }
        return array_reverse($path);
    }

    public function extractPlan ()
    {
        $plan = [];
        if (! is_null($this->goalNode)) {
            $node = $this->goalNode;
            while (! is_null($node->getParent())) {
                $plan[] = $node->getLabel();
                $node = $node->getParent();
			}
		}
		return array_reverse($plan);
	}
}