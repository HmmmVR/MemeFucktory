<?php

namespace MemeBoy\Util\Event;

/**
 * Meme boy's implementation
 * of a central event manager
 */
class Manager
{

	/**
	 * Static save place for storages
	 * @var array<Storage>
	 */
	private static $storages = [];

	/**
	 * Add storage
	 * @var string storage name
	 * @return object \MemeBoy\Util\Event\Storage
	 */
	public static function add($name)
	{
		$storage = new Storage($name);
		self::$storages[$name] = $storage;
		return $storage;
	}

	/**
	 * Add existing storage to manager
	 * @param object \MemeBoy\Util\Event\Storage
	 * @return object \MemeBoy\Util\Event\Storage
	 */
	public static function addExisting($storage)
	{
		self::$storage[$storage->getName()] = $storage;
		return self::get($storage->name);
	}

	/**
	 * Get storage
	 * @var string storage name
	 * @return object \MemeBoy\Util\Event\Storage
	 */
	public static function get($name)
	{
		return self::$storages[$name];
	}

	/**
	 * Dispatch event
	 * @var string storage name
	 * @var string event name
	 * @return void
	 */
	public static function dispatch($name, $event)
	{
		$storage = self::$storage[$name];
		$storage->dispatch($event);
	}

}
