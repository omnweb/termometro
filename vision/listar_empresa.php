<?php
	  require_once 'logged.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Listar Empresas"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Listar Empresas</title>  
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
		<?php
			require_once 'auto.php';
			$empresaDAO = new empresaDAO();
			$retorno = $empresaDAO->listarEmpresa();
			$status1 = "";
			$vzs = 1;
		?>
        <div class="container">
			<div class="row">
				<div class="col-12">
                    <div class="table-responsive conteudo-tabela">
            			<table table class="table table-bordered table-striped table-light table-hover  tablesorter" cellspacing="0" summary="Tabela de Empresas" id="tabcat">
            				<thead>
            					<tr>
									<th scope="col"></th>            						
            						<th scope="col">Empresa</th>
									<th scope="col">Status</th>
									<th scope="col">CNPJ</th>
									<th scope="col">Telefone</th>
									<th scope="col">Contato</th>                                       
            						<th scope="col">Alterar</th>
            						<th scope="col">Excluir</th>
            					</tr>                        
            				</thead>
            				<tbody>
            					<?php						
            					// mostrar registro em forma de tabela
            						if(isset($retorno)){
            							foreach($retorno as $dado){
            					?>
            							<?php
            								if ($dado->status_empresa == 1){
            									$status1 = "Ativo";
            								}
            								else{
            									$status1 = "Inativo";
            								}
            							?>
            							<?php
            							echo"<tr><th scope='row'>{$vzs}</th><td>{$dado->descritivo}</td><td>{$status1}</td><td>{$dado->cnpj}</td><td>{$dado->telefone}</td><td>{$dado->contato}</td>";
            							echo"<td><a href='cadastrar_empresa.php?oper=A&id={$dado->id_empresa}'><img src='../figuras/edit-page-blue.gif' title='Alterar'></a></td>";										
            							?>
            						 	&nbsp; &nbsp;<td><a href='cadastrar_empresa.php?oper=E&id=<?php echo $dado->id_empresa?>' onclick="return confirm('Deseja Excluir?')"><img src='../figuras/delete-page-blue.gif' title='Excluir'></a></td></th></tr>
            							<?php
            						    $vzs++;
            						}
            					}
            					else{						
            						echo 'Nenhuma Empresa encontrada.';
            					}
            					?>
            				</tbody> 
            			</table><br>
						<p><a href="cadastrar_empresa.php?oper=I" class="btn btn-dark">Cadastrar Empresa</a></p>
            		</div>
            	</div>
            </div>
        </div>	
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script type="text/javascript" src="../lib/jquery.tablesorter.js"></script>	
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