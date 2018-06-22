<?php

namespace MemeBoy\Router;

class Request
{

	private $params;

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function getParams()
	{
		return $this->params;
	}

}
