<?php
  require '../system/config.php';
  require '../system/conn.php';
?>

<?php


  if(isset($_GET['post'])){
    $pg = (int)$_GET['post'];
  } else {
    $pg = 1;
  }

  $link = DBConnect();
  $seleciona = mysqli_query($link, "SELECT * FROM dp_posts WHERE id = '$pg'") or die(mysqli_error($link));
  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $categoria = $row['categoria'];
      $titulo = $row['titulo'];
      $resumo = $row['resumo'];
      $conteudo = $row['conteudo'];      
      $imagem = '.'.$row['imagem'];
      $data = $row['data'];
      $hora = $row['hora'];
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta property="og:url"           content="<?= url(); ?>" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="<?=$titulo?>" />
    <meta property="og:description"   content="<?=$resumo?>" />
    <meta property="og:image"         content="<?=img($imagem);?>" />

    <title>IEP - Divina Promessa</title>
    <link rel="icon" href="../ico/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../css/default.css">
    <link rel="stylesheet" type="text/css" href="../css/single.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen and (max-width: 1024px)">
    <script type="text/javascript" src="../js/menu.js"></script>
  </head>
  <body>



  <div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=1812143715716718";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  

  <div id="darken"></div>  
  <div id="hidden-menu" onclick="fechar();">    
    <div class="height-full">
      <a href="../cultos.php"><p align="center">Cultos</p><div class="hidden-link"><img src="../ico/bible.png" alt="#" /></div></a>
      <a href="../ensinamentos.php"><p align="center">Ensinos</p><div class="hidden-link"><img src="../ico/ensino.png" alt="#" /></div></a>
      <a href="../agenda.php"><p align="center">Agenda</p><div class="hidden-link"><img src="../ico/agenda.png" alt="#" /></div></a>      
    </div>

    <div class="height-full">
      <a href="../sobre.php"><p align="center">Sobre nós</p><div class="hidden-link"><img src="../ico/question.png" alt="#" width="90px" height="90px" /></div></a>
      <a href="../ministério.php"><p align="center">Ministérios</p><div class="hidden-link"><img src="../ico/ministerio.png" alt="#" /></div></a>
      <a href="../contato.php"><p align="center">Contato</p><div class="hidden-link"><img src="../ico/contato.png" alt="#" /></div></a>      
    </div>
    
  </div>

    <!-- Header -->
    <div id="full-default-header">
      <div id="header-holder">

        <div id="logo-header">

          <a href="../index.php"><img src="../img/logo.png" alt="logo da igreja envangélica pentecostal" /></a>
          <a href="../index.php"><h1>Divina<br /> Promessa</h1></a>

        </div>

        <div id="links-header">          

          <div class="link">
            <a href="../cultos.php">Cultos</a>
          </div>

          <div class="link">
            <a href="../ensinamentos.php">Ensinos</a>
          </div>

          <div class="link">
            <a href="../agenda.php">Agenda</a>
          </div>

          <div class="link">
            <a href="../sobre.php">Sobre</a>
          </div>

          <div class="link">
            <a href="../ministerios.php">Ministérios</a>
          </div>

          <div class="link">
            <a href="../contato.php">Contato</a>
          </div>

        </div>
        <div id="links-responsive" onclick="abrir();">
          <img src="../ico/hamburger.png" alt="menu-responsivo" />
        </div>
      </div>
    </div><br><br><br><br><br>



<div id="full-default">
  <div id=body-full>
    
    <div id="single-holder">      

      <div id="single-titulo">
        <h2><?=$titulo?></h2>
      </div>

      <div id="single-resumo">
        <p><?php echo $resumo ?></p>
      </div>

      <div class="fb-share-button" data-href="<?php url(); ?>" data-layout="button_count" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="<?php url(); ?>">Compartilhar</a></div>

      <div id="single-categoria">
        <p><span class="blue"><?php echo $categoria ?>, Divina Promessa Sede, São Paulo.</span></p>
        <p>postado em <?=$data?> às <?=$hora?></p>
      </div>      

      <?php if(empty($imagem)) {} else {
        echo '<div id="single-img">
          <img src="'.$imagem.'" height="100%" width="100%" />
        </div>';
      } ?>

      <div id="single-conteudo">
        <?=$conteudo?>
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
        <p>© 2016-2016 EnDivs Design | Kenpashi & Sufuria | <a href="./pcontrole.php"><span class="destaque">Versão 0.1 Λ</span></a>
        <br>Todas as imagens de livros, noticias e etc são marcas registradas dos seus respectivos proprietários.</p>
      </div>

      <div id="desenvolvedor">
        <p>Desenvolvido por:</p>
        <img src="../img/desenveloper.png">
      </div>
    </div>

  </div>
</div>
