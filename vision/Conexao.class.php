<?php

	abstract class Conexao {
		protected $db;
		
		protected function __construct()
		{
			$dc="mysql:host=localhost;dbname=termometro";
			try
			{
				$this->db = new PDO($dc, "root", "root");
			}
			catch ( Exception $e )
			{
				die ($e->getMessage());
			}
		}
	}
?>


