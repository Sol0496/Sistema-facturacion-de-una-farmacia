<?php 
	session_start();

	
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de categorias</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de categorias</h1>
		<a href="registro_categoria.php" class="btn_new">Crear categoria</a>
		
		<form action="buscar_categoria.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Categoria</th>
				<th>Descripcion</th>
				<th>Fecha</th>
				<th>Acciones</th>

			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM categoria WHERE estatus = 1 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT * FROM categoria WHERE estatus = 1 ORDER BY id_categoria ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {

					$formato='Y-m-d H:i:s';
					$fecha=DateTime::createFromFormat($formato,$data["dateadd"])
					
			?>
				<tr>
					<td><?php echo $data["id_categoria"]; ?></td>
					<td><?php echo $data["categoria"]; ?></td>
					<td><?php echo $data["descripcion"]; ?></td>
					<td><?php echo $fecha->format('d-m-Y'); ?></td>
					<td>
					<?php if($_SESSION['rol']==1 || $_SESSION['rol']==2 ) { ?>
						<a class="link_edit" href="editar_categoria.php?id=<?php echo $data["id_categoria"]; ?>">Editar</a>

					
						<a class="link_delete" href="eliminar_confirmar_categoria.php?id=<?php echo $data["id_categoria"]; ?>">Eliminar</a>
					
					<?php } ?>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>