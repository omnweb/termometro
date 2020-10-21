<?php
require_once 'auto.php';
require_once 'logged.php';

	$id=0;
	$data=0;
	$atendimento="";
	$espera="";
	$ambiente="";
	$qualidade="";
	$item="";
	$observacao="";	
	$erro=0;
		
	if($_POST)
	{		
		if($_POST["customRange"]=="")
		{
			echo"<script>alert('Selecione uma nota para o Atendimento.')</script>";
			$erro++;
		}
		if($_POST["customRange2"]=="")
		{
			echo"<script>alert('Selecione uma nota para o Tempo de Espera.')</script>";
			$erro++;
		}
		if($_POST["customRange3"]=="")
		{
			echo"<script>alert('Selecione uma nota para nosso Ambiente.')</script>";
			$erro++;
		}
		if($_POST["customRange4"]=="")
		{
			echo"<script>alert('Selecione uma nota para os produtos que fornecemos.')</script>";
			$erro++;
		}		
		if (!isset($_POST['customRadioInline1']))
		{
			echo"<script>alert('Informe se faltou algum produto da sua lista')</script>";
			$erro++;
		}
		if($_POST["validationTextarea"]=="")
		{
			echo"<script>alert('Deixe sua observação.')</script>";
			$erro++;
		}	
				
		if($erro==0)
		{
			$id_campanha = $_SESSION["id_campanha"];
			date_default_timezone_set("America/Sao_Paulo");
			$data = date('Y-m-d');
			$atendimento = $_POST["customRange"];
			$espera = $_POST["customRange2"];
			$ambiente = $_POST["customRange3"];
			$qualidade = $_POST["customRange4"];
			$item = $_POST["customRadioInline1"];
			$observacao = $_POST["validationTextarea"];
			$pesquisa = new pesquisa(null, $id_campanha, $data, $atendimento, $espera, $ambiente, $qualidade, $item, $observacao);		
			// var_dump($pesquisa);
			$pesquisaDAO = new pesquisaDAO();
			$ret =$pesquisaDAO->cadastrarPesquisa($pesquisa);
		}
		else
		{
			echo"<script>alert('Erro ao inserir pesquisa')</script>";
		}		
}

