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
		$query = "SELECT * FROM obra ORDER BY id_obra;";
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
		if(isset($_POST["nom_obra"]))
		{
			$form_data = array(
				':nom_obra'		    =>	$_POST["nom_obra"],
				':direccion'		        =>	$_POST["direccion"]
			);
			$query = "
			INSERT INTO obra
			(nom_obra,direccion) VALUES 
			(:nom_obra,:direccion);
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
		$query = "SELECT * FROM obra where id_obra='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_obra'] = $row['id_obra'];
				$data['nom_obra'] = $row['nom_obra'];
				$data['direccion'] = $row['direccion'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nom_obra"]))
		{
			$form_data = array(
				':nom_obra'		    =>	$_POST["nom_obra"],
				':direccion'		    =>	$_POST["direccion"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE obra
			SET nom_obra = :nom_obra
				,direccion = :direccion
				 
			WHERE id_obra = :id
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
		$query = "DELETE FROM obra WHERE id_obra = '".$id."'";
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