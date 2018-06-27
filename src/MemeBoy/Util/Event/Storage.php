<?php

namespace MemeBoy\Util\Event;

/**
 * Meme boy's implementation
 * of a event storage
 */
class Storage
{
	private $name;

	private $types;

	private $before;

	private $after;

	private $beforeEach;

	private $afterEach;

	public function __construct($name)
	{
		$this->name = $name;
		$this->types = [];
	}

	public function getName()
	{
		return $this->name;
	}

	public function before($callback)
	{
		$this->before = $callback;
		return $this;
	}

	public function beforeEach($callback)
	{
		$this->beforeEach = $callback;
		return $this;
	}

	public function after($callback)
	{
		$this->after = $callback;
		return $this;
	}

	public function afterEach($callback)
	{
		$this->afterEach = $callback;
		return $this;
	}

	public function add($type, $callback)
	{
		$this->types[$type][] = $callback;
		return $this;
	}

	public function dispatch($type, $data = null)
	{
		if (!isset($this->types[$type]))
		{
			throw new \Exception("Type {$type} does not exist");
		}

		if (is_callable($this->before))
		{
			\call_user_func($this->before, $type, $data);
		}

		foreach ($this->types[$type] as $callback)
		{
			if (is_callable($this->beforeEach))
			{
				\call_user_func($this->beforeEach, $type, $data);
			}

			$callback($type, $data);

			if (is_callable($this->afterEach))
			{
				\call_user_func($this->afterEach, $type, $data);
			}
		}

		if (is_callable($this->after))
		{
			\call_user_func($this->after, $type, $data);
		}

		return $this;
	}

}
