<?php

class Grid
{

    private $defaultTile;

    private $tiles = null;

    public function __construct ($defaultTile = null)
    {
        if ($defaultTile == null) {
            $defaultTile = new Tile();
        }
        $this->defaultTile = $defaultTile;
        $this->tiles = [];
    }

    public function getTile ($coordinates)
    {
        if (array_key_exists($coordinates->getUniqueIndex(), $this->tiles)) {
            return $this->tiles[$coordinates->getUniqueIndex()];
        }
        return $this->defaultTile;
    }

    public function setTile ($coordinates, $tile)
    {
        $this->tiles[$coordinates->getUniqueIndex()] = $tile;
    }
}