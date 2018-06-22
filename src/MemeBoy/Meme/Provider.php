<?php

namespace MemeBoy\Meme;

class Provider
{

	private $adapter;

	public function __construct($adapter)
	{
		$this->adapter = $adapter;
	}

	public function get()
	{
		return $this->adapter->get();
	}

}
