<?php

namespace MemeBoy\Http;

class Request
{

	/**
	 * @var object curl
	 */
	private $c;

	/**
	 * @var object \MemeBoy\Http\Response
	 */
	private $response;

	/**
	 * @param object curl
	 * @return self
	 */
	public function __construct($c)
	{
		$this->c = $c;
		$this->exec();
	}

	/**
	 * @return void
	 */
	public function exec()
	{
		$info = curl_getinfo($this->c);
		$data = curl_exec($this->c);
		curl_close($this->c);

		$this->response = new Response($this->c, $data, $info);
	}

	/**
	 * @return object \MemeBoy\Http\Response
	 */
	public function getResponse()
	{
		return $this->response;
	}

}
