<?php 
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{  

		if(empty($_POST['codcategoria']))
		{
			header("location: lista_categoria.php");
			mysqli_close($conection);
		}
		
		$codcategoria = $_POST['codcategoria'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE categoria SET estatus = 0 WHERE id_categoria = $codcategoria ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_categoria.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id'])  )
	{
		header("location: lista_categoria.php");
		mysqli_close($conection);
	}else{

		$codcategoria = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT * FROM categoria WHERE id_categoria = $codcategoria ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				
				$codcategoria = $data['id_categoria'];
				$categoria = $data['categoria'];
				
			}
		}else{
			header("location: lista_categoria.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Categoria: <span><?php echo $categoria; ?></span></p>
			<form method="post" action="">
				<input type="hidden" name="codcategoria" value="<?php echo $codcategoria; ?>">
				<a href="lista_proovedor.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok"> 
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>