<?php header('Content-Type: text/html; iso-8859-1');?>
<?php
require_once "auto.php";
session_start();

//fim da conexão com o banco de dados
$id_empresa = $_SESSION['id_empresa'];
$campanha = $_POST['campanha'];

$pesquisaDAO = new pesquisaDAO();									
$retorno = $pesquisaDAO->pesquisaCampanha($campanha, $id_empresa);
		
?>
<section >    
    <?php
    $vzs = 1;
    
        ?>
        <div class="table-responsive">
        <table table class="table table-bordered table-light table-hover  tablesorter" cellspacing="0" summary="Tabela de Pesquisas" id="tabcat">
            <thead>
                <tr class="active">
                    <th scope="col"></th>
                    <th scope="col">Pesquisas</th>																		
                    <th scope="col">Atendimento</th>
                    <th scope="col">Espera</th>
                    <th scope="col">Ambiente</th>
                    <th scope="col">Qualidade</th>
                    <th scope="col">Média</th>
                    <th scope="col">Sim</th>
                    <th scope="col">Não</th>
                </tr>                        
            </thead>
            <tbody>										
                <?php 
                // mostrar registro em forma de tabela
                if($retorno){
                    			
                    foreach($retorno as $dado){
                        ?>
                        <?php 
                        if($dado-> media != null){

                            $sim = $dado->sim;
                            $sim = number_format($sim, 0, ',', '.');
                            $nao = $dado->nao;
                            $nao = number_format($nao, 0 , ',', '.');
                            if ($dado->media <= 2){
                                ?><tr class='table-red'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->pesquisas ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $dado->media ?></td><td><?php echo $sim.'%' ?></td><td><?php echo $nao.'%' ?></td></tr><?php
                            }
                            else if ($dado->media > 2 && $dado->media <= 4){
                                ?><tr class='table-red-2'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->pesquisas ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $dado->media ?></td><td><?php echo $sim.'%' ?></td><td><?php echo $nao.'%' ?></td></tr><?php
                            }
                            else if ($dado->media > 4 && $dado->media <= 6){
                                ?><tr class='table-orange'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->pesquisas ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $dado->media ?></td><td><?php echo $sim.'%' ?></td><td><?php echo $nao.'%' ?></td></tr><?php
                            }
                            else if ($dado->media > 6 && $dado->media <= 8){
                                ?><tr class='table-green'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->pesquisas ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $dado->media ?></td><td><?php echo $sim.'%' ?></td><td><?php echo $nao.'%' ?></td></tr><?php
                            }
                            else if ($dado->media > 8 && $dado->media <= 10){
                                ?><tr class='table-green-2'><th scope="row"><?php echo $vzs ?></th><td><?php echo $dado->pesquisas ?></td><td><?php echo $dado->atendimento ?></td><td><?php echo $dado->espera ?></td><td><?php echo $dado->ambiente ?></td><td><?php echo $dado->qualidade_produtos ?></td><td><?php echo $dado->media ?></td><td><?php echo $sim.'%' ?></td><td><?php echo $nao.'%' ?></td></tr><?php
                            }$vzs++; 
                        }else{
                             echo "<div class='alert alert-danger' role='alert'>
                             Sem resultados para exibir!
                           </div>";
                        }              
                    }
                
                ?>
            </tbody>
        </table>            
    </div>	
            </div><?php }?>
</section>