?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Cadastro de Pesquisa"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Cadastro de Pesquisa</title> 
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
			<div class="conteudo-pesquisa">									
				<form action="#" method="POST" border="1"  class="form-pesquisa">
					<h1 class="text-pesquisa">Pesquisa de Satisfação</h1><br>
					<p class="text-pesquisa">Respenda as perguntas abaixo para entendermos como podemos melhorar.</p><br>					
					<h5>1) Qual seu nível de satisfação com nosso Atendimento?</h5>
					<div class="custom-control custom-radio custom-control-inline div-radio">					
						<fieldset class="radio-image-range">
							<label for="1" class="range-1">								
								<input type="radio" id="1" name="customRange" class="custom-control-input" value="1">
								<img src="../img/1.png" class="radio-img" alt="1" title="1">
							</label>
							<label for="2" class="range-2">								
								<input type="radio" id="2" name="customRange" class="custom-control-input" value="2">
								<img src="../img/2.png" class="radio-img" alt="2" title="2">
							</label>
							<label for="3" class="range-3">								
								<input type="radio" id="3" name="customRange" class="custom-control-input" value="3">
								<img src="../img/3.png" class="radio-img" alt="3" title="3">
							</label>
							<label for="4" class="range-4">								
								<input type="radio" id="4" name="customRange" class="custom-control-input" value="4">
								<img src="../img/4.png" class="radio-img" alt="4" title="4">
							</label>
							<label for="5" class="range-5">								
								<input type="radio" id="5" name="customRange" class="custom-control-input" value="5">
								<img src="../img/5.png" class="radio-img" alt="5" title="5">
							</label>
							<label for="6" class="range-6">								
								<input type="radio" id="6" name="customRange" class="custom-control-input" value="6">
								<img src="../img/6.png" class="radio-img" alt="6" title="6">
							</label>
							<label for="7" class="range-7">								
								<input type="radio" id="7" name="customRange" class="custom-control-input" value="7">
								<img src="../img/7.png" class="radio-img" alt="7" title="7">
							</label>
							<label for="8" class="range-8">								
								<input type="radio" id="8" name="customRange" class="custom-control-input" value="8">
								<img src="../img/8.png" class="radio-img" alt="8" title="8">
							</label>
							<label for="9" class="range-9">								
								<input type="radio" id="9" name="customRange" class="custom-control-input" value="9">
								<img src="../img/9.png" class="radio-img" alt="9" title="9">
							</label>
							<label for="10" class="range-10">								
								<input type="radio" id="10" name="customRange" class="custom-control-input" value="10">
								<img src="../img/10.png" class="radio-img" alt="10" title="10">
							</label>
						</fieldset>
					</div><br>					
					<h5>2) Qual seu nível de satisfação com o tempo de espera?</h5>
					<div class="custom-control custom-radio custom-control-inline div-radio">					
						<fieldset class="radio-image-range">
							<label for="e1" class="range-1">								
								<input type="radio" id="e1" name="customRange2" class="custom-control-input" value="1">
								<img src="../img/1.png" class="radio-img" alt="1" title="1">
							</label>
							<label for="e2" class="range-2">								
								<input type="radio" id="e2" name="customRange2" class="custom-control-input" value="2">
								<img src="../img/2.png" class="radio-img" alt="2" title="2">
							</label>
							<label for="e3" class="range-3">								
								<input type="radio" id="e3" name="customRange2" class="custom-control-input" value="3">
								<img src="../img/3.png" class="radio-img" alt="3" title="3">
							</label>
							<label for="e4" class="range-4">								
								<input type="radio" id="e4" name="customRange2" class="custom-control-input" value="4">
								<img src="../img/4.png" class="radio-img" alt="4" title="4">
							</label>
							<label for="e5" class="range-5">								
								<input type="radio" id="e5" name="customRange2" class="custom-control-input" value="5">
								<img src="../img/5.png" class="radio-img" alt="5" title="5">
							</label>
							<label for="e6" class="range-6">								
								<input type="radio" id="e6" name="customRange2" class="custom-control-input" value="6">
								<img src="../img/6.png" class="radio-img" alt="6" title="6">
							</label>
							<label for="e7" class="range-7">								
								<input type="radio" id="e7" name="customRange2" class="custom-control-input" value="7">
								<img src="../img/7.png" class="radio-img" alt="7" title="7">
							</label>
							<label for="e8" class="range-8">								
								<input type="radio" id="e8" name="customRange2" class="custom-control-input" value="8">
								<img src="../img/8.png" class="radio-img" alt="8" title="8">
							</label>
							<label for="e9" class="range-9">								
								<input type="radio" id="e9" name="customRange2" class="custom-control-input" value="9">
								<img src="../img/9.png" class="radio-img" alt="9" title="9">
							</label>
							<label for="e10" class="range-10">								
								<input type="radio" id="e10" name="customRange2" class="custom-control-input" value="10">
								<img src="../img/10.png" class="radio-img" alt="10" title="10">
							</label>
						</fieldset>
					</div><br>					
					<h5>3) Qual seu nível de satisfação com o ambiente do estabelecimento?</h5>
					<div class="custom-control custom-radio custom-control-inline div-radio">					
						<fieldset class="radio-image-range">
							<label for="am1" class="range-1">								
								<input type="radio" id="am1" name="customRange3" class="custom-control-input" value="1">
								<img src="../img/1.png" class="radio-img" alt="1" title="1">
							</label>
							<label for="am2" class="range-2">								
								<input type="radio" id="am2" name="customRange3" class="custom-control-input" value="2">
								<img src="../img/2.png" class="radio-img" alt="2" title="2">
							</label>
							<label for="am3" class="range-3">								
								<input type="radio" id="am3" name="customRange3" class="custom-control-input" value="3">
								<img src="../img/3.png" class="radio-img" alt="3" title="3">
							</label>
							<label for="am4" class="range-4">								
								<input type="radio" id="am4" name="customRange3" class="custom-control-input" value="4">
								<img src="../img/4.png" class="radio-img" alt="4" title="4">
							</label>
							<label for="am5" class="range-5">								
								<input type="radio" id="am5" name="customRange3" class="custom-control-input" value="5">
								<img src="../img/5.png" class="radio-img" alt="5" title="5">
							</label>
							<label for="am6" class="range-6">								
								<input type="radio" id="am6" name="customRange3" class="custom-control-input" value="6">
								<img src="../img/6.png" class="radio-img" alt="6" title="6">
							</label>
							<label for="am7" class="range-7">								
								<input type="radio" id="am7" name="customRange3" class="custom-control-input" value="7">
								<img src="../img/7.png" class="radio-img" alt="7" title="7">
							</label>
							<label for="am8" class="range-8">								
								<input type="radio" id="am8" name="customRange3" class="custom-control-input" value="8">
								<img src="../img/8.png" class="radio-img" alt="8" title="8">
							</label>
							<label for="am9" class="range-9">								
								<input type="radio" id="am9" name="customRange3" class="custom-control-input" value="9">
								<img src="../img/9.png" class="radio-img" alt="9" title="9">
							</label>
							<label for="am10" class="range-10">								
								<input type="radio" id="am10" name="customRange3" class="custom-control-input" value="10">
								<img src="../img/10.png" class="radio-img" alt="10" title="10">
							</label>
						</fieldset>
					</div><br>					
					<h5>4) Qual seu nível de satisfação com a qualidade dos produtos que oferecemos?</h5>
					<div class="custom-control custom-radio custom-control-inline div-radio">					
						<fieldset class="radio-image-range">
							<label for="q1" class="range-1">								
								<input type="radio" id="q1" name="customRange4" class="custom-control-input" value="1">
								<img src="../img/1.png" class="radio-img" alt="1" title="1">
							</label>
							<label for="q2" class="range-2">								
								<input type="radio" id="q2" name="customRange4" class="custom-control-input" value="2">
								<img src="../img/2.png" class="radio-img" alt="2" title="2">
							</label>
							<label for="q3" class="range-3">								
								<input type="radio" id="q3" name="customRange4" class="custom-control-input" value="3">
								<img src="../img/3.png" class="radio-img" alt="3" title="3">
							</label>
							<label for="q4" class="range-4">								
								<input type="radio" id="q4" name="customRange4" class="custom-control-input" value="4">
								<img src="../img/4.png" class="radio-img" alt="4" title="4">
							</label>
							<label for="q5" class="range-5">								
								<input type="radio" id="q5" name="customRange4" class="custom-control-input" value="5">
								<img src="../img/5.png" class="radio-img" alt="5" title="5">
							</label>
							<label for="q6" class="range-6">								
								<input type="radio" id="q6" name="customRange4" class="custom-control-input" value="6">
								<img src="../img/6.png" class="radio-img" alt="6" title="6">
							</label>
							<label for="q7" class="range-7">								
								<input type="radio" id="q7" name="customRange4" class="custom-control-input" value="7">
								<img src="../img/7.png" class="radio-img" alt="7" title="7">
							</label>
							<label for="q8" class="range-8">								
								<input type="radio" id="q8" name="customRange4" class="custom-control-input" value="8">
								<img src="../img/8.png" class="radio-img" alt="8" title="8">
							</label>
							<label for="q9" class="range-9">								
								<input type="radio" id="q9" name="customRange4" class="custom-control-input" value="9">
								<img src="../img/9.png" class="radio-img" alt="9" title="9">
							</label>
							<label for="q10" class="range-10">								
								<input type="radio" id="q10" name="customRange4" class="custom-control-input" value="10">
								<img src="../img/10.png" class="radio-img" alt="10" title="10">
							</label>
						</fieldset>
					</div>					
					<h5>5) Encontrou todos os produtos que estava procurando?</h5>				
					<div class="custom-control custom-radio custom-control-inline div-radio">					
						<fieldset class="radio-image">
							<label for="sim" class="label-1">								
								<input type="radio" id="sim" name="customRadioInline1" class="custom-control-input" value="1">
								<img src="../img/like.png" alt="Sim" title="Sim">
							</label>
							<label for="nao" class="label-2">								
								<input type="radio" id="nao" name="customRadioInline1" class="custom-control-input" value="2">
								<img src="../img/dont-like.png"  alt="Não" title="Não">
							</label>
						</fieldset>
					</div>
					<h5>6) Deseja deixar uma observação.</h5>
					<div class="mb-3">
						<label for="validationTextarea"></label>
						<textarea class="form-control" id="validationTextarea" name="validationTextarea" placeholder="Deixe sua mensagem" required></textarea>
					</div><br>
					<button class="btn btn-dark" type="submit">Enviar</button>
				</form>			
				</div>										
			</section>
		</article>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>
	</body>
</html>