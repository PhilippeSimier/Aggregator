<?php

	if(isset($_SESSION["language"]) and $_SESSION["language"] !== ''){
		$lang_file = "lang.{$_SESSION["language"]}.php";
	}else{
		$lang_file = 'lang.EN.php';
	}

	include_once 'lang/'.$lang_file;

?>