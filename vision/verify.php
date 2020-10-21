<?php 
session_start();
var_dump($_SESSION["id_perfil"]);
if(!isset($_SESSION["id_perfil"]) || !isset($_SESSION["descritivo_empresa"])) 
{ 
    header("Location: login.php");  
} 
else {
    if($_SESSION["perfil"] == 1){
        header("location:listar_empresa.php");
    }
    else if($_SESSION["perfil"] == 2){			
        header("location:listarPesquisa.php");
    }
    else {
        header("location:pesquisa.php");
    }
}
?>


