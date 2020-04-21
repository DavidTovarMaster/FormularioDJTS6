<?php 
extract($_REQUEST);
$data=unserialize($data);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Lista de categorias</title>
 	<script type="text/javascript">
 		function eliminar(id){
 			if(confirm("seguro desea eliminar el registro?")){
 				window.location="/PersonasControlador.php?operacion=eliminar&id_persona="+id;
 			}
 		}
 	</script>
 </head>
 <body>
 	<table align="center">
 		<a href="../index.php">Inicio</a>
 		<center><a href="PersonasControlador.php?operacion=registrar">Registrar</a></center>
 		<tr><th>Nro</th><th>Nombres</th><th>Apellidos</th><th>Cedula</th><th>Opciones</th></tr>
 		<?php $num=1;
 			for ($i=0; $i < $filas; $i++){
 				echo "<tr>";
 		 ?>
 		 <td><?=$num?></td>
 		 <?php for ($j=1; $j < $campos; $j++) { ?>
 		 	<td><?=$data[$i][$j]?></td>
 		 <?php } ?>
 		 <td><a href="PersonasControlador.php?operacion=modificar&id_persona=<?=$data[$i][0]?>">Modificar</a>
 		 	<a href="javascript:eliminar(<?=$data[$i][0]?>)">Eliminar</a>
 		 </td>
 		 <?php 
 		 	$num++;
 		 } ?>
 	</table>
 
 </body>
 </html>