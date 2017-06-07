<?php

if(isset($_GET['edit'])){
  $editar = $_GET['edit'];
}else{
  $editar = 0;
}

$link = DBConnect();

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $pregador = $_POST['pregador'];
    $pregador = mysqli_real_escape_string($link, $pregador);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);

    $tags = $_POST['tags'];
    
    $uploaddir = '../audios/';

    $low = $uploaddir.basename($_FILES['baixa']['name']);    

    if(move_uploaded_file($_FILES['baixa']['tmp_name'], $low)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do audio low com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';

      $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos WHERE id = $editar") or die(mysqli_error($link));
      $conta = mysqli_num_rows($seleciona);

      if($conta <= 0) {
      } else {
        while($row = mysqli_fetch_assoc($seleciona)){
          $arquivo = $row['low'];
        }}

      $low = $arquivo;      
    }

    $med = $uploaddir.basename($_FILES['media']['name']);    

    if(move_uploaded_file($_FILES['media']['tmp_name'], $med)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do audio med com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';

      $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos WHERE id = $editar") or die(mysqli_error($link));
      $conta = mysqli_num_rows($seleciona);

      if($conta <= 0) {
      } else {
        while($row = mysqli_fetch_assoc($seleciona)){
          $arquivo = $row['medium'];
        }}

      $med = $arquivo;
    }

    $hig = $uploaddir.basename($_FILES['alta']['name']);    

    if(move_uploaded_file($_FILES['alta']['tmp_name'], $hig)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do audio hig com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';

      $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos WHERE id = $editar") or die(mysqli_error($link));
      $conta = mysqli_num_rows($seleciona);

      if($conta <= 0) {
      } else {
        while($row = mysqli_fetch_assoc($seleciona)){
          $arquivo = $row['high'];
        }}

      $hig = $arquivo;
    }

    $zip = $uploaddir.basename($_FILES['zip']['name']);    

    if(move_uploaded_file($_FILES['zip']['tmp_name'], $zip)) {
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Upload do zip com sucesso!</p></div>';
    } else {
      echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Imagem não enviada!</p></div>';
      
      $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos WHERE id = $editar") or die(mysqli_error($link));
      $conta = mysqli_num_rows($seleciona);

      if($conta <= 0) {
      } else {
        while($row = mysqli_fetch_assoc($seleciona)){
          $arquivo = $row['zip'];
        }}

      $zip = $arquivo;
    }

    $data = explode('-', $_POST['data']);
    $ano = $data[0];
    $mes = $data[1];
    $dia = $data[2];
    $data = $data[2].'/'.$data[1].'/'.$data[0]; 

    date_default_timezone_set('America/Sao_Paulo');    
    $hora = date("H:i:s");  

    $conteudo = $_POST['conteudo'];

    $query = "UPDATE dp_cultos SET pregador='$pregador', data='$data', hora='$hora', titulo='$titulo', resumo='$resumo', tags='$tags', low='$low', medium='$med', high='$hig', zip='$zip', conteudo='$conteudo' WHERE id = '$editar'"; 

    //Inserção de dados no banco

    if(empty($pregador)){ 
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
  <p>Editar culto</p>
</div>
  <div id="recentes-posts-title">
    <div id="sql-id"><p>ID</p></div>
    <div id="sql-categoria"><p>PREGADOR</p></div>
    <div id="sql-titulo"><p>TITULO</p></div>
    <div id="sql-titulo"><p>RESUMO</p></div>
    <div id="sql-data"><p>DATA</p></div>    
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
    $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos ORDER BY id DESC") or die(mysqli_error($link));
  } else {
    $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos WHERE id = $editar") or die(mysqli_error($link));
  }

  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $pregador = $row['pregador'];
      $data = $row['data'];
      $titulo = $row['titulo'];
      $resumo = $row['resumo'];      
      $conteudo = $row['conteudo'];
      $tags = $row['tags'];
      $low = $row['low'];
      $med = $row['medium'];
      $hig = $row['high'];
      $zip = $row['zip'];

      $data = explode('/', $data);      
      $data = $data[2].'-'.$data[1].'-'.$data[0];
?>

<div id="recentes-posts">

  <div id="sql-id"><p><?=$id?></p></div>
  <div id="sql-categoria"><p><?=$pregador?></p></div>
  <div id="sql-titulo"><p><?=$titulo?></p></div>
  <div id="sql-titulo"><p><?=$resumo?></p></div>
  <div id="sql-data"><p><?=$data ?></p></div>  
  <?php if($editar == 0) {
    echo '<div id="sql-editar"><a href="?pagina=editar&editar='.$id.'"><img src="../ico/edit.png" alt="editar posts" /></a></div>';
    echo '<div id="sql-excluir"><a href="?pagina=excluir&excluir='.$id.'"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>';
  } ?>



</div>

<?php }} ?>

<?php

  if($editar == 0) {

  } else { include './painel/cultos/edit-form.php'; }

?>
