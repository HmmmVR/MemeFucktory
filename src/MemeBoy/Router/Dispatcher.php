<?php

namespace MemeBoy\Router;

class Dispatcher
{
	/**
	 * @var object \MemeBoy\Router\Route
	 */
	private $route;

	/**
	 * @var bool
	 */
	private $paramResults;

	/**
	 * @var array
	 */
	private $routeParams;

	/**
	 * @var string
	 */
	private $regex;

	/**
	 * @var string
	 */
	private $checkAgainst;

	/**
	 * @param object \MemeBoy\Router\Route
	 * @return self
	 */
	public function __construct($route)
	{
		$this->route = $route;
		$this->paramResults = [];
		$this->routeParams = [];
		$this->checkAgainst = $_SERVER['REQUEST_URI'];
		$this->exec();
	}

	/**
	 * @return void
	 */
	public function exec()
	{
		preg_match($this->getRegex(), $this->checkAgainst, $matches);
		
		if (!empty($matches))
		{
			$this->match();

			$request = new Request($this->paramResults);
			$response = new Response();
			$this->route->setRequest($request);
			$this->route->setResponse($response);
			$this->route->exec();
			$_SESSION['router']['lastPath'] = $this->checkAgainst;
			die;
		}
	}

	public function match()
	{
		$path = $this->regex;
		$url = $this->checkAgainst;
		$params = explode('/', $url);

		$result = [];
		foreach ($params as $key => $param)
		{
			$match = $this->routeParams[$key];

			if ($param == '')
			{
				continue;
			}
			
			if ($match[0] != ':')
			{
				continue;
			}

			$result[ltrim($match, ':')] = $param;
		}

		$this->paramResults = $result;
	}

	/**
	 * @return string
	 */
	public function getRegex()
	{
		$s = "";
		$params = explode('/', $this->route->getPath());
		foreach($params as $key => $param)
		{
			$this->routeParams[$key] = $param;

			if ($param == '')
			{
				continue;
			}

			if ($param[0] == ':')
			{
				$s .= "\/.*";
			}
			else
			{
				$s .= "\/$param";
			}
		}

		$this->regex = "/$s/m";
		return $this->regex;
	}

}
