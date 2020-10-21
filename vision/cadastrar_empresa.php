<?php
require_once 'auto.php';
require_once 'logged.php';
	$id=0;
	$status="";
	$descritivo="";
	$cnpj="";
	$telefone="";
	$contato="";
	$oper="";
	
	if($_GET)
	{
		$oper = $_GET["oper"];		
		if($oper != "I")
		{			
			$id = (int)$_GET["id"];			
			if($oper == "A")
			{
				$empresa = new empresa($id);
				$empresaDAO = new empresaDAO();
				$retorno = $empresaDAO->buscarEmpresa($empresa);
				$status=$retorno[0]->status_empresa;
				$descritivo=$retorno[0]->descritivo;
				$cnpj=$retorno[0]->cnpj;
				$telefone=$retorno[0]->telefone;	
				$contato=$retorno[0]->contato;									
			}
		}
		if($oper == "E")
		{
			//Excluir
			$empresa = new empresa($id);
			$empresaDAO = new empresaDAO();
			$empresaDAO->excluir($empresa);
			header("location:listar_empresa.php");
		}
	}
	$erro=0;
	if($_POST)
	{
		if($_POST["status_empresa"]=="")
		{
			echo"<script>alert('Selecione o status da Empresa')</script>";
			$erro++;
		}
		if($_POST["descritivo"]=="")
		{
			echo"<script>alert('Preencha o nome da Empresa')</script>";
			$erro++;
		}
		if($_POST["cnpj"]=="")
		{
			echo"<script>alert('Preencha o CNPJ da Empresa')</script>";
			$erro++;
		}
		if($_POST["telefone"]=="")
		{
			echo"<script>alert('Preencha o telefone da Empresa')</script>";
			$erro++;
		}
		if($_POST["contato"]=="")
		{
			echo"<script>alert('Preencha o nome do contato na empresa.')</script>";
			$erro++;
		}
		if($erro==0)
		{
			switch ($oper)
			{
                case "I":
					//inserir no banco
					
					$status= $_POST["status_empresa"];
					$descritivo= $_POST["descritivo"];
					$cnpj= $_POST["cnpj"];
					$telefone= $_POST["telefone"];
					$contato= $_POST["contato"];
					$empresa = new empresa($id, $status, $descritivo, $cnpj, $telefone, $contato);
					// var_dump($empresa);
					$empresaDAO = new empresaDAO();
					$ret = $empresaDAO->cadastrarEmpresa($empresa);
					
				break;
                case "A":
                    //Alterar no BD	
					$empresa = new empresa($id, $_POST["status_empresa"], $_POST["descritivo"], $_POST["cnpj"], $_POST["telefone"], $_POST["contato"]);
                    $empresaDAO = new empresaDAO();
					//var_dump($empresa);
					$empresaDAO->alterar($empresa);
                break;
            }
			 header("location:listar_empresa.php");
		}
		else
		{
			echo"<script>alert('Erro ao inserir Empresa')</script>";
		}
	}
	
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Cadastro de Empresas"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Cadastro de Empresas</title>    
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
			<div class="conteudo-form">										
						<form action="#" method="POST" id="cadastro_empresa" class="form-empresa ">
							<h1>Cadastro de Empresa</h1><br/>
							<div class="row">
    							<div class="col-12">		
									<label for="status">Status:</label>	
									<select name="status_empresa" class="form-control" id="status">
										<?php 
										if($status == "")
										{
										
										echo"<option value=''>Selecione</option>
										<option value='1'>Ativo</option>
										<option value='2'>Inativo</option>	";
										}	
										else if($status == '1')
										{
										echo"<option value='1' selected>Ativo</option>
										<option value='2'>Inativo</option>	";
										}
										else if($status == '2')
										{
										echo"<option value='1' >Ativo</option>
										<option value='2' selected>Inativo</option>	";
										}
										?>						
									</select>
									<br/>
								</div>					    					
							</div>
							<div class="row">
								<div class="col">				
									<label for="nome">Nome da empresa:</label>					
									<input class="form-control" type="text" name="descritivo" id="descritivo" value="<?php echo $descritivo; ?>"><br/>						    					
								</div>		
							</div>
							<div class="row">
								<div class="col">				
									<label for="nome">CNPJ da Empresa:</label>					
									<input class="form-control" type="text" name="cnpj" id="cnpj" value="<?php echo $cnpj; ?>"><br/>						    					
								</div>		
							</div>
							<div class="row">
								<div class="col">				
									<label for="email">Telefone da Empresa:</label>					
									<input class="form-control" type="tel" name="telefone" id="telefone" value="<?php echo $telefone; ?>"><br/>					    					
								</div>		
							</div>
							<div class="row">
								<div class="col">				
									<label for="senha">Contato na Empresa:</label>					
									<input class="form-control" type="text" name="contato" id="contato" value="<?php echo $contato; ?>"><br/><br/>
								</div>		
							</div>
							<a href="cadastro.usuario.php" ><input type="submit" value="Cadastrar" role="button" class="btn btn-dark enviar" id="salvar"/></a>
							<a href="listar_empresa.php" ><input type="cancel" value="Cancelar" role="button" class="btn btn-dark enviar" /></a>							
							</div>	
						</div>
					</form>						
				</div>			
			</section>
		</article>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>
		<script type="text/javascript" src="../lib/jquery.validate.js"></script>
		<script type="text/javascript">
			$(function(){
			//executa quando clicar no botão Enviar
				$("#salvar").click(function(){
					//validar o formulário
					$("#cadastro_empresa").validate({
						 rules : {
									status_user:{
											required:true											
									 },
									 descritivo:{
											required:true
											
									 },
									 cnpj:{
											required:true
											
									 },
									 telefone:{
											required:true
									 },
									 contato:{
											required:true
											
									 }                                
							   },
							   messages:{
								     status_user:{
											required:"Selecione o status da Empresa"
											
									 },
									 descritivo:{
											required:"Informe o Nome da Empresa"
									 },
									 cnpj:{
											required:"Informe o Nome do Usuário"
									 },
									 telefone:{
											required:"Informe o email, ex: meu-email@provedor.com.br"
									 },
									 contato:{
											required:"Digite uma senha"
											
									 }    
							   }	
					});
					});
			});
		</script>
	</body>
</html>