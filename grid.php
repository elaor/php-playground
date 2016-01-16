<?php

abstract class Grid {
	
	protected $directions;
	
	public abstract function getTile($coordinates);
	
	public abstract function isValid($coordinates);
	
	public final function getDirections() {
		return $this->directions;
	}
	

}