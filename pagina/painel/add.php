<?php

$link = DBConnect();

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $categoria = $_POST['categoria'];
    $categoria = mysqli_real_escape_string($link, $categoria);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);

    $uploaddir = './uploads/';

    $uploadfile = $uploaddir.basename($_FILES['imagem']['name']);

    if(move_uploaded_file($_FILES['imagem']['tmp_name'], '.'.$uploadfile)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload da imagem com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';
      $uploadfile = null;
    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("H:i:s");

    $query = "INSERT INTO dp_posts (categoria, titulo, resumo, imagem, data, hora) VALUES ('$categoria', '$titulo', '$resumo', '$uploadfile', '$data', '$hora')";

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

  <div id="texto-form"><p>Categoria</p></div>
  <input type="text" name="categoria" class="form-input" placeholder="Categoria" value="<?php echo $categoria ?>" />

  <div id="texto-form"><p>Titulo</p></div>
  <input type="text" name="titulo" class="form-input" placeholder="Título" value="<?php echo $titulo ?>" />

  <div id="texto-form"><p>Resumo</p></div>
  <input type="text" name="resumo" class="form-input" placeholder="Título" value="<?php echo $resumo ?>" />

  <div id="texto-form"><p>Arquivo do post</p></div>
  <input type="file" name="imagem" class="form-input" />  

  <input type="submit" value="Confirmar" id="enviar"/>
  <input type="hidden" name="enviar" value="send" />

</form>
