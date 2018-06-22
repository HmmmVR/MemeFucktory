<?php

namespace MemeBoy\Meme\Adapter;

use \MemeBoy\Http\Factory as HttpRequest;
use \MemeBoy\Meme\Meme;

class Reddit implements Adapter
{
	const URL = "https://api.reddit.com/r/";

	const USER = "https://reddit.com/u/";

	/**
	 * @var string
	 */
	private $subReddit;

	/**
	 * @var string
	 */
	private $result;

	/**
	 * @var array
	 */
	private $memes;

	/**
	 * @param string
	 * @return self
	 */
	public function __construct($subReddit)
	{
		$this->subReddit = $subReddit;
		$this->memes = [];
	}

	/**
	 * Make request to subreddit
	 * @return void
	 */
	public function makeRequest()
	{
		$r = new HttpRequest();
		$r->setUrl(self::URL . $this->subReddit);
		$r->setMethod("GET");
		$r->exec();
		$this->result = $r->getResponse()->getData();
	}

	/**
	 * @return void
	 */
	public function setMemes()
	{
		$result = json_decode($this->result, true);
		$posts = $result['data']['children'];
		
		foreach ($posts as $post)
		{
			$post = $post['data'];

			if ($post['thumbnail'] == 'self')
			{
				continue;
			}

			$img = $post['preview']['images'][0]['source']['url'];
			$author = self::USER . $post['author'];

			$meme = new Meme();
			$meme->setSource($post);
			$meme->setTitle($post['title']);
			$meme->setImg($img);
			$meme->setAuthor($author);

			$this->memes[] = $meme;
		}
	}
	
	/**
	 * @return array
	 */
	public function get()
	{
		$this->makeRequest();
		$this->setMemes();
		return $this->memes;
	}

}
