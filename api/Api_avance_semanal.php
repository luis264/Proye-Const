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
		$query = "SELECT * FROM avance_semanal ORDER BY id_semana;";
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
		if(isset($_POST["descripcion"]))
		{
			$form_data = array(
				':descripcion'		    =>	$_POST["descripcion"],
				':id_tipo'		        =>	$_POST["id_tipo"],
				':id_jefe'		        =>	$_POST["id_jefe"]
			);
			$query = "
			INSERT INTO avance_semanal
			(descripcion,id_tipo,id_jefe) VALUES 
			(:descripcion,:id_tipo,:id_jefe);
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
		$query = "SELECT * FROM avance_semanal where id_semana='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_semana'] = $row['id_semana'];
				$data['descripcion'] = $row['descripcion'];
				$data['id_tipo'] = $row['id_tipo'];
				$data['id_jefe'] = $row['id_jefe'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["descripcion"]))
		{
			$form_data = array(
				':descripcion'		    =>	$_POST["descripcion"],
				':id_tipo'		    =>	$_POST["id_tipo"],
				':id_jefe'		    =>	$_POST["id_jefe"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE avance_semanal
			SET descripcion = :descripcion
				,id_tipo = :id_tipo
				,id_jefe = :id_jefe
				 
			WHERE id_semana = :id
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
		$query = "DELETE FROM avance_semanal WHERE id_semana = '".$id."'";
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