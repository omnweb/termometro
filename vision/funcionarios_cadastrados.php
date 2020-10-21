<?php
	  require_once 'logged.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Funcionários Cadastrados"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
		<title>Funcionários Cadastrados</title>  
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
            $empresa = new empresa($_SESSION['id_empresa']);
			$funcionarioDAO = new funcionarioDAO();
			$retorno = $funcionarioDAO->funcionarioEmpresa($empresa);
			$status1 = "";
			$vzs = 1;
		?>
        <div class="container">
			<div class="row">
				<div class="col-12">
                    <div class="table-responsive conteudo-tabela">
            			<table table class="table table-bordered table-striped table-light table-hover  tablesorter" cellspacing="0" summary="Tabela de Funcionarios" id="tabcat">
            				<thead>
            					<tr>
									<th scope="col"></th>            						
            						<th scope="col">Perfil</th>
									<th scope="col">Empresa</th>
									<th scope="col">Status</th>
									<th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Senha</th>                                         
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
            								if ($dado->status_funcionario == 1){
            									$status1 = "Ativo";
            								}
            								else{
            									$status1 = "Inativo";
            								}
            							?>
                                        <?php
                                        //carregar Perfis
                                        $perfil = new perfil($dado->id_perfil);								
                                        $perfilDAO = new perfilDAO();
                                        $ret = $perfilDAO->buscarUmPerfil($perfil);
                                        foreach($ret as $descritivo){
                                            $descritivo_perfil = $descritivo->descritivo;
                                        }
                                        
                                        //carregar Empresas
                                        $empresa = new empresa($dado->id_empresa);								
                                        $empresaDAO = new empresaDAO();
                                        $ret2 = $empresaDAO->buscarEmpresa($empresa);
                                        foreach($ret2 as $descritivo2){
                                            $descritivo_empresa = $descritivo2->descritivo;
                                        }
            							echo"<tr><th scope='row'>{$vzs}</th><td>{$descritivo_perfil}</td><td>{$descritivo_empresa}</td><td>{$status1}</td><td>{$dado->nome}</td><td>{$dado->email}</td><td>{$dado->senha}</td>";
            							echo"<td><a href='inserir_funcionario.php?oper=A&id={$dado->id_funcionario}'><img src='../figuras/edit-page-blue.gif' title='Alterar'></a></td>";										
            							?>
            						 	&nbsp; &nbsp;<td><a href='inserir_funcionario.php?oper=E&id=<?php echo $dado->id_funcionario?>' onclick="return confirm('Deseja Excluir?')"><img src='../figuras/delete-page-blue.gif' title='Excluir'></a></td></th></tr>
            							<?php
            						    $vzs++;
            						}
            					}
            					else{						
            						echo 'Nenhuma Funcionario encontrado.';
            					}
            					?>
            				</tbody> 
            			</table><br>
						<p><a href="inserir_funcionario.php?oper=I" class="btn btn-dark">Cadastrar Funciánario</a></p>
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