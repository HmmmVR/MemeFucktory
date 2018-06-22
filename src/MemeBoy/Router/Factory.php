<?php

namespace MemeBoy\Router;

class Factory
{

	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var array
	 */
	private $routes;

	/**
	 * @var string
	 */
	private $prefix;

	/**
	 * @param array
	 * @return self
	 */
	public function __construct($confg = null)
	{
		$this->config = $config ?? [];
		$this->routes = [];
	}

	/**
	 * @param string
	 * @param string
	 * @param callable
	 * @return object \MemeBoy\Router\Route
	 */
	public function add($method, $path, $callback)
	{
		$method = strtoupper($method);
		$r = new Route($method, $this->prefix . Route::trim($path), $callback);
		$this->routes[$method][] = $r;
		return $r;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setPrefix($prefix)
	{
		$this->prefix = Route::trim($prefix);
		return $this;
	}

	public function dispatch()
	{
		$routes = $this->routes[strtoupper($_SERVER['REQUEST_METHOD'])];
		
		foreach ($routes as $route)
		{
			$d = new Dispatcher($route);
			$d->exec();
		}
	}

	/**
	 * Print available route
	 * @return void
	 */
	public function print()
	{
		foreach ($this->routes as $method => $routes)
		{
			foreach ($routes as $route)
			{
				$route->print();
			}
		}
	}

}
