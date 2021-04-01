<?php 
    

	
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['categoria']) || empty($_POST['descripcion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$codcategoria = $_POST['id'];
			$categoria=$_POST['categoria'];
			$descripcion = $_POST['descripcion'];
			
			
			$result=0;

			



				$sql_update = mysqli_query($conection,"UPDATE  categoria
															SET categoria = '$categoria', descripcion='$descripcion'
															WHERE id_categoria= $codcategoria ");
				

				if($sql_update){
					$alert='<p class="msg_save">Categoria actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la categoria.</p>';
				}

			}


		}

	

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_categoria.php');
		mysqli_close($conection);
	}
	$codcategoria = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT *  FROM categoria
									WHERE id_categoria= $codcategoria");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_categoria.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$codcategoria  = $data['id_categoria'];
		
			$categoria  = $data['categoria'];


			$descripcion  = $data['descripcion'];
			
		

		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Categoria</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar categoria</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

                <input type="hidden" name="id" value="<?php echo $codcategoria; ?>" >
				<label for="categoria">Categoria</label>
				<input type="text" name="categoria" id="categoria" placeholder="Categoria" value="<?php echo $categoria ?>">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion de la categoria" value="<?php echo $descripcion ?>" >
				

				
				<input type="submit" value="Guardar categoria" class="btn_save">

			</form>

		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>