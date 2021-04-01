<?php 
    
    session_start();
    
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
	{
		header("location: ./");
	}
	

	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])  )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idCliente = $_POST['id'];
			$DNI=$_POST['DNI'];
			$nombre = $_POST['nombre'];
			$telefono  = $_POST['telefono'];
			$direccion   = $_POST['direccion'];
			
			$result=0;

			if(is_numeric($DNI))
			{

                $query = mysqli_query($conection,"SELECT * FROM cliente
													   WHERE (DNI = '$DNI' AND idcliente != $idCliente)");    


                $result = mysqli_fetch_array($query);
             

			}



			if($result > 0){
				$alert='<p class="msg_error">El DNI ya existe.</p>';
			}else{

				if($DNI==' ') 
				{

					$DNI=0;
				}

				$sql_update = mysqli_query($conection,"UPDATE cliente
															SET DNI = '$DNI', nombre='$nombre',telefono='$telefono',direccion='$direccion'
															WHERE idcliente= $idCliente ");
				

				if($sql_update){
					$alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el cliente.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_clientes.php');
		mysqli_close($conection);
	}
	$idcliente = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT *  FROM cliente
									WHERE idcliente= $idcliente ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_clientes.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idcliente  = $data['idcliente'];
			$DNI  = $data['DNI'];
			$nombre  = $data['nombre'];
			$telefono = $data['telefono'];
			$direccion   = $data['direccion'];
			
		

		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idcliente; ?>" >
				<label for="DNI">DNI</label>
				<input type="number" name="DNI" id="DNI" placeholder="Numero de DNI" value="<?php echo $DNI; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value= "<?php echo $nombre; ?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completa" value="<?php echo $direccion; ?>">
				

				
				<input type="submit" value="Guardar cliente" class="btn_save">

			</form>

		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>