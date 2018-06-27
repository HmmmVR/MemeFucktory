<?php

namespace MemeBoy\Util\Event;

class Eventable
{

	protected $storage;

	public function __construct($name)
	{
		$this->storage = new Storage($name);
		Manager::addExisting($this->storage);
	}

	public function getStorage()
	{
		return $this->storage;
	}

	public function dispatchEvent($event, $data)
	{
		$this->storage->dispatch($event, $data);
	}

}
