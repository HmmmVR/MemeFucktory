<?php

namespace MemeBoy\Util;

/**
 * Autoload classes
 */
class AutoLoader
{
	
	/**
	 * @var array
	 */
	private $files = [];
	
	/**
	 * @return void
	 */
	function __construct ()
	{
		spl_autoload_register([$this, '__autoload']);
	}
	
	/**
	 * @param string
	 * @return self
	 */
	public function addFolder ($folder)
	{
		$files = \scandir($folder);
		$files = array_slice($files, 2);
		
		foreach ($files as $file)
		{
			$this->files[] = $folder . '/' . $file;
		}

		return $this;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function addFile ($file)
	{
		$this->files[] = $file;
		return $this;
	}

	/**
	 * @param string
	 * @return void
	 */
	private function __autoload ($class)
	{
		if(file_exists($class))
		{
			require_once $class;
		}
	}

	/**
	 * @return void
	 */
	public function autoLoad ()
	{
		foreach ($this->files as $file)
		{
			$this->__autoload($file);
		}
	}

}