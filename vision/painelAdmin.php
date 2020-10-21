<?php
	  require_once 'logged.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Painel Admin"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Painel Admin</title>    
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
			<div class="row">
				<div class="col-12"><br/>
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="media-pesquisa-tab" data-toggle="tab" href="#media-pesquisa" role="tab" aria-controls="media-pesquisa" aria-selected="true">Média por Pesquisa</a>						
						<a class="nav-item nav-link" id="media-data-tab" data-toggle="tab" href="#media-data" role="tab" aria-controls="media-data" aria-selected="false">Média por Data</a>
						<a class="nav-item nav-link" id="media-campanha-tab" data-toggle="tab" href="#media-campanha" role="tab" aria-controls="media-campanha" aria-selected="false">Média por Campanha</a>						
						</div>
					</nav>
					<div class="tab-content py-3 px-3 px-sm-0"  id="nav-tabContent">
					
						<div class="tab-pane fade show active conteudo-painel" id="media-pesquisa" role="tabpanel" aria-labelledby="media-pesquisa-tab">
							<?php
								//buscar os registros no banco de dados
								require_once'auto.php';
								$id_empresa = $_SESSION['id_empresa'];								
								// var_dump($_SESSION['descritivo_campanha']);
								$pesquisaDAO = new pesquisaDAO();									
								$retorno = $pesquisaDAO->buscarPesquisa($id_empresa);
								$vzs = 1;	
								// $status1 = "";
								$item = "";			
							?>	
							<div class="table-responsive">
							<!-- <h2>Média por atendimento</h2><br/>							 -->
							<table table class="table table-bordered table-light table-hover  tablesorter" cellspacing="0" summary="Tabela de Pesquisas" id="tabcat">
									<thead>
										<tr class="active">
											<th scope="col"></th>
											<th scope="col">Campanha</th>
											<th scope="col">Data</th>																		
											<th scope="col">Atendimento</th>
											<th scope="col">Espera</th>
											<th scope="col">Ambiente</th>
											<th scope="col">Qualidade</th>
											<th scope="col">Encontrou?</th>
											<th scope="col">Observação</th>
											<th scope="col">Média</th>														
										</tr>                        
									</thead>
									<tbody>										
										<?php  
										// mostrar registro em forma de tabela
										if(($retorno)){									
											foreach($retorno as $dado){
												
												if ($dado->item == 1){
													$item = "Sim";											
												}
												else{
													$item = "Não";
												}														
													
												?>
												<?php 
												if($dado->media != null){
													
													if ($dado->media <= 2){
														?><tr class='table-red'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->descritivo ?></td><td><?php echo $dado->data ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $item ?></td><td><?php echo $dado->observacao ?></td><td><?php echo $dado->media ?></td></tr><?php
													}
													else if ($dado->media > 2 && $dado->media <= 4){
														?><tr class='table-red-2'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->descritivo ?></td><td><?php echo $dado->data ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $item ?></td><td><?php echo $dado->observacao ?></td><td><?php echo $dado->media ?></td></tr><?php
													}
													else if ($dado->media > 4 && $dado->media <= 6){
														?><tr class='table-orange'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->descritivo ?></td><td><?php echo $dado->data ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $item ?></td><td><?php echo $dado->observacao ?></td><td><?php echo $dado->media ?></td></tr><?php
													}
													else if ($dado->media > 6 && $dado->media <= 8){
														?><tr class='table-green'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->descritivo ?></td><td><?php echo $dado->data ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $item ?></td><td><?php echo $dado->observacao ?></td><td><?php echo $dado->media ?></td></tr><?php
													}
													else if ($dado->media > 8 && $dado->media <= 10){
														?><tr class='table-green-2'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->descritivo ?></td><td><?php echo $dado->data ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $item ?></td><td><?php echo $dado->observacao ?></td><td><?php echo $dado->media ?></td></tr><?php
													}$vzs++;
												}							
											}
											
										}else{
											echo "<div class='alert alert-danger' role='alert'>
											Sem resultados para exibir!
										  </div>";
									   }          
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade conteudo-painel" id="media-data" role="tabpanel" aria-labelledby="media-data-tab">
							<div class="input-group painel-data">
								<fieldset>
									<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
										<label for="data_pesquisa"> Data inicial<input type="date" class="form-control" id="data_pesquisa"></label>
									</div>
								</fieldset>											
								<fieldset>	
									<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
										<label for="data_pesquisa"> Data Final<input type="date" class="form-control" id="data_pesquisa2"></label>
									</div> <br/>	
								</fieldset>	
								<fieldset class="data-button">									
									<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
										<span class="input-group-btn">
											<button class="btn btn-dark" id="buscar" type="button">Buscar</button>
										</span>
									</div>
								</fieldset>
							</div> <br>
							<div id="dados">Aqui será inserindo o resultado da consulta...</div>
						</div>
						<div class="tab-pane fade conteudo-painel" id="media-campanha" role="tabpanel" aria-labelledby="media-campanha-tab">
							<div class="input-group painel-categoria">
								<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
									<label for="campanha">Campanha:</label>	
										<select name="Campanha" class="form-control" id="campanha">                                        
											<option value=''>Selecione</option>
											<?php
												//carregar Campanha	
												$empresa = new funcionario($_SESSION['id_empresa']);							
												$campanhaDAO = new campanhaDAO();
												$ret = $campanhaDAO->campanhaEmpresa($empresa);
												foreach($ret as $dado)
												{ 
													echo"<option value='{$dado->id_campanha}'>{$dado->descritivo}</option>";
												}
											?>	
										</select>
								</div> <br/>
								<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 campanha-button">
										<span class="input-group-btn campanha-button">
											<button class="btn btn-dark" id="listar" type="button">Buscar</button>
										</span>
								</div>
							</div> <br>
								<div id="dados-campanha">Aqui será inserindo o resultado da consulta...</div>
							</div>
						</div> <!-- Fim media-campanha-->
					</div>
					<br/>
				</div>
			</div>
		</div>						
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script type="text/javascript" src="../lib/jquery.tablesorter.js"></script>	
		<script>
		function listar(campanha)
            {
                //O método $.ajax(); é o responsável pela requisição
                $.ajax
                        ({
                            //Configurações
                            type: 'POST',//Método que está sendo utilizado.
                            dataType: 'html',//É o tipo de dado que a página vai retornar.
                            url: 'lista.php',//Indica a página que está sendo solicitada.
                            //função que vai ser executada assim que a requisição for enviada
                            beforeSend: function () {
                                $("#dados-campanha").html("Carregando...");
                            },
                            data: {campanha: campanha}, //Dados para consulta
                            //função que será executada quando a solicitação for finalizada.
                            success: function (msg)
                            {
                                $("#dados-campanha").html(msg);
                            }
                        });
            }
            
            
            $('#listar').click(function () {
                listar($("#campanha").val())
            });

            function buscar(data_pesquisa, data_pesquisa2)
            {
                //O método $.ajax(); é o responsável pela requisição
                $.ajax
                        ({
                            //Configurações
                            type: 'POST',//Método que está sendo utilizado.
                            dataType: 'html',//É o tipo de dado que a página vai retornar.
                            url: 'busca.php',//Indica a página que está sendo solicitada.
                            //função que vai ser executada assim que a requisição for enviada
                            beforeSend: function () {
                                $("#dados").html("Carregando...");
                            },
                            data: {data_pesquisa: data_pesquisa, data_pesquisa2: data_pesquisa2}, //Dados para consulta
                            //função que será executada quando a solicitação for finalizada.
                            success: function (msg)
                            {
                                $("#dados").html(msg);
                            }
                        });
            }
            
            
            $('#buscar').click(function () {
                buscar($("#data_pesquisa").val(), $("#data_pesquisa2").val())
            });
        </script>
		<script type="text/javascript" id="js">
		$(document).ready(function()
		{ 
			// extend the default setting to always include the zebra widget. 
			$.tablesorter.defaults.widgets = ['zebra']; 
			// extend the default setting to always sort on the first column 
			$.tablesorter.defaults.sortList = [[0,0]]; 
			// call the tablesorter plugin 
			$("table").tablesorter(); 
			$("#tabcat tbody tr").quicksearch({
				labelText: 'Pesquisar: ',
				attached: '#tabcat',
				position: 'before',
				delay: 100,
				loaderText: 'Loading...',
				onAfter: function() {
					if ($("#tabcat tbody tr:visible").length != 0) {
						$("#tabcat").trigger("update");
						$("#tabcat").trigger("appendCache");
						$("#tabcat tfoot tr").hide();
					}
					
				}
			});
		});
		</script>
	</body>
</html>