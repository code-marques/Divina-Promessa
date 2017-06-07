<div id="full-default">
  <div id="body-full">

<?php          
  $query = select($select='*', $table='dp_posts', $orderby='ORDER BY id DESC', $limit='LIMIT 3');
  $row = mysqli_num_rows($query);      

  if($row > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
      $id = $row['id'];
      $categoria = $row['categoria'];
      $resumo = $row['resumo'];
      $imagem = $row['imagem'];
?>

  <div id="news" style="background: #03bfb7; background: radial-gradient(transparent, #222), url('<?=$imagem?>'); background-size: cover; background-position: center; background-blend-mode: multiply"><a href="./pagina/post.php?post=<?php echo $id ?>"></a><h2><?=$categoria?></h2><p><?=$resumo?></p></div>

<?php }} ?>

</div>
</div>

<div id="full-default">
  <div id="last-news">
    <h2>Últimas noticias</h2>
  </div>
</div>



<div id="full-default">
  <div id=body-full-posts>

<?php


  if(isset($_GET['posts'])){
    $pg = (int)$_GET['posts'];
  } else {
    $pg = 1;
  }

  $maximo = 10;
  $inicio = (($pg * $maximo) - $maximo)+3;  
  
  $seleciona = select($select='*', $table='dp_posts', $orderby='ORDER BY id DESC', $limit='LIMIT '.$inicio.', '.$maximo.'');
  $conta = mysqli_num_rows($seleciona);

  if($conta <= 0) {
    echo '<span class="pagina-404">Nada encontrado!</span>';
  } else {
    while($row = mysqli_fetch_array($seleciona, MYSQLI_ASSOC)){

      $id = $row['id'];
      $ministerio = $row['ministerio'];
      $categoria = $row['categoria'];
      $titulo = $row['titulo'];
      $resumo = $row['resumo'];
      $imagem = $row['imagem'];
      $imagem = "'".$imagem."'";        
      $data = $row['data'];
      $hora = $row['hora'];


?>


    <div id="posts-holder">
      <a href="./pagina/post.php?post=<?php echo $id ?>"></a>

      <?php if(empty($imagem)){}else{echo '<div id="post-imagem" style="background: #03bfb7; background: url('.$imagem.'); background-size: cover; background-position: center; background-blend-mode: multiply"></div>';}?>

      <div id="post-textos">

        <div id="ministerio">
          <p><?=$ministerio?></p>
        </div>

        <div id="post-categoria">
          <p><?php echo $categoria ?> <span class="gray"> * HÁ <?php echo horas($data, $hora); ?></span></p>
        </div>

        <div id="post-titulo">
          <p><?php echo $titulo ?></p>
        </div>

        <div id="post-resumo">
          <p><?php echo $resumo ?></p>
        </div>
      </div>
    </div>    

<?php }}?>

  </div>

  <?php

  date_default_timezone_set('America/Sao_Paulo');
  $ddd = date("d")-1; if($ddd<10){$ddd='0'.$ddd;}    
  $mmm = date("m");      

  $query = select($select="*", $table="dp_agenda", $where='WHERE mes = '.$mmm.' AND dia > '.$ddd.' AND categoria = "culto"', $orderby='ORDER BY mes ASC, dia ASC', $limit='LIMIT 1');    
  $result= mysqli_num_rows($query);    

  if($result > 0) {
    while($result = mysqli_fetch_assoc($query)){
      $mes = $result['mes'];
      $descri = $result['descri'];      
      $dia = $result['dia'];
      $categoria = $result['categoria'];
    }    
  } else {    
    
    $query = select($select='*', $table='dp_agenda', $where='WHERE mes > '.$mmm.' AND categoria = "culto"', $orderby='ORDER BY mes ASC, dia ASC', $limit='LIMIT 1');    
    $result= mysqli_num_rows($query);

    while($result = mysqli_fetch_assoc($query)){
      $mes = $result['mes'];
      $evento = $result['evento'];      
      $dia = $result['dia'];
      $materia = $result['materia'];
    }
  }



  ?>

  <div id="right-column">
    <div id="agenda">
      <div class="titulo-evento">
        <p><?=$categoria?></p>
      </div>

      <div class="content-evento">
        <p><?=$descri?> <?=$dia?>/<?=$mes?></p>
      </div>
    </div>

    <div id="quemsomos">
      <h3>Quem somos</h3>

      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>

    <div id="img-sector">            
    </div>

  </div>
</div>

<div id="full-default">
  <nav id="nav">
    <ul class="pagination">
      <?php
        $seleciona = select($select='*', $table='dp_posts');
        $totalPosts = mysqli_num_rows($seleciona);

        $pags = ceil($totalPosts / $maximo);
        $links = 2;

        echo '<li><a href="?pagina=inicio&posts=1#posts-holder" aria-label="Página Inicial"><span aria-hidden="true">&laquo;</span></a></li>';

        for($i=$pg;$i <= $pg -1;$i++){
          if($i <= 0) {

          } else {
            echo '<li><a href="?pagina=inicio&posts='.$i.'#posts-holder">'.$i.'</a></li>';
          }
        }

        echo '<li><a href="?pagina=inicio&posts='.$pg.'#posts-holder">'.$pg.'</a></li>';

        for($i = $pg + 1;$i <= $pg + $links;$i++){
          if($i > $pags){

          } else {
            echo '<li><a href="?pagina=inicio&posts='.$i.'#posts-holder">'.$i.'</a></li>';
          }
        }

        echo '<li><a href="?pagina=inicio&posts='.$pags.'#posts-holder" aria-label="Última Página"><span aria-hidden="true">&raquo;</span></a></li>';

      ?>
    </ul>
  </nav>
</div>
