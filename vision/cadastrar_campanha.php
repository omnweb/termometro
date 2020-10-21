<?php
require_once 'auto.php';
require_once 'logged.php';
	$id=0;
	$id_empresa="";
    $id_funcionario="";    
	$status="";
	$descritivo="";
	$oper="";
	
	if($_GET)
	{
		$oper = $_GET["oper"];		
		if($oper != "I")
		{
			$id = (int)$_GET["id"];			
			if($oper == "A")
			{
				$campanha = new campanha($id);
				$campanhaDAO = new campanhaDAO();
				$retorno = $campanhaDAO->buscarCampanha($campanha);                
                $id_empresa=$retorno[0]->id_empresa;
                $id_funcionario=$retorno[0]->id_funcionario;
                $status=$retorno[0]->status_campanha;
				$descritivo=$retorno[0]->descritivo;
			}
		}
		if($oper == "E")
		{
			//Excluir
			$campanha = new campanha($id);
			$campanhaDAO = new campanhaDAO();
			$campanhaDAO->excluir($campanha);
			header("location:listar_campanha.php");
		}
	}
	$erro=0;
	if($_POST)
	{
		if($_POST["funcionario"]=="")
		{
			echo"<script>alert('Selecione um funcionário para a campanha.')</script>";
			$erro++;
		}
		if($_POST["status"]=="")
		{
			echo"<script>alert('Selecione um status para a campanha.')</script>";
			$erro++;
		}
		if($_POST["descritivo"]=="")
		{
			echo"<script>alert('Selecione um nome para a campanha')</script>";
			$erro++;
		}
		if($erro==0)
		{
			switch ($oper)
			{
                case "I":
					//inserir no banco
                    
                    
                    $id_funcionario=$_POST["funcionario"];
					$status= $_POST["status"];
					$descritivo= $_POST["descritivo"];				
					$campanha = new campanha(null, $_SESSION["id_empresa"], $id_funcionario, $status, $descritivo);
					// var_dump($campanha);
					$campanhaDAO = new campanhaDAO();
					$ret = $campanhaDAO->cadastrarCampanha($campanha);
					
				break;
                case "A":
                    //Alterar no BD	
					$campanha = new campanha($id, $_SESSION["id_empresa"], $_POST["funcionario"], $_POST["status"], $_POST["descritivo"]);
                    $campanhaDAO = new campanhaDAO();
					$campanhaDAO->alterar($campanha);					
                break;
            }
			header("location:listar_campanha.php");
		}
		else
		{
			echo"<script>alert('Erro ao inserir Campanha')</script>";
		}
	}
	
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Cadastro de Campanha"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Cadastro de Campanha</title> 
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
						<form action="#" method="POST" id="cadastro_campanha" class="form-campanha">
							<h1>Cadastro de Campanha</h1><br/>
							<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">	                                    <label for="perfil">Perfil:</label>	
                                    <label for="funcionario">Funcionário:</label>	
                                    <select name="funcionario" class="form-control" id="funcionario">
                                        <?php
											if($oper == "I")
											{
												echo"<option value=''>Selecione</option>";
											}
											//carregar funcionario
											
											$empresa = new funcionario($_SESSION['id_empresa']);								
                                            $funcionarioDAO = new funcionarioDAO();
                                            $ret = $funcionarioDAO->funcionarioEmpresa($empresa);
                                            foreach($ret as $dado)
											{ 
												if($oper == "A" && $dado->id_funcionario == $id_funcionario){
													echo"<option value='{$dado->id_funcionario}' selected> {$dado->nome} </option>";
												}else{
													echo"<option value='{$dado->id_funcionario}'> {$dado->nome} </option>";
												}
											}
                                        ?>	
                                    </select>
                                </div>    
								<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">	                                    <label for="perfil">Perfil:</label>	
									<label for="status">Status da Campanha:</label>	
									<select name="status" class="form-control" id="status">
										<?php 
										if($status == "")
										{
										
										echo"<option value=''>Selecione</option>
										<option value='1'>Ativa</option>
										<option value='2'>Inativa</option>	";
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
									<label for="descritivo">Nome da Campanha:</label>					
									<input class="form-control" type="text" name="descritivo" id="descritivo" value="<?php echo $descritivo; ?>"><br/>						    					
								</div>		
							</div>
							<a href="cadastrar_campanha.php" ><input type="submit" value="Cadastrar" role="button" class="btn btn-dark enviar" id="salvar"/></a>
							<a href="listar_campanha.php" ><input type="cancel" value="Cancelar" role="button" class="btn btn-dark enviar" /></a>							
						
				</form>						
			</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>
		<script type="text/javascript" src="../lib/jquery.validate.js"></script>
		<script type="text/javascript">
			$(function(){
			//executa quando clicar no botão Enviar
				$("#salvar").click(function(){
					//validar o formulário
					$("#cadastro_campanha").validate({
						 rules : {
									funcionario:{
											required:true
											
									 },
									 status:{
											required:true
											
									 },
									 descritivo:{
											required:true
									 }                               
							   },
							   messages:{
								     funcionario:{
											required:"Selecione um funcionário"
									 },
									 status:{
											required:"Selecione o status"
									 },
									 descritivo:{
											required:"Informe o nome da campanha"
									 }   
							   }	
					});
					});
			});
		</script>
	</body>
</html>