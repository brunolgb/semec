<?php

class findClass{
	public static function search($className)
	{
		require_once($className . ".php");
	}
}

spl_autoload_register(['findClass', 'search']);

?>