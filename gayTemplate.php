<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.wrapper {
			width: 500px;
			margin: 0 auto;
		}

		.memes {
			margin-left: 1rem;
		}

		.meme {
			display: flex;
			flex-direction: column;
			justify-content: center;
			background-color: lightgray;
			margin: 1rem;
			padding: 1rem;
		}

		.meme img {
			width: 300;
			height: auto;
			margin: 0 auto;
		}
	
	</style>
</head>
<body>
	<div class="wrapper">
	
		<ul class="memes">
			<h1>MEMES! XDDXDXDXDX</h1>
			
			<?
			foreach ($memes as $meme)
			{
			?>

			<li class="meme">
				<h3><?= $meme['title'] ?></h3>
				<img width="300" src="<?= $meme['img'] ?>" alt="">
			</li>

			<?	
			}
			?>

		</ul>

	</div>
</body>
</html>
