<?php
  error_reporting(0);
  ob_start("ob_gzhandler");
  require './system/config.php';
  require './system/conn.php';
?>

<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, maximum-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<title>Contato</title>
  	<link rel="icon" href="./ico/favicon.ico" type="image/x-icon" />
  	<link rel="stylesheet" type="text/css" href="./css/default.css">
    <link rel="stylesheet" type="text/css" href="./css/contato.css">
  	<link rel="stylesheet" type="text/css" href="./css/responsive.css" media="screen and (max-width: 1024px)">    
  </head>
  <body>

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
    </div><br><br><br><br><br>

    <div id="full-default">
      <div id="body-full">

        <div id="con-holder">
          <div id="con-info">
            <div id="con-img-info">
              <img src="./ico/church.png">
            </div>

            <div id="con-titulo">
                <p>Igreja evangélica pentecostal<br />Divina Promessa</p>
            </div>

            <div id="con-texto">
                <p>Rua são José, 59 - Helena Maria Osasco/SP</p>
            </div>

            <div id="mapa">
                <p>Mapa, Clique aqui!</p>
            </div>

          </div>

          <div id="contato-form">
            <div id="formulario">
          <?php
          
          $link = DBConnect();

          if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

            $nome = $_POST['nome'];
            $nome = mysqli_real_escape_string($link, $nome);

            $categoria = $_POST['categoria'];            
            $categoria = mysqli_real_escape_string($link, $categoria);

            $titulo = $_POST['titulo'];
            $titulo = mysqli_real_escape_string($link, $titulo);
          
            $pedido = $_POST['pedido'];
            $pedido = mysqli_real_escape_string($link, $pedido);            

            date_default_timezone_set('America/Sao_Paulo');
            $data = date("d/m/Y");
            $hora = date("H:i:s");

            $query = "INSERT INTO dp_contatos (nome, categoria, titulo, pedido, data, hora) VALUES ('$nome', '$categoria', '$titulo', '$pedido', '$data', '$hora')";

            //Inserção de dados no banco

            if(empty($categoria)){
              echo '<div id="alert-container"><img src="./ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Escolha uma categoria</p></div>';
            }elseif(empty($titulo)){
              echo '<div id="alert-container"><img src="./ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Insira um título</p></div>';
            }elseif(empty($pedido)){
              echo '<div id="alert-container"><img src="./ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Descreva o seu pedido/oração/opinião</p></div>';
            }else {
              if(mysqli_query($link, $query)){
                echo '<div id="alert-container"><img src="./ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Informações enviadas com sucesso!</p></div>';
                unset($_POST);
              } else {
              echo '<div id="alert-container"><img src="./ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Algo deu errado</p></div>';
              }
            }
          }
          ?>
            
              <form action="" method="POST" enctype="multipart/form-data" class="form-class">

                <div id="texto-form"><p>Nome</p></div>
                <input type="text" name="nome" class="form-input" placeholder="Deseja se indentificar?"/>

                <div id="texto-form"><p>Categoria</p></div>
                <select name="categoria" class="form-select">
                  <option value="">Escolha a categoria</option>
                  <option value="1">1º Semestre</option>
                  <option value="2">2º Semestre</option>
                  <option value="3">3º Semestre</option>
                  <option value="4">4º Semestre</option>
                  <option value="5">5º Semestre</option>
                  <option value="6">6º Semestre</option>
                  <option value="7">7º Semestre</option>
                  <option value="8">8º Semestre</option>            
                </select>

                <div id="texto-form"><p>Titulo</p></div>
                <input type="text" name="titulo" class="form-input" placeholder="Título" />

                <div id="texto-form"><p>Pedido</p></div>
                <textarea name="pedido" class="form-input" placeholder="Em que podemos ajudar?"></textarea>

                <input type="submit" value="Publicar" id="enviar"/>
                <input type="hidden" name="enviar" value="send" />

              </form>
            </div>
          </div>





        </div>


        
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