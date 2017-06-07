<?php
  $link = DBConnect();
  $seleciona = mysqli_query($link, "SELECT * FROM dp_posts") or die(mysqli_error($link));
  $posts = mysqli_num_rows($seleciona);

  $seleciona = mysqli_query($link, "SELECT * FROM dp_agenda") or die(mysqli_error($link));
  $agenda = mysqli_num_rows($seleciona);
?>

<div id="resumo-holder">
  <div id="total-posts"><p>Posts</p></div>
  <div id="total-pedidos"><p>Agenda</p></div>
  <div id="total-acessos"><p>Acessos</p></div>
  <div id="total-eventos"><p>Eventos</p></div>
</div>

<div id="resumo-holder">
  <div id="total-posts"><p><?php echo $posts ?></p></div>
  <div id="total-pedidos"><p><?php echo $agenda ?></p></div>
  <div id="total-acessos"><p><?php echo $acessos ?></p></div>
  <div id="total-eventos"><p><?php echo $eventos ?></p></div>
</div>

<div id="posts-titulo">
  <p>Posts</p>
</div>
  <div id="recentes-posts-title">
    <div id="sql-id"><p>ID</p></div>
    <div id="sql-categoria"><p>CATEGORIA</p></div>
    <div id="sql-titulo"><p>TITULO</p></div>
    <div id="sql-imagem"><p>IMAGEM</p></div>
    <div id="sql-data"><p>DATA</p></div>
    <div id="sql-hora"><p>HORA</p></div>
    <div id="sql-editar"><p>EDIT</p></div>
    <div id="sql-excluir"><p>DEL</p></div>
  </div>


<?php

  $link = DBConnect();
  $seleciona = mysqli_query($link, "SELECT * FROM dp_posts ORDER BY id DESC LIMIT 3") or die(mysqli_error($link));
  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $categoria = $row['categoria'];
      $titulo = $row['titulo'];
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
  <div id="sql-editar"><a href="?painel=posts/editar&editar=<?php echo $id ?>"><img src="../ico/edit.png" alt="editar posts" /></a></div>
  <div id="sql-excluir"><a href="?painel=posts/excluir&excluir=<?php echo $id ?>"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>

</div>

<?php }} ?>

<!-- ------------------------------------------------------------------------------- -->

<div id="posts-titulo">
  <p>Agenda da Divina Promessa</p>
</div>
  <div id="recentes-posts-title">
    <div id="sql-id"><p>ID</p></div>
    <div id="sql-categoria"><p>CATEGORIA</p></div>
    <div id="sql-titulo"><p>TITULO</p></div>
    <div id="sql-titulo"><p>DESCRICAO</p></div>
    <div id="sql-data"><p>DATA</p></div>    
    <div id="sql-editar"><p>EDIT</p></div>
    <div id="sql-excluir"><p>DEL</p></div>
  </div>


<?php

  $link = DBConnect();
  $seleciona = mysqli_query($link, "SELECT * FROM dp_agenda ORDER BY id DESC LIMIT 5") or die(mysqli_error($link));
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
      $data = $dia.'/'.$mes.'/'.$ano;
?>

<div id="recentes-posts">

  <div id="sql-id"><p><?=$id?></p></div>
  <div id="sql-categoria"><p><?=$categoria?></p></div>
  <div id="sql-titulo"><p><?=$titulo?></p></div>
  <div id="sql-titulo"><p><?=$desc?></p></div>
  <div id="sql-data"><p><?php echo $data ?></p></div>  
  <div id="sql-editar"><a href="?painel=agenda/edit&edit=<?php echo $id ?>"><img src="../ico/edit.png" alt="editar posts" /></a></div>
  <div id="sql-excluir"><a href="?painel=agenda/del&del=<?php echo $id ?>"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>

</div>

<?php }} ?>

<div id="posts-titulo">
  <p>Cultos gravados</p>
</div>
  <div id="recentes-posts-title">
    <div id="sql-id"><p>ID</p></div>
    <div id="sql-categoria"><p>PREGADOR</p></div>
    <div id="sql-titulo"><p>TITULO</p></div>
    <div id="sql-titulo"><p>RESUMO</p></div>
    <div id="sql-data"><p>DATA</p></div>    
    <div id="sql-editar"><p>EDIT</p></div>
    <div id="sql-excluir"><p>DEL</p></div>
  </div>


<?php

  $link = DBConnect();
  $seleciona = mysqli_query($link, "SELECT * FROM dp_cultos ORDER BY id DESC LIMIT 5") or die(mysqli_error($link));
  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_assoc($seleciona)){

      $id = $row['id'];
      $categoria = $row['pregador'];
      $titulo = $row['titulo'];
      $desc = $row['resumo'];      
      $data = $row['data'];
?>

<div id="recentes-posts">

  <div id="sql-id"><p><?=$id?></p></div>
  <div id="sql-categoria"><p><?=$categoria?></p></div>
  <div id="sql-titulo"><p><?=$titulo?></p></div>
  <div id="sql-titulo"><p><?=$desc?></p></div>
  <div id="sql-data"><p><?php echo $data ?></p></div>  
  <div id="sql-editar"><a href="?painel=cultos/edit&edit=<?php echo $id ?>"><img src="../ico/edit.png" alt="editar posts" /></a></div>
  <div id="sql-excluir"><a href="?painel=cultos/del&del=<?php echo $id ?>"><img src="../ico/garbage-2.png" alt="excluir posts" /></a></div>

</div>

<?php }} ?>





