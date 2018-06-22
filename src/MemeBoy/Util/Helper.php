<?php

namespace MemeBoy\Util;

class Helper
{

	public static function removeVowels($str)
	{
		$vowels = ['a', 'e', 'u', 'i', 'o'];
		return \str_replace($vowels, '', $str);
	}

}
