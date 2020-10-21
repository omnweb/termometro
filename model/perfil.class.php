<?php
	class perfil
	{
		private $id;
		private $linkn;
		private $nome;
		private $menu;
		
		
		function __construct($id="", $linkn="", $nome="", $menu="")
		{
			$this->id = $id;
			$this->linkn = $linkn;
			$this->nome = $nome;
			$this->menu = $menu;			
		}
		function getId()
		{
			return $this->id;
		}
		function getLinkn()
		{
			return $this->linkn;
		}
		function getNome()
		{
			return $this->nome;
		}
		function getMenu()
		{
			return $this->menu;
		}
		function setMenu($menu)
		{
			$this->menu= $menu;
		}
	}//class
?>