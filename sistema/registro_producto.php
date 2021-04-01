
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

		if(empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['precio'])|| empty($_POST['cantidad'])) 
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $categoria = $_POST['categoria'];
			$producto = $_POST['producto'];
			$precio  = $_POST['precio'];
			$cantidad   = $_POST['cantidad'];
       		$usuario_id = $_SESSION['idUser'];	

       		
			


			 $result=0;

			
			 $query_insert = mysqli_query($conection,"INSERT INTO producto(categoria,producto,precio,cantidad,usuario_id)
																	VALUES('$categoria','$producto','$precio','$cantidad','$usuario_id')");

		    if($query_insert){

			
				$alert='<p class="msg_save">Producto guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el producto.</p>';
		     }
			
       

        }
    

		
			
         
     }
		

	



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1> <i class ="far fa-building"></i> Registro Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="categoria">Categoria</label>
				<?php

				     $query_categoria=mysqli_query($conection," SELECT * FROM categoria WHERE estatus=1 ");
				     mysqli_close($conection);
				     $result_categoria=mysqli_num_rows($query_categoria);
				    
				     
				 ?>
                 <select name="categoria" id="categoria">
                 <?php 
                       if($result_categoria>0)
                       {
                       	while($categoria=mysqli_fetch_array($query_categoria)) {             	  	# code...

                  ?>

                 	  <option value="<?php echo $categoria["id_categoria"]; ?> "><?php echo $categoria["categoria"]; ?></option>
                
                <?php

                        }
                     }

                  
                ?>

                </select>


				<label for="producto">Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto" >
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del producto" step="any">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del Producto">
				
              



				
				<input type="submit" value="Guardar Producto" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>