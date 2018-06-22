<?php

namespace MemeBoy\Http;

class Factory
{

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var string
	 */
	private $method;

	/**
	 * @var array
	 */
	private $headers = [];

	/**
	 * @var string
	 */
	private $data;

	/**
	 * @var string
	 */
	private $dataType;

	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var object
	 */
	private $c;

	/**
	 * @param object \MemeBoy\Http\Response
	 */
	private $response;

	/**
	 * @param object \MemeBoy\Http\Request
	 */
	private $request;

	/**
	 * @param array
	 * @return self
	 */
	public function __construct($config = null)
	{
		$this->config = $config ?? [];
		$this->init();
	}

	/**
	 * Init curl object
	 * @return self
	 */
	private function init()
	{
		$this->c = curl_init();
		
		$headers = [];
		foreach($this->headers as $key => $val)
		{
			$headers[] = "$key: $val";
		}

		$this->headers = $headers;
		$this->setup();
	}

	/**
	 * Execute
	 */
	public function exec()
	{
		$this->init();
		$request = new Request($this->c);
		$response = $request->getResponse();

		$this->request = $request;
		$this->response = $response;
	}

	/**
	 * @return object \MemeBoy\Http\Response
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * @return object \MemeBoy\Http\Request
	 */
	public function getRequest()
	{
		return $this->request;
	}

	private function setup()
	{
		$isGet = ((strtolower($this->method) == 'get'));

		curl_setopt($this->c, CURLOPT_URL, $this->url);
		curl_setopt($this->c, CURLOPT_RETURNTRANSFER, $this->method);
		curl_setopt($this->c, CURLOPT_TIMEOUT, $this->options['timeout'] ?? 60);
		curl_setopt($this->c, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($this->c, CURLOPT_USERAGENT, $this->config['useragent'] ?? $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($this->c, CURLOPT_POST, (!$isGet));

		if (!$isGet)
		{
			curl_setopt($this->c, CURLOPT_POSTFIELDS, $this->data);
		}
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setUrl($s)
	{
		$this->url = $s;
		return $this;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setMethod($s)
	{
		$this->method = $s;
		return $this;
	}

	/**
	 * @param mixed
	 * @return self
	 */
	public function setHeaders($a = [])
	{
		$a = is_array($a) ? $a : [$a];
		$this->headers = array_merge($this->headers, $a);
		return $this;
	}

}
