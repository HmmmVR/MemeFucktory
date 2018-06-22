<?php

namespace MemeBoy\Http;

class Response
{
	/**
	 * @var object
	 */
	private $c;

	/**
	 * @var string
	 */
	private $data;

	/**
	 * @var array
	 */
	private $info;

	/**
	 * @param object curl
	 * @param mixed data
	 * @param array info
	 * @return self
	 */
	public function __construct($c, $data, $info)
	{
		$this->c = $c;
		$this->data = $data;
		$this->info = $info;
	}

	/**
	 * @return string
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @return array
	 */
	public function getInfo()
	{
		return $this->info;
	}

}
