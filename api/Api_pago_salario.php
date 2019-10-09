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
		$query = "SELECT * FROM pago_salario ORDER BY id_pago;";
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
		if(isset($_POST["id_trabajador"]))
		{
			$form_data = array(
				':id_trabajador'		    =>	$_POST["id_trabajador"],
				':id_jefe'		        =>	$_POST["id_jefe"],
				':total_pago'		        =>	$_POST["total_pago"]
			);
			$query = "
			INSERT INTO pago_salario
			(id_trabajador,id_jefe,total_pago) VALUES 
			(:id_trabajador,:id_jefe,:total_pago);
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
		$query = "SELECT * FROM pago_salario where id_pago='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_pago'] = $row['id_pago'];
				$data['id_trabajador'] = $row['id_trabajador'];
				$data['id_jefe'] = $row['id_jefe'];
				$data['total_pago'] = $row['total_pago'];
				
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["id_trabajador"]))
		{
			$form_data = array(
				':id_trabajador'		    =>	$_POST["id_trabajador"],
				':id_jefe'		    =>	$_POST["id_jefe"],
				':total_pago'		    =>	$_POST["total_pago"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE pago_salario
			SET id_trabajador = :id_trabajador
				,id_jefe = :id_jefe
				,total_pago = :total_pago
				 
			WHERE id_pago = :id
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
		$query = "DELETE FROM pago_salario WHERE id_pago = '".$id."'";
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