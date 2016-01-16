<?php
class HexIndex
{
	function __construct($x=0, $y=0)
	{
		$this->set($x, $y);
	}
	public function set($x, $y)
	{
		$this->x = $x;
		$this->y = $y;
		$this->z = -$y - $x;
	}
	public $x;
	public $y;
	public $z;
}