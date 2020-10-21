<?php
	require_once 'auto.php';	
	$erro=0;
	if($_POST)
	{
		if($_POST["email"]=="")
		{
			echo"<script>alert('Preencha seu e-Mail')</script>";
			$erro++;
		}
		if($_POST["senha"]=="")
		{
			echo"<script>alert('Preencha sua senha')</script>";
			$erro++;
		}
		if($erro==0)
		{
			$email= $_POST["email"];
			$senha= $_POST["senha"];
			$funcionario = new funcionario(null, null, null, null, null, $email, $senha);	
			// var_dump($funcionario);		
			$funcionarioDAO = new funcionarioDAO();
			$ret = $funcionarioDAO->login($funcionario);
			
			if(count($ret) > 0)
			{
				session_start();	
				$_SESSION["id_funcionario"] = $ret[0]->id_funcionario;			
				$_SESSION["nome_funcionario"] = $ret[0]->nome;
				$_SESSION["id_perfil"] = $ret[0]->id_perfil;
				
				//buscar empresa
				$empresa = new empresa($_SESSION["id_funcionario"]);				
				$empresaDAO = new empresaDAO();
				$resultado = $empresaDAO->buscarEmpresaFuncionario($empresa);
				$_SESSION["id_empresa"] = $resultado[0]->id_empresa;
				$_SESSION["descritivo_empresa"] = $resultado[0]->descritivo;

				// buscar campanha
				$campanha = new campanha($_SESSION["id_funcionario"]);
				$campanhaDAO = new campanhaDAO();
				$resposta = $campanhaDAO->funcionarioCampanha($campanha);
				$_SESSION["id_campanha"] = $resposta[0]->id_campanha;
				$_SESSION["descritivo_campanha"] = $resposta[0]->descritivo;
				
				// buscar as permissões de acordo com o acesso
					
				$perfil = new perfil($_SESSION["id_perfil"]);				
				$perfilDAO = new perfilDAO();
				$retorno = $perfilDAO->buscarPermissoes($perfil);				
				$_SESSION["menu"]= $retorno;
				
				if($_SESSION["id_perfil"] == 1){
					header("location:listar_empresa.php");
				}
				else if($_SESSION["id_perfil"] == 2){			
					header("location:painelAdmin.php");
				}
				else {
					header("location:pesquisa.php");
				}
			}
			else
			{
				echo "<script>alert('email/senha não conferem')</script>";
			}					
		}
	}
		
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Página de Login"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Página de Login</title> 
		<link rel="icon" type="imagem/png" href="../img/favicon.ico" />      
        <link rel="stylesheet" href="../style/css/bootstrap.css" type="text/css"/>
        <link rel="stylesheet" href="../style/css/myStyle.css" type="text/css"/>	
        <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">	
        <script type="text/javascript" src="../library/js/jquery.js"></script>
        <script type="text/javascript" src="../library/js/bootstrap.js"></script>        
    </head>
    <body > 
        <header>
            <?php
                include "cabecalho.php";
            ?>
		</header>
			<div class="conteudo-login">
                <form action="#" method="POST" border="1"  class="form-group form login" id="login">
                <h4>Área de Clientes</h4>    
                	<div class="form-group">
                        <label for="exampleInputEmail1">Endereço de email</label>
                        <input type="email" class="form-control" name="email" id="email" required aria-describedby="emailHelp" placeholder="Seu email">                       
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" required placeholder="Senha">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Lembrar dados de acesso.</label>
                    </div>
                    <button type="submit" class="btn btn-dark" value="login" id="salvar">Enviar</button>
                </form>			
			</div>		
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>
		<script type="text/javascript" src="../lib/jquery.validate.js"></script>
		<script type="text/javascript">
			$(function(){
			//executa quando clicar no botão Enviar
				$("#salvar").click(function(){
					//validar o formulário
					$("#login").validate({
						 rules : {									 
									 email:{
											required:true
									 },
									 senha:{
											required:true
											
									 }                                
							   },
							   messages:{								     
									 email:{
											required:"Informe o E-mail cadastrado"
									 },
									 senha:{
											required:"Digite uma Senha cadastrada"
											
									 }    
							   }	
					});
					});
			});
		</script>
	</body>
</html>
