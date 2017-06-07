<?php  
  require '../system/config.php';
  require '../system/conn.php';
?>

<?php/*
  
  $link = DBConnect();
  session_start();   
  
  if(!empty($_SESSION['chave'])){
    if(!empty($_SESSION['user'])){       

      $login = $_SESSION['user'];
      $query = mysqli_query($link, "SELECT * FROM si_usuarios WHERE id = '$login'");  
      $row = mysqli_num_rows($query);     

      if($row < 1) {        
        session_unset();
        header( "refresh:0;url=./login.php" );
      } else {
        while($row = mysqli_fetch_assoc($query)){          
          $userName = $row['name'];          
          $sessionKey = $row['sessao'];
        }
      }
      if($sessionKey == $_SESSION['chave']){        
        header( "refresh:180;url=./login.php" );        
      } else {
        
        session_unset();         
        header( "refresh:0;url=./login.php" );
      }
    } else {       
       session_unset();         
       header( "refresh:0;url=./login.php" );
    }
  } else {      
      session_unset();         
      header( "refresh:0;url=./login.php" );
    }*/

?>

<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, maximum-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<title>Administração</title>
  	<link rel="icon" href="./ico/favicon.ico" type="image/x-icon" />
  	<link rel="stylesheet" type="text/css" href="../css/painel_de_controle.css">
  	<link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen and (max-width: 1024px)">
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>    
  </head>
  <body>

    <!-- Header -->
    <div id="full-header">

      <a href="./pcontrole.php"><div id=logo>
        <div id="imagem-logo">
          <img src="../ico/logodics.png" alt="imagem do logo" />
        </div>
        <div id="texto-logo">
          <p>INDIVS</p>
        </div>
      </div></a>

      <div id="administrador">
        <div id="loggout">
          <a href="../index.php"><img src="../ico/internet.png" alt="Voltar a página de acesso" /></a>
        </div>
        <div id="usuario">
          <p>Bem vindo! <?php echo $userName ?></p>
        </div>
        <div id="loggout">
          <a href="../index.php"><img src="../ico/switch-6.png" alt="Fazer loggout do sistema" /></a>
        </div>
      </div>
    </div>

    <!-- Barra de navegação lateral -->

    <div id="barra">

      <div id="titulo-barra">
        <a href="./pcontrole.php"><img src="../ico/database-1.png" alt="painel de controle" /></a>
        <a href="./pcontrole.php"><p>Painel de controle</p></a>
      </div>

      <div id="posts-barra" onclick="posts(1);">
        <div id="holder-barra">
          <img src="../ico/list.png" alt="posts" />
          <p>Posts</p>
        </div>

        <div class="arrow" onclick="posts(1);">
          <span>&darr;</span>
        </div>
      </div>

      <div class="sub-posts-barra">
        <div class="sub">
          <a href="?painel=posts/add"><div id="holder-barra"><img src="../ico/add-1.png" alt="posts" /><p class="link">Adicionar</p></div></a>
          <a href="?painel=posts/editar&editar=0"><div id="holder-barra"><img src="../ico/edit.png" alt="posts" /><p class="link">Editar</p></div></a>
          <a href="?painel=posts/editar&editar=0"><div id="holder-barra"><img src="../ico/garbage.png" alt="posts" /><p class="link">Excluir</p></div></a>
        </div>
      </div>

      <div id="posts-barra" onclick="contatos(1);">
        <div id="holder-barra">
          <img src="../ico/users.png" alt="posts" />
          <p>Duvidas</p>
        </div>

        <div class="arrow" onclick="contatos(1);">
          <span>&darr;</span>
        </div>
      </div>

      <div class="sub-posts-barra">
        <div class="sub">
          <a href="?pagina=view&view=0"><div id="holder-barra"><img src="../ico/list.png" alt="posts" /><p class="link">Visualizar todas</p></div></a>
        </div>
      </div>

      <div id="posts-barra" onclick="eventos(1);">
        <div id="holder-barra">
          <img src="../ico/list.png" alt="posts" />
          <p>Agenda</p>
        </div>

        <div class="arrow" onclick="eventos(1);">
          <span>&darr;</span>
        </div>
      </div>

      <div class="sub-posts-barra">
        <div class="sub">
          <a href="?painel=agenda/add&add=0"><div id="holder-barra"><img src="../ico/add-1.png" alt="posts" /><p class="link">Adicionar</p></div></a>
          <a href="?painel=agenda/edit&edit=0"><div id="holder-barra"><img src="../ico/edit.png" alt="posts" /><p class="link">Editar</p></div></a>
          <a href="?painel=agenda/del&del=0"><div id="holder-barra"><img src="../ico/garbage.png" alt="posts" /><p class="link">Excluir</p></div></a>
        </div>
      </div>

      
      
      






    </div>

    <!-- Body -->

    <div id="titulo">
      <p><?php if(isset($_GET['pagina'])){

      }else{
        echo 'Painel Principal';
      }
      if(isset($_GET['add'])){
        echo "Inclusão de postagem";
      } elseif(isset($_GET['editar'])) {
        echo "Edição de postagem";
      } elseif(isset($_GET['excluir'])){
        echo "Exclusão de postagem";
      }


      ?></p>
    </div>

    <div id="body-full">
      <div id="body-content">
        <?php
          if(isset($_GET['painel'])){
            $do = ($_GET['painel']);
          } else {
            $do = "inicio";
          }          

          if(file_exists("../pagina/painel/".$do.".php")){
            include("../pagina/painel/".$do.".php");
          } else {
            print '<span class="pagina-404">Pagina não encontrada</span>';
          }
        ?>
      </div>
    </div>



    <!-- Rodapé  -->

  <script type="text/javascript" src="../js/painelcontrole.js"></script>
  </body>
</html>
