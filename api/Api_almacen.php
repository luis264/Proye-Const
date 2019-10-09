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
		$query = "SELECT * FROM almacen ORDER BY id_almacen;";
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
		if(isset($_POST["cantidad"]))
		{
			$form_data = array(
				':cantidad'		    =>	$_POST["cantidad"],
				':id_material'		        =>	$_POST["id_material"]
			);
			$query = "
			INSERT INTO almacen
			(cantidad,id_material) VALUES 
			(:cantidad,:id_material);
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
		$query = "SELECT * FROM almacen where id_almacen='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_almacen'] = $row['id_almacen'];
				$data['cantidad'] = $row['cantidad'];
				$data['id_material'] = $row['id_material'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["cantidad"]))
		{
			$form_data = array(
				':cantidad'		    =>	$_POST["cantidad"],
				':id_material'		    =>	$_POST["id_material"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE almacen
			SET cantidad = :cantidad
				,id_material = :id_material
				 
			WHERE id_almacen = :id
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
		$query = "DELETE FROM almacen WHERE id_almacen = '".$id."'";
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