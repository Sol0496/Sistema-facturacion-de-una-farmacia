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

		if(empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['precio'])|| empty($_POST['id'])) 
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            

            
            $codproducto = $_POST['id'];
            $categoria = $_POST['categoria'];
			$producto = $_POST['producto'];
			$precio  = $_POST['precio'];
		//	$cantidad   = $_POST['cantidad'];
       //		$usuario_id = $_SESSION['idUser'];	

       		
			


			 $result=0;

			
			 $query_update = mysqli_query($conection,"UPDATE producto
			 	                                              SET 
			 	                                                  categoria=$categoria,
			 	                                                  producto='$producto',
			 	                                                  precio=$precio
			 	                                                  

			 	                                                  WHERE codproducto=$codproducto");

		    if($query_update){

			
				$alert='<p class="msg_save">Producto actualizado correctamente.</p>';
				
				}else{
				
				$alert='<p class="msg_error">Error al actualizar el producto.</p>';
		     }
			
       

        }
    

		
	}		
         
    

     if(empty($_REQUEST['id']))
     {
        header("location: lista_producto.php");

      }else
          {
             $id_producto=$_REQUEST['id'];
             if(!is_numeric($id_producto))
             {
             	 header("location: lista_producto.php");
             } 

           $query_producto=mysqli_query($conection," SELECT p.codproducto ,p.producto,p.precio,p.cantidad,c.id_categoria,
           	c.categoria FROM producto p inner join categoria c WHERE p.estatus = 1  ");   
           $result_producto=mysqli_num_rows($query_producto);
           if($result_producto > 0)
               {
                  $data_producto=mysqli_fetch_assoc($query_producto);
                  
                //  print_r($data_producto);
				    
               }else
               {
               	  header("location: lista_producto.php");
               }

          
		

   	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1> <i class ="far fa-building"></i>Actualizar Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

				<input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>" >
				<label for="categoria">Categoria</label>
				<?php

				     $query_categoria=mysqli_query($conection," SELECT * FROM categoria WHERE estatus=1 ");
				     mysqli_close($conection);
				     $result_categoria=mysqli_num_rows($query_categoria);
				    
				     
				 ?>
                 <select name="categoria" id="categoria" class="notItemOne">
                 	<option  value="<?php echo $data_producto['id_categoria']; ?>" selected><?php echo $data_producto['categoria']; ?></option>
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
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto" value="<?php echo $data_producto["producto"]; ?>">
				<label for="precio">Precio</label>
				<input type="text" name="precio" id="precio" placeholder="Precio del producto"value="<?php echo $data_producto["precio"]; ?>">
				
              


				
				<input type="submit" value="Actualizar Producto" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>