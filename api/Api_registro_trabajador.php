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
		$query = "SELECT * FROM registro_trabajador ORDER BY id_trabajador;";
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
		if(isset($_POST["nombres"]))
		{
			$form_data = array(
				':nombres'		    =>	$_POST["nombres"],
				':apellidos'		        =>	$_POST["apellidos"],
				':id_tipo'		    =>	$_POST["id_tipo"],
				':id_jefe'		        =>	$_POST["id_jefe"],
				':id_rango'		        =>	$_POST["id_rango"],
				':id_obra'		        =>	$_POST["id_obra"],
				':id_salario'		        =>	$_POST["id_salario"]
			);
			$query = "
			INSERT INTO registro_trabajador
			(nombres,apellidos,id_tipo,id_jefe,id_rango,id_obra,id_salario) 
			VALUES 
			(:nombres,:apellidos,:id_tipo,:id_jefe,
				:id_rango,:id_obra,:id_salario);
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

	function fetch_single($id)
	{
		$query = "SELECT * FROM registro_trabajador where id_trabajador='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_trabajador'] = $row['id_trabajador'];
				$data['nombres'] = $row['nombres'];
				$data['apellidos'] = $row['apellidos'];
				$data['id_tipo'] = $row['id_tipo'];
				$data['id_jefe'] = $row['id_jefe'];
				$data['id_rango'] = $row['id_rango'];
				$data['id_obra'] = $row['id_obra'];
				$data['id_salario'] = $row['id_salario'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nombres"]))
		{
			$form_data = array(
				':nombres'		    =>	$_POST["nombres"],
				':apellidos'		    =>	$_POST["apellidos"],
				':id_tipo'		    =>	$_POST["id_tipo"],
				':id_jefe'		    =>	$_POST["id_jefe"],
				':id_rango'		    =>	$_POST["id_rango"],
				':id_obra'		    =>	$_POST["id_obra"],
				':id_salario'		    =>	$_POST["id_salario"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE registro_trabajador
			SET nombres = :nombres
				,apellidos = :apellidos
				,id_tipo = :id_tipo
				,id_jefe = :id_jefe
				,id_rango = :id_rango
				,id_obra = :id_obra
				,id_salario = :id_salario
				 
			WHERE id_trabajador = :id
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
		$query = "DELETE FROM registro_trabajador WHERE id_trabajador = '".$id."'";
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