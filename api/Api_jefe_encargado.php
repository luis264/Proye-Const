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
		$query = "SELECT * FROM jefe_encargado ORDER BY id_jefe;";
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
		if(isset($_POST["nom_jefe"]))
		{
			$form_data = array(
				':nom_jefe'		    =>	$_POST["nom_jefe"],
				':id_tipo'		        =>	$_POST["id_tipo"]
			);
			$query = "
			INSERT INTO jefe_encargado
			(nom_jefe,id_tipo) VALUES 
			(:nom_jefe,:id_tipo);
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
		$query = "SELECT * FROM jefe_encargado where id_jefe='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_jefe'] = $row['id_jefe'];
				$data['nom_jefe'] = $row['nom_jefe'];
				$data['id_tipo'] = $row['id_tipo'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nom_jefe"]))
		{
			$form_data = array(
				':nom_jefe'		    =>	$_POST["nom_jefe"],
				':id_tipo'		    =>	$_POST["id_tipo"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE jefe_encargado
			SET nom_jefe = :nom_jefe
				,id_tipo = :id_tipo
				 
			WHERE id_jefe = :id
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
		$query = "DELETE FROM jefe_encargado WHERE id_jefe = '".$id."'";
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