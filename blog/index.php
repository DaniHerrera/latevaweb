<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	  <link rel="stylesheet" type="text/css" href="<?php echo '/blog/css/styles.css'; ?>">
	<title></title>
</head>

<body>

<div class="container-fluid">
	<h1 class="jumbotron text-center">MY BLOG</h1>
	<?php 
	$arrayConfig = array();
	include_once(dirname(__FILE__).'./classes/serverConfig.php'); 
	include_once(dirname(__FILE__).'./classes/post.php');
	$oConfig = new serverConfig();
	$arrayConfig = $oConfig->allConfig();
	$oPost = new Post($arrayConfig[0],$arrayConfig[1],$arrayConfig[2],$arrayConfig[3]);

	$tpl = "<form method='post' action='/blog/files/processdata.php'>";
	$tpl .=  "<table class='table table-striped'>";
	$tpl .= "<thead>";
	$tpl .= "<tr>";
	$tpl .="<th>TITULO DEL POST</th>";
	$tpl .= "<th>CONTENIDO DEL POST</th>";
	$tpl .= "<th>FECHA PUBLICACIÓN</th>";
	$tpl .= "<th></th>";
	$tpl .= "</tr>";
	$tpl .= "</thead>";
	$tpl .= "<tbody>";
	$tpl .= $oPost->selectAllPosts();
	$tpl .= "</tbody>";
	$tpl .= "</table>";
	$tpl .= "</form>";
	$tpl .= "<div id='nuevoPost' class='btn btn-success'>Nuevo Post</div>";

	echo $tpl;

	?>
</div>
	
<div id="insercionPost" class="espacio container-fluid d-none">
	<h3>CREAR NUEVO POST - Consulta por ajax</h3>
	<form>
	  <div class="form-group">
	    <label for="postTitle">Post Title</label>
	    <input type="text" class="form-control" name="postTitle" id="postTitle" aria-describedby="emailHelp" placeholder="Título del post">
	    <small id="emailHelp" class="form-text text-muted">Introduce el título de tu post</small>
	  </div>
	  <div class="form-group">
    <label for="postContent">Post Content</label>
    <textarea class="form-control" name="postContent" id="postContent" rows="3" placeholder="Contenido del post"></textarea>
  </div>
	  <button type="button" id="buttonInsert" class="btn btn-primary">Insertar</button>
	</form>
	<div id="insertProcessVerification"></div>
</div>

<div id="actualizarPost" class="espacio container-fluid d-none">
	<h3>ACTUALIZAR POST - Implemento validación por jquery</h3>
	<form data-toggle="validator" method="post" action="<?php echo '/blog/files/processdataUpdate.php'; ?>">

	  <div class="form-group">
	    <label for="updateTitle">Título del post</label>
	    <input type="text" data-minlength="6" class="form-control" name="updateTitle" id="updateTitle" aria-describedby="emailHelp" value="" required>
	    <div class="help-block">Mínimo de 6 carácteres</div>
	  </div>

	  <div class="form-group">
    	<label for="updateContent">Contenido del post</label>
    	<textarea class="form-control" data-minlength="20" name="updateContent" id="updateContent" rows="3" value="" required></textarea>
    	<div class="help-block">Mínimo de 20 carácteres</div>
	  </div>

	  <div class="form-group">
	    <label for="updateFecha">Fecha</label>
	    <input type="text" class="form-control" name="updateFecha" id="updateFecha" aria-describedby="emailHelp" value="" required>
	  </div>

	  <input id='updateId' name='updateId' type='hidden' value=''>

	  <button type="submit" class="btn btn-primary">Actualizar</button>
	</form>
</div>


 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

  <script type='text/javascript'>
	$("#nuevoPost").click(function(){
    	$("#insercionPost").toggleClass('d-none');
	}); 
</script>

 <script type='text/javascript'>
	$(".updateButton").click(function(){

		var postId = $(this).attr('data-id');
		$("#updateId").val(postId);
		var postTitle = $(this).attr('data-title');
		$("#updateTitle").val(postTitle);
		var postContent = $(this).attr('data-content');
		$("#updateContent").val(postContent);
		var postFecha = $(this).attr('data-fecha');
		$("#updateFecha").val(postFecha);

    	$("#actualizarPost").toggleClass('d-none');
	}); 
</script>

<script type='text/javascript'>

	   $("#buttonInsert").click(function(){

			var postTitle = $("#postTitle").val();
			var postContent = $("#postContent").val();
	        var parametros = {"postTitle" : postTitle, "postContent" : postContent};

		        $.ajax({
		        	data: parametros,
		        	url: "/blog/files/processdataInsert.php",
		        	type: 'post',

		        	success: function(result){
		            	$("#insertProcessVerification").html(result);
		    	    }
		    });
	    });
	
</script>

</body>
</html>