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
	$adapters[] = new ImgFlipAdapter();
	$adapters[] = new RedditAdapter("me_irl");

	$fucktory = new MemeFactory($adapters);
	$memes = json_decode($fucktory->getAsJson(), true);
	include "gayTemplate.php";
});

$r->dispatch();
