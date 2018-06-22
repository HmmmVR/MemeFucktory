<?php

namespace MemeBoy\Router;

class Route
{

	/**
	 * @var string
	 */
	private $method;

	/**
	 * @var string
	 */
	private $path;

	/**
	 * @var callable
	 */
	private $callback;

	/**
	 * @var array
	 */
	private $middleware;

	/**
	 * @var object \MemeBoy\Router\Request
	 */
	private $request;

	/**
	 * @var object \MemeBoy\Router\Response
	 */
	private $response;

	/**
	 * @param string
	 * @param string
	 * @param callable
	 * @return self
	 */
	public function __construct($method, $path, $callback)
	{
		$this->method = $method;
		$this->path = $path;
		$this->callback = $callback;
		$this->middleware = [];
	}

	/**
	 * @param callable
	 * @return self
	 */
	public function addMiddleware($callback)
	{
		$this->middleware[] = $callback;
		return $this;
	}

	/**
	 * @param object \MemeBoy\Route\Request
	 * @return self
	 */
	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}

	/**
	 * @param object \MemeBoy\Route\Response
	 * @return self
	 */
	public function setResponse($response)
	{
		$this->response = $response;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Execute route
	 * @return void
	 */
	public function exec()
	{
		foreach ($this->middleware as $middleware)
		{
			$middleware($this->request, $this->response);
		}

		$cb = $this->callback;

		$cb($this->request, $this->response);
	}

	/**
	 * Trim path
	 * @param string
	 * @return string
	 */
	public static function trim($path)
	{
		return "/" . trim($path, "/");
	}

	/**
	 * Print this route
	 * @return void
	 */
	public function print()
	{
		echo "{$this->method}\t {$this->path}\n";
	}

}

