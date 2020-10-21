<?php
	require_once 'verify.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>		
        <meta name="description" content="Termômetro do Cliente"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>	
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8"/>
        <title>Termômetro do Cliente</title>    
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
        <div class="conteudo">
            <div class="banner">
                <div class="page-header" >
                    <h3>Seja bem vindo(a)!</h3>
                    <h5>Esse é o Termômetro da sua empresa.</h5>
                </div>											
                <div class="bannerImage">
                    <a href="login.php"><img src="../img/pesquisaSatisfacao.png"  alt="Imagem lupa" class='img-banner'/></a>
                </div>
                <div class="caption row-fluid">
                    <div class="span3">
                        <h3>Acesse a conta da sua empresa para responder à pesquisa</h3>                                                
                    </div>               	
                    <div class="span4">
                        <p> Clique na <strong>imagem acima</strong> ou em <strong>entrar</strong> no menu superior.</p>
                    </div>
                </div>
           </div>                       
        </div>      
	</body>	
</html>
