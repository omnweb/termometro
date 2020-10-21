<?php 
//Inicia sessões 
session_start(); 
 
//Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["id_perfil"])) 
{ 
//Usuário não logado! Redireciona para a página de login 
header("Location: login.php"); 
exit; 
} 
?>