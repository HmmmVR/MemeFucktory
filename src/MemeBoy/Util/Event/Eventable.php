<?php

namespace MemeBoy\Util\Event;

class Eventable
{

	/**
	 * Storage
	 * @var object \MemeBoy\Util\Event\Storage
	 */
	protected $storage;

	/**
	 * Constructor
	 * @param string storage name
	 * @return self
	 */
	public function __construct($name)
	{
		$this->storage = Manager::add($name);
	}

	/**
	 * Get storage
	 * @return object \MemeBoy\Util\Event\Storage
	 */
	public function getStorage()
	{
		return $this->storage;
	}

	/**
	 * Dispatch event
	 * @param string event name
	 * @param mixed event data
	 * @return void
	 */
	public function dispatchEvent($event, $data)
	{
		$this->storage->dispatch($event, $data);
	}

}
