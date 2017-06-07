<?php

if(isset($_GET['excluir'])){
  $excluir = $_GET['excluir'];
}else{
  $excluir = 0;
}

$link = DBConnect();

  if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){

    $query = "DELETE FROM dp_posts WHERE id = '$excluir'";

    if(mysqli_query($link, $query)){
      echo '<div id="alert-container"><img src="../ico/success.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p id="sucess">Publicação excluida com sucesso!</p></div>';
      header( "refresh:2;url=./pcontrole.php" );
    } else {
    echo '<div id="alert-container"><img src="../ico/error.png" alt="hora-do-post" width="45px" height="45px" height="auto" style="margin-right: 15px" /><p class="erro">Algo deu errado</p></div>';
    }

  }

?>

<div id="posts-titulo">
  <p>Deletar post</p>
</div>
  <div id="recentes-posts-title">
    <div id="sql-id"><p>ID</p></div>
    <div id="sql-categoria"><p>CATEGORIA</p></div>
    <div id="sql-titulo"><p>TITULO</p></div>
    <div id="sql-imagem"><p>IMAGEM</p></div>
    <div id="sql-data"><p>DATA</p></div>
    <div id="sql-hora"><p>HORA</p></div>
    <?php if($excluir == 0){
      echo '<div id="sql-editar">Edit</div>';
      echo '<div id="sql-excluir">Del</div>';
    }?>

  </div>


<?php



  $link = DBConnect();
  if($excluir == 0 ){
    $seleciona = mysqli_query($link, "SELECT * FROM dp_posts ORDER BY id DESC") or die(mysqli_error($link));
  } else {
    $seleciona = mysqli_query($link, "SELECT * FROM dp_posts WHERE id = $excluir") or die(mysqli_error($link));
  }

  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $categoria = $row['categoria'];
      $titulo = $row['titulo'];
      $resumo = $row['resumo'];
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
  <?php if($excluir == 0) {
    echo '<div id="sql-editar"><a href="?pagina=editar&editar='.$id.'"><img src="../ico/edit.png" alt="editar posts" /></a></div>';
    echo '<div id="sql-excluir"><a href="?pagina=excluir&excluir='.$id.'"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>';
  } ?>



</div>

<?php }} ?>

<?php
  if($excluir == 0) {

  } else {
    echo '<div id="posts-titulo"><p>Deletar</p></div>';
    echo '<div id="delete"><p>Deseja deletar esse post?</p><form action="" method="POST" enctype="multipart/form-data"><input type="submit" value="Sim" id="enviar"/><input type="hidden" name="enviar" value="send" /></form><a href="./pcontrole.php"><button id="enviar">Não</button></a></div>';

  }

?>
