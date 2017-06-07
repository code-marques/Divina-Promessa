<?php

$link = DBConnect();

require("../system/tinify/lib/Tinify/Exception.php");
require("../system/tinify/lib/Tinify/ResultMeta.php");
require("../system/tinify/lib/Tinify/Result.php");
require("../system/tinify/lib/Tinify/Source.php");
require("../system/tinify/lib/Tinify/Client.php");
require("../system/tinify/lib/Tinify.php");

\Tinify\setKey(TINYKEY);

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $ministerio = $_POST['unidade'];

    $categoria = $_POST['categoria'];
    $categoria = mysqli_real_escape_string($link, $categoria);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);    

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("H:i:s");

    $conteudo = $_POST['conteudo'];    

    /*$uploaddir = './uploads/';
    $uploadfile = $uploaddir.basename($_FILES['imagem']['name']);

    if(move_uploaded_file($_FILES['imagem']['tmp_name'], '.'.$uploadfile)) {
      
      $targetFile = '.'.$uploadfile;       
      $newUrl = explode('../', $targetFile);      
      $ourUrl = "http://www.divinapromessa.16mb.com/".$newUrl[1];            

      $source = \Tinify\fromUrl($ourUrl);
      $source->toFile($targetFile);

      $resized = $source->resize(array(
        "method" => "scale",
        "width" => 1024
      ));
      if($resized->toFile($targetFile)) {
        echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Ok!</p></div>';
      } else {
        echo '<div id="alert-container"><img src="../ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Erro</p></div>';
      }    

      
    }    */

    $query = "INSERT INTO dp_posts (ministerio, categoria, titulo, resumo, conteudo, imagem, data, hora) VALUES ('$ministerio', '$categoria', '$titulo', '$resumo', '$conteudo', '$uploadfile', '$data', '$hora')";    

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
        echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Publicação inserida com sucesso!</p></div>';
        header( "refresh:2;url=./pcontrole.php" );
      } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Algo deu errado</p></div>';
      }
    }
  }
?>

<div id="posts-titulo"><p>Adicionar postagem</p></div>


<form action="" method="POST" enctype="multipart/form-data" class="form-class">

  <div id="texto-form"><p>Unidade</p></div>
  <input type="text" name="unidade" class="form-input" placeholder="Unidade" value="<?php echo $ministerio ?>" />

  <div id="texto-form"><p>Categoria</p></div>
  <input type="text" name="categoria" class="form-input" placeholder="Categoria" value="<?php echo $categoria ?>" />

  <div id="texto-form"><p>Titulo</p></div>
  <input type="text" name="titulo" class="form-input" placeholder="Título" value="<?php echo $titulo ?>" />

  <div id="texto-form"><p>Resumo</p></div>
  <input type="text" name="resumo" class="form-input" placeholder="Título" value="<?php echo $resumo ?>" />

  <div id="texto-form"><p>Conteúdo da postagem</p></div>
  <textarea name="conteudo" class="form-input" id="conteudo"></textarea>
  <script>CKEDITOR.replace('conteudo');</script>

  <div id="texto-form"><p>Upload</p></div>
  <input type="file" name="imagem" class="form-input" />

  <input type="submit" value="Confirmar" id="enviar"/>
  <input type="hidden" name="enviar" value="send" />

</form>
