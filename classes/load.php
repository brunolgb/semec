<?php

spl_autoload_register(function ($class_name){

	$filename = $class_name.".php";
	if (file_exists($filename))
	{
		include_once("Tudo.php");
		echo "ta cert";
	}
	else
	{
		echo "não foi encontrado nada aqui";
	}

});

?>