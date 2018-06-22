<?php

require_once __DIR__ . "/src/MemeBoy/Util/Autoloader.php";

use \MemeBoy\Util\Autoloader;

function autoload()
{
	$a = new Autoloader();
	$r = __DIR__ . "/src/MemeBoy";

	$a->addFile($r . "/Http/Request.php");
	$a->addFile($r . "/Http/Response.php");
	$a->addFile($r . "/Http/Factory.php");

	$a->addFile($r . "/Router/Factory.php");
	$a->addFile($r . "/Router/Route.php");
	$a->addFile($r . "/Router/Dispatcher.php");
	$a->addFile($r . "/Router/Request.php");
	$a->addFile($r . "/Router/Response.php");

	$a->addFile($r . "/Meme/Factory.php");
	$a->addFile($r . "/Meme/Meme.php");
	$a->addFile($r . "/Meme/Provider.php");
	$a->addFile($r . "/Meme/Adapter/Adapter.php");
	$a->addFile($r . "/Meme/Adapter/Reddit.php");
	$a->addFile($r . "/Meme/Adapter/ImgFlip.php");

	$a->autoload();

}
autoload();

