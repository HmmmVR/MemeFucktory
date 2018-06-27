<?php

namespace MemeBoy\Util\Event;

/**
 * Meme boy's implementation
 * of a event storage
 */
class Storage
{
	/**
	 * Storage name
	 * @var string
	 */
	private $name;

	/**
	 * Storage of events
	 * @var array
	 */
	private $types;

	/**
	 * Callback before dispatch
	 * @var callable
	 */
	private $before;

	/**
	 * Callback after dispatch
	 * @var callable
	 */
	private $after;

	/**
	 * Callback before each dispatch
	 * @var callable
	 */
	private $beforeEach;

	/**
	 * Callback after each dispatch
	 * @var callable
	 */
	private $afterEach;

	/**
	 * Constructor
	 * @param string storage name
	 * @return self
	 */
	public function __construct($name)
	{
		$this->name = $name;
		$this->types = [];
	}

	/**
	 * Get storage name
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set callback before dispatch
	 * @param callable
	 * @var self
	 */
	public function before($callback)
	{
		$this->before = $callback;
		return $this;
	}

	/**
	 * Set callback after dispatch
	 * @param callable
	 * @var self
	 */
	public function beforeEach($callback)
	{
		$this->beforeEach = $callback;
		return $this;
	}

	/**
	 * Set callback before each dispatch
	 * @param callable
	 * @var self
	 */
	public function after($callback)
	{
		$this->after = $callback;
		return $this;
	}

	/**
	 * Set callback after each dispatch
	 * @param callable
	 * @var self
	 */
	public function afterEach($callback)
	{
		$this->afterEach = $callback;
		return $this;
	}

	/**
	 * Add callback for event
	 * @var string event name
	 * @var callable callback
	 * @return self
	 */
	public function add($type, $callback)
	{
		$this->types[$type][] = $callback;
		return $this;
	}

	/**
	 * Dispatch event
	 * @var string event name
	 * @var mixed data
	 * @return self
	 */
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
