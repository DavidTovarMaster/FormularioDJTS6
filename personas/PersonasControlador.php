<?php 
include("..clasedb.php");
extract($_REQUEST);

class PersonasControlador
{

public function index(){
	$db=new clasedb();//instanciando clasedb
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT * FROM datos_personales";//query

	$res=mysqli_query($conex,$sql);//ejecutando query
	$campos=mysqli_num_fields($res);//cuantos campos trae la consulta
	$filas=mysqli_num_rows($res);//cuantos registros trae la consulta
	$i=0;
	$datos[]=array();//inicializando array
	//extrayendo datos
	while($data=mysqli_fetch_array($res)){
		for ($j=0; $j <$campos ; $j++){
			$datos[$i][$j]=$data[$j];
		}
		$i++;
	}
	mysqli_close($conex);
		//enviando datos
		header("Location: index.php?filas=".$filas."&campos=".$campos."&data".serialize($datos));
}//fin de la funcion index
	}


public function modificar(){
		extract($_REQUEST);//extrayendo valores de url
		$db=new clasedb();
		$conex=$db->conectar();//conectando con la base de datos

		$sql="SELECT * FROM datos_personales WHERE id=".$id_persona."";
		$res=mysqli_query($conex,$sql); //ejecutando consulta
		$data=mysql_fetch_array($res); //extrayendo datos en array

		header("Location: editar.php?data=".serialize($data));
	}

	public function actualizar()
	{
		extract($_POST); //Extrayendo variable del formulario
		$db=new clasedb();
		$conex=$db->conectar();//conectando con la base de datos

		$sql="SELECT * FROM datos_personales WHERE cedula=".$cedula." AND id<>".$id_persona; //echo $sql
		$res=mysqli_query($conex,$sql);
		$cant=mysqli_num_rows($res);//trae cuantos registros trae la consulta
		    if ($cant>0) {
		    	?>
		    	<script type="text/javascript">
		    		alert("CEDULA YA REGISTRADA");
		    		window.location="PersonasControlador.php?operacion=index";
		    	</script>
		    	<?php
		    }else{
		    	$sql="UPDATE datos_personales SET nombres='".$nombres."',apellidos='".$apellidos."',cedula=".$cedula." WHERE id="-$id_persona;
		    	$res=mysqli_query($conex,$sql);
		    	if($res) {
		    		?> 
		    		<script type="text/javascript">
		    		alert("REGISTRO MODIFICADO");
		    		window.location="PersonasControlador.php?operacion=index";
		    		</script>
		    		<?php
		    	} else {
		    		?>
		    		<script type="text/javascript">
		    			alert("ERROR AL MODIFICAR EL REGISTRO");
		    			window.location="PersonasControlador.php?operacion=index";
		    		</script>
		    		<?php
		    	}
		    }
	} //Fin de la funcion actualizar


	public function eliminar()
	{
		extract($_REQUEST);//extrayendo variables del url
		$db=new clasedb();
		$conex=$db->conectar();//conectando con la base de datos

		$sql="DELETE FROM datos_personales WHERE id=".$id_persona;

			$res=mysqli_query($conex,$sql);
			if ($res){
				?>
					<script type="text/javascript">
						alert("REGISTRO ELIMINADO");
						window.location="PersonasControlador.php?operacion=index";
					</script>
				<?php
			}else{
				?>
					<script type="text/javascript">
						alert("REGISTRO NO ELIMINADO");
						window.location="PersonasControlador.php?operacion=index";
					</script>
				<?php
			}
	}

	static function controlador($operacion){
		$persona=new PersonasControlador();

	switch ($operacion) {
		case 'index':
			$persona->index();
			break;
		
		case 'registrar':
			$persona->registrar();
			break;

		case 'guardar':
			$persona->guardar();
			break;

		case 'modificar':
			$persona->modificar();
			break;

		case 'actualizar':
			$persona->actualizar();
			break;

		case 'eliminar':
			$persona->eliminar();
			break;
		default:
 		?>
 			<script type="text/javascript">
 				alert("No existe la ruta");
 				window.location="PersonasControlador.php?operacion=index";
 			</script>
 			<?php 
 			break;
 		}// cierre del switch
 	}//cierre de la funcion controlador
 }//Cierre de la clase personas controlador

 PersonasControlador::controlador($operacion);