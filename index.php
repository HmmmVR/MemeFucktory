<?php

session_start();

require __DIR__ . "/autoloader.php";

use MemeBoy\Router\Factory as RouterFactory;
use MemeBoy\Meme\Factory as MemeFactory;
use MemeBoy\Meme\Adapter\Reddit as RedditAdapter;
use MemeBoy\Meme\Adapter\ImgFlip as ImgFlipAdapter;

$r = new RouterFactory();

$r->setPrefix("/api/memes");

$r->add("GET", "/reddit/:subreddit", function ($req, $res) {
	$adapter = new RedditAdapter($req->getParams()['subreddit']);
	
	$fucktory = new MemeFactory($adapter);
	$memes = $fucktory->get();
});

$r->add("GET", "/imgflip", function ($req, $res) {
	$adapter = new ImgFlipAdapter();

	$fucktory = new MemeFactory($adapter);
	$memes = $fucktory->get();
});

$r->add("GET", "", function ($req, $res) {
	$adapters = [];
	// $adapters[] = new ImgFlipAdapter();
	$adapters[] = new RedditAdapter("meirl");

	$fucktory = new MemeFactory($adapters);
	$memes = json_decode($fucktory->getAsJson(), true);
	include "gayTemplate.php";
});

$r->setPrefix("");
$r->add("GET", "test/event", function ($req, $res) {

	class MyChild extends \MemeBoy\Util\Event\Eventable
	{
		public function __construct()
		{
			parent::__construct("MyChild");
		}
	}

	$c = new MyChild();
	
	$s = $c->getStorage();
	
	$s->add("get", function($event, $data) {
		echo "{$event}\n{$data['name']}\n";
	});
	
	$s->beforeEach(function($event, $data) {
		echo "before each\n";
	});

	$s->afterEach(function($event, $data) {
		echo "after each\n";
	});

	$s->before(function($event, $data) {
		echo "before\n";
	});

	$s->after(function($event, $data) {
		echo "after\n";
	});

	$c->dispatchEvent('get', ['name' => 'event']);

});

$r->dispatch();
