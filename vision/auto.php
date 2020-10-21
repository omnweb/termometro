<?php
	function __autoload($classe)
	{
		require_once "../model/{$classe}.class.php";
	}
?>