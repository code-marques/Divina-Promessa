<?php      
  error_reporting(0);
  ob_start("ob_gzhandler");
  require './system/config.php';
  require './system/conn.php';  
  require './system/minify.php'; 
  
  // Default
  $str = file_get_contents('css/default.css');
  if(is_mini($str)) { } else { file_put_contents('css/default.css', minify_css($str)); }

  // responsive
  $str = file_get_contents('css/responsive.css');
  if(is_mini($str)) { } else { file_put_contents('css/responsive.css', minify_css($str)); } 
    
?>


<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, maximum-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<title>Home</title>
  	<link rel="icon" href="./ico/favicon.ico" type="image/x-icon" />    
  	<link rel="stylesheet" type="text/css" href="./css/default.css">
  	<link rel="stylesheet" type="text/css" href="./css/responsive.css" media="screen and (max-width: 1024px)">    
  </head>
  <body>

  <script type="text/javascript">
    var holder = null;
    var s = 3;
    var t = 7;
    var vezes = 400;

    document.addEventListener("DOMContentLoaded", function(){
      holder = document.getElementById('holder-banner');
      rolar();
    });

    function rolar() {

      for(var total=0; total<=vezes; total++) {
        setTimeout(function(){
          for(var i=1; i<=s; i++) {
            tempo(i);
          }
        }, ((s*t)*1000)*(total));   
      } 
    }

    function tempo(banner) {
      setTimeout(function() {
        if(banner == 1) { holder.style = "transform: translateX(0%);"; } 
        else if(banner == 2) { holder.style = "transform: translateX(-33.33%);"; } 
        else { holder.style = "transform: translateX(-66.66%);"; }          
      }, (t*1000)*(banner));
    }
  </script>

  <script type="text/javascript">
    var darken = null;
    var hidden = null;

    document.addEventListener("DOMContentLoaded", function(){
      darken = document.getElementById('darken');
      hidden = document.getElementById('hidden-menu');
    });

    function abrir(){   
      darken.style = "display: flex";
      darken.style.display = "flex";
      hidden.style = "display: flex";
      hidden.style.display = "flex";  
    }

    function fechar(){
      darken.style = "display: none";
      darken.style.display = "none";
      hidden.style = "display: none";
      hidden.style.display = "none";
    }
  </script>

  <div id="darken"></div>  
  <div id="hidden-menu" onclick="fechar();">    
    <div class="height-full">
      <a href="./cultos.php"><p align="center">Cultos</p><div class="hidden-link"><img src="./ico/bible.png" alt="#" /></div></a>
      <a href="./ensinamentos.php"><p align="center">Ensinos</p><div class="hidden-link"><img src="./ico/ensino.png" alt="#" /></div></a>
      <a href="./agenda.php"><p align="center">Agenda</p><div class="hidden-link"><img src="./ico/agenda.png" alt="#" /></div></a>      
    </div>

    <div class="height-full">
      <a href="./sobre.php"><p align="center">Sobre nós</p><div class="hidden-link"><img src="./ico/question.png" alt="#" width="90px" height="90px" /></div></a>
      <a href="./ministerios.php"><p align="center">Ministérios</p><div class="hidden-link"><img src="./ico/ministerio.png" alt="#" /></div></a>
      <a href="./contato.php"><p align="center">Contato</p><div class="hidden-link"><img src="./ico/contato.png" alt="#" /></div></a>      
    </div>
    
  </div>

    <!-- Header -->
    <div id="full-default-header">
      <div id="header-holder">

        <div id="logo-header">

          <a href="./index.php"><img src="./img/logo.png" alt="logo da igreja envangélica pentecostal" /></a>
          <a href="./index.php"><h1>Divina<br /> Promessa</h1></a>

        </div>

        <div id="links-header">          

          <div class="link">
            <a href="./cultos.php">Cultos</a>
          </div>

          <div class="link">
            <a href="./ensinamentos.php">Ensinos</a>
          </div>

          <div class="link">
            <a href="./agenda.php">Agenda</a>
          </div>

          <div class="link">
            <a href="./sobre.php">Sobre</a>
          </div>

          <div class="link">
            <a href="./ministerios.php">Ministérios</a>
          </div>

          <div class="link">
            <a href="./contato.php">Contato</a>
          </div>

        </div>
        <div id="links-responsive" onclick="abrir();">
          <img src="./ico/hamburger.png" alt="menu-responsivo" />
        </div>
      </div>
    </div>

    <div id="banner">
      <div id="holder-banner">
        <div class="img-100"><img src="./img/pregadores/AlcemirMota.jpg" /></div>
        <div class="img-100"><img src="./img/pregadores/AlcemirMota.jpg" /></div>
        <div class="img-100"><img src="./img/pregadores/AlcemirMota.jpg" /></div>        
      </div>
    </div>


    <!-- Noticias mais importantes -->
    

    <!-- Body -->
    <div id="full-default">
      <div id="body-full">
        <?php
          if(isset($_GET['pagina'])){
            $do = ($_GET['pagina']);
          } else {
            $do = "inicio";
          }

          if(file_exists("pagina/".$do.".php")){
            include("pagina/".$do.".php");

          } else {
            print '<span class="pagina-404">Pagina não encontrada</span>';
          }
        ?>
      </div>
    </div>







    <!-- Rodapé  -->
  	<div id="footer-holder">
  		<div id="footer-content">
  			<div id="links-uteis">

  				<div class="coluna">
  					<h4>Links úteis</h4>
  					<li><a href="#" target="_blank">Link 1</a></li>
  					<li><a href="#" target="_blank">Link 2</a></li>
  					<li><a href="#" target="_blank">Link 3</a></li>
  					<li><a href="#" target="_blank">Link 4</a></li>
  					<li><a href="#" target="_blank">Link 5</a></li>
  				</div>

  				<div class="coluna">
  					<h4>Redes Sociais</h4>
  					<li><a href="#" target="_blank">Facebook</a></li>
  					<li><a href="#" target="_blank">Twitter</a></li>
  					<li><a href="#" target="_blank">Google Plus</a></li>
  					<li><a href="#" target="_blank">Youtube</a></li>
  					<li><a href="#" target="_blank">Reddit</a></li>
  				</div>

  			</div>

  			<div id="low">
  				<div id="register">
  					<p>© 2016-2016 EnDivs Design | Kenpashi & Sufuria | <a href="./pagina/pcontrole.php"><span class="destaque">Versão 0.1 Λ</span></a>
  					<br>Todas as imagens de livros, noticias e etc são marcas registradas dos seus respectivos proprietários.</p>
  				</div>

  				<div id="desenvolvedor">
  					<p>Desenvolvido por:</p>
  					<img src="./img/desenveloper.png">
  				</div>
  			</div>

  		</div>
  	</div>
  </body>
</html>

<?php
  ob_flush();
?>