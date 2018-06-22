<?php

namespace MemeBoy\Meme;

class Factory
{

	/**
	 * @var object \MemeBoy\Meme\Provider
	 */
	private $provider;

	/**
	 * @var bool
	 */
	private $multipleAdapters = false;

	/**
	 * @param object \MemeBoy\Meme\Adapter\Adapter
	 * @return self
	 */
	public function __construct($adapter)
	{
		if (is_array($adapter))
		{
			$this->multipleAdapters = true;
			
			$this->provider = [];
			foreach ($adapter as $key => $value)
			{
				$this->provider[] = new Provider($value);
			}
		}
		else
		{
			$this->provider = new Provider($adapter);
		}
	}

	public function getAsJson()
	{
		$data = [];
		$dataTmp = $this->get();
		foreach ($dataTmp as $meme)
		{
			$data[] = (array) $meme;
		}

		return json_encode($data);
	}

	/**
	 * Get the memes!
	 * @return array of Meme
	 */
	public function get()
	{
		$result = null;

		if ($this->multipleAdapters)
		{
			$data = [];
			foreach ($this->provider as $provider)
			{
				$providerResult = $provider->get();
				
				foreach ($providerResult as $meme)
				{
					$data[] = $meme;
				}
			}

			$result = $data;
		}
		else
		{
			$result = $this->provider->get();
		}

		return $result;
	}

}
