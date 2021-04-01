<?php 
	session_start();
	
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';

		if(empty($_POST['categoria']) || empty($_POST['descripcion'])  )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $categoria = $_POST['categoria'];
			$descripcion = $_POST['descripcion'];
			$usuario_id = $_SESSION['idUser'];
			
			$result=0;

			
				$query_insert = mysqli_query($conection,"INSERT INTO categoria(categoria,descripcion,usuario_id)
																	VALUES('$categoria','$descripcion','$usuario_id')");

				if($query_insert){
					$alert='<p class="msg_save">Categoria guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar la categoria.</p>';
				}
			}


		
			mysqli_close($conection);


		}

	



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Categoria</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro categoria</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="categoria">Categoria</label>
				<input type="text" name="categoria" id="categoria" placeholder="Categoria">
				<label for="descripcion">Descripcion</label>
				<textarea  type="text" name="descripcion" id="descripcion" rows="4" cols="50" placeholder="Descripcio de la categoria"></textarea>
				
				<input type="submit" value="Guardar categoria" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>