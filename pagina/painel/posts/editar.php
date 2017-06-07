<?php

if(isset($_GET['editar'])){
  $editar = $_GET['editar'];
}else{
  $editar = 0;
}

$link = DBConnect();

require("../system/tinify/lib/Tinify/Exception.php");
require("../system/tinify/lib/Tinify/ResultMeta.php");
require("../system/tinify/lib/Tinify/Result.php");
require("../system/tinify/lib/Tinify/Source.php");
require("../system/tinify/lib/Tinify/Client.php");
require("../system/tinify/lib/Tinify.php");

\Tinify\setKey(TINYKEY);

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $ministerio = $_POST['ministerio'];
    $ministerio = mysqli_real_escape_string($link, $ministerio);

    $categoria = $_POST['categoria'];
    $categoria = mysqli_real_escape_string($link, $categoria);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);

    $uploaddir = './uploads/';

    $uploadfile = $uploaddir.basename($_FILES['imagem']['name']);



    if(move_uploaded_file($_FILES['imagem']['tmp_name'], '.'.$uploadfile)) {

      /*$targetFile = ".".$uploadfile;
      
      $newUrl = explode('../', $targetFile);
      $ourUrl = "http://www.divinapromessa.16mb.com/".$newUrl[1];

      $source = \Tinify\fromUrl($ourUrl);
      $source->toFile($targetFile);

      
      $resized = $source->resize(array(
        "method" => "scale",
        "width" => 1024
      ));
      $resized->toFile($targetFile);*/

      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload da imagem com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';

      $seleciona = mysqli_query($link, "SELECT * FROM dp_posts WHERE id = $editar") or die(mysqli_error($link));
      $conta = mysqli_num_rows($seleciona);

      if($conta <= 0) {
      } else {
        while($row = mysqli_fetch_assoc($seleciona)){
          $imagem = $row['imagem'];
        }}

      $uploadfile = $imagem;
    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("H:i:s");

    $conteudo = $_POST['conteudo'];

    $query = "UPDATE dp_posts SET ministerio='$ministerio', categoria='$categoria', titulo='$titulo', resumo='$resumo', conteudo='$conteudo', imagem='$uploadfile', data='$data', hora='$hora' WHERE id = '$editar'";

    print_r($query);


    //Inserção de dados no banco

    if(empty($categoria)){
      echo '<div id="alert-container"><img src="../ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Escolha uma materia</p></div>';
    }elseif(empty($titulo)){
      echo '<div id="alert-container"><img src="../ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Insira um título da postagem</p></div>';
    }elseif(empty($resumo)){
      echo '<p class="alert">Conte do que se trata o post em até 500 caracteres</p>';
    }else {
      if(mysqli_query($link, $query)){
        echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Publicação editada com sucesso!</p></div>';
        header( "refresh:2;url=./pcontrole.php" );
      } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Algo deu errado</p></div>';
      }
    }
  }
?>

<div id="posts-titulo">
  <p>Editar post</p>
</div>
  <div id="recentes-posts-title">
    <div id="sql-id"><p>ID</p></div>
    <div id="sql-categoria"><p>CATEGORIA</p></div>
    <div id="sql-titulo"><p>TITULO</p></div>
    <div id="sql-imagem"><p>IMAGEM</p></div>
    <div id="sql-data"><p>DATA</p></div>
    <div id="sql-hora"><p>HORA</p></div>
    <?php
      if($editar == 0) {
        echo '<div id="sql-editar">Edit</div>';
        echo '<div id="sql-excluir">Del</div>';
      }
    ?>

  </div>


<?php

  $link = DBConnect();
  if($editar == 0 ){
    $seleciona = mysqli_query($link, "SELECT * FROM dp_posts ORDER BY id DESC") or die(mysqli_error($link));
  } else {
    $seleciona = mysqli_query($link, "SELECT * FROM dp_posts WHERE id = $editar") or die(mysqli_error($link));
  }

  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $ministerio = $row['ministerio'];
      $categoria = $row['categoria'];
      $titulo = $row['titulo'];
      $resumo = $row['resumo'];
      $conteudo = $row['conteudo'];
      $imagem = $row['imagem'];
      $data = $row['data'];
      $hora = $row['hora'];
?>

<div id="recentes-posts">

  <div id="sql-id"><p><?php echo $id ?></p></div>
  <div id="sql-categoria"><p><?php echo $categoria ?></p></div>
  <div id="sql-titulo"><p><?php echo $titulo ?> </p></div>
  <div id="sql-imagem"><img src=".<?php echo $imagem ?>" /></div>
  <div id="sql-data"><p><?php echo $data ?></p></div>
  <div id="sql-hora"><p><?php echo $hora ?></p></div>
  <?php if($editar == 0) {
    echo '<div id="sql-editar"><a href="?painel=posts/editar&editar='.$id.'"><img src="../ico/edit.png" alt="editar posts" /></a></div>';
    echo '<div id="sql-excluir"><a href="?painel=posts/excluir&excluir='.$id.'"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>';
  } ?>



</div>

<?php }} ?>

<?php

  if($editar == 0) {

  } else {
    echo '<div id="posts-titulo"><p>Something</p></div>';
    echo '<form action="" method="POST" enctype="multipart/form-data" class="form-class">';
    echo '<div id="texto-form"><p>Ministerio</p></div>';
    echo '<input type="text" name="ministerio" class="form-input" placeholder="Ministerio" value="'.$ministerio.'" />';
    echo '<div id="texto-form"><p>Categoria</p></div>';
    echo '<input type="text" name="categoria" class="form-input" placeholder="Categoria" value="'.$categoria.'" />';
    echo '<div id="texto-form"><p>Titulo</p></div>';
    echo '<input type="text" name="titulo" class="form-input" placeholder="Título" value="'.$titulo.'" />';
    echo '<div id="texto-form"><p>Resumo</p></div>';
    echo '<input type="text" name="resumo" class="form-input" placeholder="Título" value="'.$resumo.'" />';
    echo '<div id="texto-form"><p>Conteúdo da postagem</p></div>';
    echo '<textarea name="conteudo" class="form-input" id="conteudo">'.$conteudo.'</textarea>';
    echo '<script>CKEDITOR.replace("conteudo");</script>';
    echo '<div id="texto-form"><p>Arquivo do post</p></div>';
    echo '<input type="file" name="imagem" class="form-input" />';
    echo '<input type="submit" value="Confirmar" id="enviar"/>';
    echo '<input type="hidden" name="enviar" value="send" />';
    echo '</form>';
  }
  ?>
