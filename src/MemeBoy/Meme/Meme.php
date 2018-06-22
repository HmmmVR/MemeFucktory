<?php

namespace MemeBoy\Meme;

class Meme
{

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $img;

	/**
	 * @var string
	 */
	public $desc;

	/**
	 * @var string
	 */
	public $author;

	/**
	 * @var array
	 */
	public $source;

	/**
	 * @var array
	 */
	public $extra;

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getImg()
	{
		return $this->img;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setImg($url)
	{
		$this->img = $url;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDesc()
	{
		return $this->desc;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setDesc($desc)
	{
		$this->desc = $desc;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setAuthor($author)
	{
		$this->author = $author;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @param mixed
	 * @return mixed
	 */
	public function setSource($source)
	{
		$this->source = $source;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getExtra()
	{
		return $this->extra;
	}

	/**
	 * @param array
	 * @return self
	 */
	public function setExtra($extra)
	{
		$this->extra = $extra;
		return $this;
	}

}
