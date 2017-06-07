<?php

if(isset($_GET['edit'])){
  $editar = $_GET['edit'];
}else{
  $editar = 0;
}

$link = DBConnect();

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $categoria = $_POST['categoria'];
    $categoria = mysqli_real_escape_string($link, $categoria);

    $titulo = $_POST['titulo'];
    $titulo = mysqli_real_escape_string($link, $titulo);

    $resumo = $_POST['resumo'];
    $resumo = mysqli_real_escape_string($link, $resumo);    

    $data = explode('-', $_POST['data']);
    $dia = $data[2];
    $mes = $data[1];
    $ano = $data[0];


    $query = "UPDATE dp_agenda SET categoria='$categoria', titulo='$titulo', descri='$resumo', dia='$dia', mes='$mes', ano='$ano' WHERE id = '$editar'";    

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
    <div id="sql-titulo"><p>DESCRICAO</p></div>
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
    $seleciona = mysqli_query($link, "SELECT * FROM dp_agenda ORDER BY id DESC") or die(mysqli_error($link));
  } else {
    $seleciona = mysqli_query($link, "SELECT * FROM dp_agenda WHERE id = $editar") or die(mysqli_error($link));
  }

  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $categoria = $row['categoria'];
      $titulo = $row['titulo'];
      $desc = $row['descri'];
      $dia = $row['dia'];
      $mes = $row['mes'];
      $ano = $row['ano'];
      $data = $ano.'-'.$mes.'-'.$dia;
?>

<div id="recentes-posts">

  <div id="sql-id"><p><?=$id?></p></div>
  <div id="sql-categoria"><p><?=$categoria?></p></div>
  <div id="sql-titulo"><p><?=$titulo?></p></div>
  <div id="sql-titulo"><p><?=$desc?></p></div>
  <div id="sql-data"><p><?php echo $data ?></p></div>  
  <?php if($editar == 0) {
    echo '<div id="sql-editar"><a href="?pagina=editar&editar='.$id.'"><img src="../ico/edit.png" alt="editar posts" /></a></div>';
    echo '<div id="sql-excluir"><a href="?pagina=excluir&excluir='.$id.'"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>';
  } ?>



</div>

<?php }} ?>

<?php

  if($editar == 0) {

  } else { include './painel/agenda/edit-form.php'; }

?>
