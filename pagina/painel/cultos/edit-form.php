<div id="posts-titulo"><p>Mude somente os campos que quer editar</p></div>
    
<form action="" method="POST" enctype="multipart/form-data" class="form-class">

	<div id="texto-form"><p>Pregador</p></div>
  <input type="text" name="pregador" class="form-input" placeholder="Pregador" value="<?php echo $pregador ?>" />

  <div id="texto-form"><p>Titulo</p></div>
  <input type="text" name="titulo" class="form-input" placeholder="Título" value="<?php echo $titulo ?>" />

  <div id="texto-form"><p>Resumo</p></div>
  <input type="text" name="resumo" class="form-input" placeholder="Título" value="<?php echo $resumo ?>" />

  <div id="texto-form"><p>Tags</p></div>
  <input type="text" name="tags" class="form-input" placeholder="Separar tags por vírgula" value="<?=$tags ?>" />

  <div id="texto-form"><p>Aúdio de baixa qualidade</p></div>
  <input type="file" name="baixa" class="form-input" />  

  <div id="texto-form"><p>Aúdio de média qualidade</p></div>
  <input type="file" name="media" class="form-input" />  

  <div id="texto-form"><p>Aúdio de Alta qualidade</p></div>
  <input type="file" name="alta" class="form-input" />  

  <div id="texto-form"><p>Aúdio zipado</p></div>
  <input type="file" name="zip" class="form-input" />  

  <div id="texto-form"><p>Data do evento</p></div>
  <input type="date" name="data" class="form-input" value="<?=$data?>" />  

  <div id="texto-form"><p>Conteúdo da postagem</p></div>
  <textarea name="conteudo" class="form-input" id="conteudo"><?=$conteudo?></textarea>
  <script>CKEDITOR.replace('conteudo');</script>

	<input type="submit" value="Confirmar" id="enviar"/>
	<input type="hidden" name="enviar" value="send" />

</form>