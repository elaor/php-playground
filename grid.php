<?php

abstract class Grid {
	
	protected $directions;
	
	public abstract function getTile($coordinates);
	
	public abstract function isValid($coordinates);
	
	public abstract function toHTML();
	
	public final function getDirections() {
		return $this->directions;
	}
}