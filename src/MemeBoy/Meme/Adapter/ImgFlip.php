<?php

namespace MemeBoy\Meme\Adapter;

use \MemeBoy\Http\Factory as HttpRequest;
use \MemeBoy\Meme\Meme;

class ImgFlip
{
	const URL = "https://api.imgflip.com/get_memes";

	private $result;

	private $memes;

	public function __construct()
	{
		$this->memes = [];
	}

	public function makeRequest()
	{
		$r = new HttpRequest();
		$r->setUrl(self::URL);
		$r->setMethod("GET");
		$r->exec();

		$this->result = $r->getResponse()->getData();
	}

	public function setMemes()
	{
		$response = json_decode($this->result, true);

		foreach ($response['data']['memes'] as $data)
		{
			$meme = new Meme();
			$meme->setSource($data);
			$meme->setTitle($data['name']);
			$meme->setAuthor($data['id']);
			$meme->setImg($data['url']);
			$this->memes[] = $meme;
		}
	}

	public function get()
	{
		$this->makeRequest();
		$this->setMemes();
		return $this->memes;
	}

}
