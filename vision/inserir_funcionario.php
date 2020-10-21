<?php
require_once 'auto.php';
require_once 'logged.php';
	$id=0;
    $id_perfil="";
    $id_empresa="";
	$status="";
	$nome="";
	$email="";
	$senha="";
	$oper="";
	
	if($_GET)
	{
		$oper = $_GET["oper"];		
		if($oper != "I")
		{			
			$id = (int)$_GET["id"];			
			if($oper == "A")
			{
				$funcionario = new funcionario($id);
				$funcionarioDAO = new funcionarioDAO();
				$retorno = $funcionarioDAO->buscarFuncionario($funcionario);                
                $id_perfil=$retorno[0]->id_perfil;
                $id_empresa=$retorno[0]->id_empresa;
                $status=$retorno[0]->status_funcionario;
				$nome=$retorno[0]->nome;
				$email=$retorno[0]->email;
				$senha=$retorno[0]->senha;
			}
		}
		if($oper == "E")
		{
			//Excluir
			$funcionario = new funcionario($id);
			$funcionarioDAO = new funcionarioDAO();
			$funcionarioDAO->excluir($funcionario);
			header("location:funcionarios_cadastrados.php");
		}
	}
	$erro=0;
	if($_POST)
	{
		if($_POST["perfil"]=="")
		{
			echo"<script>alert('Selecione o Perfil de uso do funcionário')</script>";
			$erro++;
		}
		if($_POST["status"]=="")
		{
			echo"<script>alert('Selecione um status para o funcionário')</script>";
			$erro++;
		}
		if($_POST["email"]=="")
		{
			echo"<script>alert('Preencha o email de acesso do funcionário')</script>";
			$erro++;
		}
		if($_POST["senha"]=="")
		{
			echo"<script>alert('Preencha a senha de acesso do funcionário.')</script>";
			$erro++;
		}
		if($erro==0)
		{
			switch ($oper)
			{
                case "I":
					//inserir no banco
                    
                    $id_perfil=$_POST["perfil"];
                    $id_empresa=$_SESSION["id_empresa"];
					$status= $_POST["status"];
					$nome= $_POST["nome"];
					$email= $_POST["email"];
					$senha= $_POST["senha"];					
					$funcionario = new funcionario(null, $id_perfil, $id_empresa, $status, $nome, $email, $senha);
					//var_dump($funcionario);
					$funcionarioDAO = new funcionarioDAO();
					$ret = $funcionarioDAO->cadastrarFuncionario($funcionario);
					
				break;
                case "A":
                    //Alterar no BD	
					$funcionario = new funcionario($id, $_POST["perfil"], $id_empresa, $_POST["status"], $_POST["nome"], $_POST["email"], $_POST["senha"]);
				    // var_dump($funcionario);
					$funcionarioDAO = new funcionarioDAO();
					$funcionarioDAO->alterar($funcionario);					
                break;
            }
			header("location:funcionarios_cadastrados.php");
		}
		else
		{
			echo"<script>alert('Erro ao inserir Funcionario')</script>";
		}
	}
	
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Cadastro Funcionários Empresa"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Cadastro Funcionários Empresa</title> 
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
						<form action="#" method="POST" id="cadastro_funcionario" class="form-funcionario">
							<h1>Cadastro de Funcionário</h1>
							<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">	                                    <label for="perfil">Perfil:</label>	
                                    <select name="perfil" class="form-control" id="perfil">
                                        <?php
											if($oper == "I")
											{
												echo"<option value=''>Selecione</option>";
											}
                                            //carregar Perfis								
                                            $perfilDAO = new perfilDAO();
                                            $ret = $perfilDAO->perfilEmpresa();
                                            foreach($ret as $dado)
											{ 
												if($oper == "A" && $dado->id_perfil == $id_perfil){
													echo"<option value='{$dado->id_perfil}' selected>{$dado->descritivo}</option>";
												}else{
													echo"<option value='{$dado->id_perfil}'>{$dado->descritivo}</option>";
												}
											}
                                        ?>	
                                    </select>
                                </div>    
								<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">	                                    <label for="perfil">Perfil:</label>	
									<label for="status">Status:</label>	
									<select name="status" class="form-control" id="status">
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
									<label for="nome">Nome do funcionário:</label>					
									<input class="form-control" type="text" name="nome" id="nome" value="<?php echo $nome; ?>"><br/>						    					
								</div>		
							</div>
							<div class="row">
								<div class="col-8">				
									<label for="email">E-Mail</label>					
									<input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>"><br/>						    					
								</div>
								<div class="col-4">				
									<label for="senha">Senha:</label>					
									<input class="form-control" type="tel" name="senha" id="senha" value="<?php echo $senha; ?>"><br/>					    					
								</div>		
							</div>
							<a href="inserir_funcionario.php" ><input type="submit" value="Cadastrar" role="button" class="btn btn-dark enviar" id="salvar"/></a>
							<a href="funcionarios_cadastrados.php" ><input type="cancel" value="Cancelar" role="button" class="btn btn-dark enviar" /></a>							
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
					$("#cadastro_funcionario").validate({
						 rules : {
									perfil:{
											required:true
											
									 },
									 status:{
											required:true
											
									 },
									 nome:{
											required:true
									 },
									 email:{
											required:true
											
									 },
									 senha:{
											required:true
											
									 }                                
							   },
							   messages:{
								     perfil:{
											required:"Selecione o perfil."
									 },
									 status:{
											required:"Selecione o Status."
									 },
									 nome:{
											required:"Digite o nome do funcionário."
									 },
									 email:{
											required:"Digite um email"
											
									 },
									 senha:{
											required:"Digite uma senha"
											
									 }    
							   }	
					});
					});
			});
		</script>
	</body>
</html>