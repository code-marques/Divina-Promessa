<?php

$link = DBConnect();

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $categoria = $_POST['categoria'];
    $categoria = mysqli_real_escape_string($link, $categoria);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);

    $data = explode('-', $_POST['data']);
    $ano = $data[0];
    $mes = $data[1];
    $dia = $data[2];
    
    $query = "INSERT INTO dp_agenda (categoria, titulo, descri, dia, mes, ano) VALUES ('$categoria', '$titulo', '$resumo', '$dia', '$mes', '$ano')";

    //Inserção de dados no banco

    if(empty($categoria)){
      echo '<div id="alert-container"><img src="../ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Informe uma categoria</p></div>';
    }elseif(empty($titulo)){
      echo '<div id="alert-container"><img src="../ico/warning.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="alert">Insira um título</p></div>';
    }elseif(empty($resumo)){
      echo '<p class="alert">Conte do que se trata o post em até 50 caracteres</p>';
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

<div id="posts-titulo"><p>Adicionar data na agenda</p></div>


<form action="" method="POST" enctype="multipart/form-data" class="form-class">

  <div id="texto-form"><p>Categoria</p></div>
  <input type="text" name="categoria" class="form-input" placeholder="Categoria" value="<?php echo $categoria ?>" />

  <div id="texto-form"><p>Titulo</p></div>
  <input type="text" name="titulo" class="form-input" placeholder="Título" value="<?php echo $titulo ?>" />

  <div id="texto-form"><p>Resumo</p></div>
  <input type="text" name="resumo" class="form-input" placeholder="Título" value="<?php echo $resumo ?>" />

  <div id="texto-form"><p>Data do evento</p></div>
  <input type="date" name="data" class="form-input" />  

  <input type="submit" value="Confirmar" id="enviar"/>
  <input type="hidden" name="enviar" value="send" />

</form>
