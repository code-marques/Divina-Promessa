<?php          
  $query = select($select='*', $table='dp_cultos', $orderby='ORDER BY id DESC', $limit='LIMIT 3');
  $row = mysqli_num_rows($query);      

  if($row > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
      $id = $row['id'];
      $categoria = $row['pregador'];
      $resumo = $row['resumo'];
      $imagem = './img/pregadores/'.$categoria.'.jpg';      
?>

  <div id="news" style="background: radial-gradient(transparent, #222), url('<?=$imagem?>'); background-size: cover; background-position: center; background-blend-mode: multiply"><a href="./cultos/post.php?post=<?php echo $id ?>"></a><h2><?=$categoria?></h2><p><?=$resumo?></p></div>

<?php }} ?>

</div>
</div>

<div id="full-default">
  <div id=body-full-cultos>
   <div id="cultos-full-posts">

<?php 

  if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];    
  } else {
    $pagina = 0;
  }

  $link = DBConnect();
  $query = "SELECT * FROM dp_cultos ORDER BY id DESC LIMIT 3, 10";  
  $select = mysqli_query($link, $query);
  $row = mysqli_num_rows($select);

  if($row < 1) {
    echo 'erro';
  } else {
    while ($row = mysqli_fetch_assoc($select)) {
      $id = $row['id'];
      $img = $row['pregador'];
      $data = $row['data'];
      $titulo = $row['titulo'];
      $resumo = $row['resumo'];
      $tags = $row['tags'];      
?>

<div id="cultos-holder">
  <div id="culto-post" style="background: linear-gradient(transparent, #222), url('./img/pregadores/<?=$img?>.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
    
    <a href="./cultos/post.php?post=<?php echo $id ?>"><div id="abso-back"></div></a>

    <div id="abso-img">    
      <a href="./cultos/post.php?post=<?php echo $id ?>"><img src="./ico/follow.png" alt="ouvir pregação" /></a>
    </div>



    <div class="culto-img" style="background: transparent;"></div>

    <div id="cultos-label">
      <div class="data"><p><?=$img?></p></div>
      <div id="title-<?=$id?>" class="titulo"><p><?=$titulo?></p></div>      
      <div class="tags"><p><?=$tags?></p></div>
    </div>
  </div>
</div>      

<?php }} ?>

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

      <div id="quemsomos">
        <h3>Quem somos</h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>  
  </div>
</div>





