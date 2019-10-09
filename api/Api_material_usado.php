<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=constructora", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM material_usado ORDER BY id_uso;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["cantidad1"]))
		{
			$form_data = array(
				':cantidad1'		    =>	$_POST["cantidad1"],
				':descripcion_uso'		        =>	$_POST["descripcion_uso"],
				':id_material'		        =>	$_POST["id_material"]
			);
			$query = "
			INSERT INTO material_usado
			(cantidad1,descripcion_uso,id_material) VALUES 
			(:cantidad1,:descripcion_uso,:id_material);
			";

			$query2 = "UPDATE almacen SET 
				cantidad = cantidad - '$_POST[cantidad1]' WHERE id_material='$_POST[id_material]'";
		
		/*$sql = "UPDATE almacen SET cantidad = cantidad - " . $_REQUEST["cantidad1"] 
		. " WHERE id_material = " . $_REQUEST["id_material"];*/
			/*if(isset($_POST["cantidad"])) {
		    $cantidad = $_POST['cantidad1'];
				$cantidad = $_POST['cantidad'];
				$id_material = $_POST['id_material'];//el codigo del articulo
				$id_material = $_POST['id_material'];// codigo del articulo que es el mismo que el de arriba
				while($cantidad1 >= $cantidad){
				$actualizacion = "UPDATE almacen SET cantidad = cantidad1 - $cantidad WHERE $id_material= $id_material";
				
				}
			}*/

			/*if ($id_material,$cantidad) {
				$query"SELECT cantidad FROM almacen WHERE cantidad = $cantidad1 AND id_material = $id_material
            UPDATE almacen
            SET cantidad = cantidad1 - cantidad 
            WHERE cantidad = cantidad1 AND id_material = $id_material";
			}
		
        else
            echo "NO PUEDES REALIZAR LA VENTA, DEBIDO A QUE NO HAY PRODUCTOS EN STOCK";

       */
			$statement = $this->connect->prepare($query);
			/*self::descontar($cantidad,1);*/
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
			$statement = $this->connect->prepare($query2);
			/*self::descontar($cantidad,1);*/
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		
		

		return $data;
	}
/*public function descontar($id_material,$cantidad)
{

		$sql="SELECT cantidad
		from almacen
		where id_material='$id_material'";
		$result=mysql_query($conexion,$sql);
		$cantidad=mysql_fetch_row($result);
		$cantidadNueva=abs($cantidad - $cantidad);
		sql="UPDATE almacen set cantidad='cantidadNueva'
		where id_material=$id_material'";
		mysql_query($conexion,$sql);
}*/
	 
	function fetch_single($id)
	{
		$query = "SELECT * FROM material_usado where id_uso='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_uso'] = $row['id_uso'];
				$data['cantidad1'] = $row['cantidad1'];
				$data['descripcion_uso'] = $row['descripcion_uso'];
				$data['id_material'] = $row['id_material'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["cantidad1"]))
		{
			$form_data = array(
				':cantidad1'		    =>	$_POST["cantidad1"],
				':descripcion_uso'		    =>	$_POST["descripcion_uso"],
				':id_material'	            =>	$_POST["id_material"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
				SET cantidad1 = :cantidad1
					,descripcion_uso = :descripcion_uso
					,id_material = :id_material
					 
				WHERE id_uso = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM material_usado WHERE id_uso = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>