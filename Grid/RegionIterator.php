<?php
namespace GridWorld\Grid;
use GridWorld\Grid\Region;
use GridWorld\Grid\Coordinates;

class RegionIterator implements \Iterator
{

    /**
     *
     * @param Region $region            
     * @param Coordinates $start            
     */
    public function __construct ($region, $start = null)
    {
        if (is_null($start)) {
            $this->start = $region->sample_random();
        } else {
            $this->start = $start;
        }
        $this->region = $region;
        $this->closedList = null;
        $this->openList = null;
    }

    public function rewind ()
    {
        $this->closedList = [];
        $this->openList = new \SplPriorityQueue();
        $this->openList->setExtractFlags(\SplPriorityQueue::EXTR_DATA);
        $this->currentKey = 0;
        $this->currentValue = $this->start;
        $this->openList->insert($this->currentValue, 0);
        $this->isValid = true;
    }

    public function next ()
    {
        while (array_key_exists($this->openList->top()->getUniqueIndex(), $this->closedList)) {
            $this->openList->extract();
            if ($this->openList->isEmpty()) {
                $this->isValid = false;
                return;
            }
        }
        $this->currentValue = $this->openList->extract();
        $this->currentKey ++;
        $this->closedList[$this->currentValue->getUniqueIndex()] = true;
        foreach ($this->currentValue->getNeighbors() as $neighbor) {
            if (array_key_exists($neighbor->getUniqueIndex(), $this->closedList)) {
                continue;
            }
            if ($this->region->contains($neighbor)) {
                $this->openList->insert($neighbor, $this->start->subtract($neighbor)->length());
            }
        }
    }

    public function current ()
    {
        return $this->currentValue;
    }

    public function key ()
    {
        return $this->currentKey;
    }

    public function valid ()
    {
        return $this->isValid;
    }

    private $region;

    private $start;

    private $openList;

    private $closedList;

    private $isValid;

    private $currentValue;

    private $currentKey;
}