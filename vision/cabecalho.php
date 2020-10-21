<!-- Cabeçalho-->
	
<nav class="navbar navbar-expand-xl navbar-light bg-light" role="navigation"> 
  <a class="navbar-brand" href="pesquisa.php"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>        
  </button>
  <div class="collapse navbar-collapse" id="navbarSite">  
        <?php							  
            require_once "auto.php";
            if(!isset($_SESSION))
            {										
                session_start(); 
            }									
            if(isset($_SESSION["id_perfil"]))
            {	
                echo"<ul class='navbar-nav mr-auto'>";
                echo "<li class='nav-item active'><a href='pesquisa.php' class='navbar-brand'><img src='https://www.tdp.com.br/wp-content/uploads/2019/09/logo_tdp_165.png' width='auto' height='30'alt='' ></a></li>";
                foreach($_SESSION["menu"] as $dado)
                {
                    echo"<ul class='navbar-nav mr-auto'>";
                    echo"<li class='nav-item'><a href='{$dado->link}' class='nav-link'><strong>{$dado->nome}</strong></a></li>";
                    echo"</ul>";
                }	
                
                echo"</ul>";                
                echo "<div class='dropdown'>";
                echo"<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Olá <strong>{$_SESSION["nome_funcionario"]}</strong></button>";
                echo "<div class='dropdown-menu' aria-labelledby'dropdownMenuButton'>";
                    echo "<a href='#' class='nav-link'><strong>{$_SESSION["descritivo_empresa"]}</strong></a>";
                    echo "<a href='#' class='nav-link'>Campanha: {$_SESSION["descritivo_campanha"]}</a>";
                    echo"<div class='dropdown-divider'></div>";
                    echo "<a href='sair.php' class='nav-link'> <i class='fa fa-sign-out' aria-hidden='true'></i> <strong>Sair</strong></a>";
                echo"</div>";
                echo"</div>";
                echo"</ul>";                               
               				
            }
            else
            {	
                echo"<ul class='navbar-nav mr-auto'>";	
                echo "<li class='nav-item'><a href='pesquisa.php' class='nav-link'><img src='https://www.tdp.com.br/wp-content/uploads/2019/09/logo_tdp_165.png' width='auto' height='30' alt='' ></a></li>";	
                echo"</ul>";
                echo"<ul class='navbar-nav ml-auto'>";	
                echo "<li class='nav-item d-flex justify-content-end'><a href='login.php' class='nav-link'> <i class='fa fa-sign-in ' aria-hidden='true'></i></i> <strong>Entrar</strong></a></li>";
                echo"</ul>";	                
            }		
        ?> 
  </div> 
</nav>