<?php

$link = DBConnect();

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $pregador = $_POST['pregador'];
    $pregador = mysqli_real_escape_string($link, $pregador);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);

    $tags = $_POST['tags'];
    $tags = mysqli_real_escape_string($link, $tags);

    $uploaddir = '../audios/';

    $low = $uploaddir.basename($_FILES['baixa']['name']);    

    if(move_uploaded_file($_FILES['baixa']['tmp_name'], $low)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do audio low com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';
      $low = null;
    }

    $med = $uploaddir.basename($_FILES['media']['name']);    

    if(move_uploaded_file($_FILES['media']['tmp_name'], $med)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do audio med com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';
      $med = null;
    }

    $hig = $uploaddir.basename($_FILES['alta']['name']);    

    if(move_uploaded_file($_FILES['alta']['tmp_name'], $hig)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do audio hig com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';
      $hig = null;
    }

    $zip = $uploaddir.basename($_FILES['zip']['name']);    

    if(move_uploaded_file($_FILES['zip']['tmp_name'], $zip)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do zip com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';
      $zip = null;
    }

    $data = explode('-', $_POST['data']);
    $ano = $data[0];
    $mes = $data[1];
    $dia = $data[2];
    $data = $data[2].'/'.$data[1].'/'.$data[0];

    date_default_timezone_set('America/Sao_Paulo');    
    $hora = date("H:i:s");   

    $conteudo = $_POST['conteudo'];
    
    
    $query = "INSERT INTO dp_cultos (pregador, data, hora, titulo, resumo, tags, low, medium, high, zip, conteudo) VALUES ('$pregador', '$data', '$hora', '$titulo', '$resumo', '$tags', '$low', '$med', '$hig', '$zip', '$conteudo')";

    //Inserção de dados no banco

    if(empty($pregador)){
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

<div id="posts-titulo"><p>Adicionar novo culto gravado</p></div>


<form action="" method="POST" enctype="multipart/form-data" class="form-class">

  <div id="texto-form"><p>Pregador</p></div>
  <input type="text" name="pregador" class="form-input" placeholder="Pregador" value="<?php echo $pregador ?>" />

  <div id="texto-form"><p>Titulo</p></div>
  <input type="text" name="titulo" class="form-input" placeholder="Título" value="<?php echo $titulo ?>" />

  <div id="texto-form"><p>Resumo</p></div>
  <input type="text" name="resumo" class="form-input" placeholder="Título" value="<?php echo $resumo ?>" />

  <div id="texto-form"><p>Tags</p></div>
  <input type="text" name="tags" class="form-input" placeholder="Separar tags por vírgula" value="<?php echo $tags ?>" />

  <div id="texto-form"><p>Aúdio de baixa qualidade</p></div>
  <input type="file" name="baixa" class="form-input" />  

  <div id="texto-form"><p>Aúdio de média qualidade</p></div>
  <input type="file" name="media" class="form-input" />  

  <div id="texto-form"><p>Aúdio de Alta qualidade</p></div>
  <input type="file" name="alta" class="form-input" />  

  <div id="texto-form"><p>Aúdio zipado</p></div>
  <input type="file" name="zip" class="form-input" />  

  <div id="texto-form"><p>Data do evento</p></div>
  <input type="date" name="data" class="form-input" />  

  <div id="texto-form"><p>Conteúdo da postagem</p></div>
  <textarea name="conteudo" class="form-input" id="conteudo"></textarea>
  <script>CKEDITOR.replace('conteudo');</script>

  <input type="submit" value="Confirmar" id="enviar"/>
  <input type="hidden" name="enviar" value="send" />

</form>
