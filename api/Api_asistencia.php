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
		$query = "SELECT * FROM asistencia ORDER BY id_asistencia;";
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
				':lunes'		    =>	$_POST["lunes"],
				':martes'		        =>	$_POST["martes"],
				':miercoles'		        =>	$_POST["miercoles"],
				':jueves'		        =>	$_POST["jueves"],
				':viernes'		        =>	$_POST["viernes"],
				':sabado'		        =>	$_POST["sabado"]
			);
			$query = "
			INSERT INTO asistencia
			(id_trabajador,id_jefe,lunes,martes,miercoles,jueves,viernes,sabado) 
			VALUES 
			(:id_trabajador,:id_jefe,:lunes,:martes,
				:miercoles,:jueves,:viernes,:sabado);
			";

			$query2 = "UPDATE pago_salario SET 
				total_pago = total_pago + '$_POST[lunes]' WHERE id_trabajador='$_POST[id_trabajador]'";

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

	function fetch_single($id)
	{
		$query = "SELECT * FROM asistencia where id_asistencia='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_asistencia'] = $row['id_asistencia'];
				$data['id_trabajador'] = $row['id_trabajador'];
				$data['id_jefe'] = $row['id_jefe'];
				$data['lunes'] = $row['lunes'];
				$data['martes'] = $row['martes'];
				$data['miercoles'] = $row['miercoles'];
				$data['jueves'] = $row['jueves'];
				$data['viernes'] = $row['viernes'];
				$data['sabado'] = $row['sabado'];
				
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
				':lunes'		    =>	$_POST["lunes"],
				':martes'		    =>	$_POST["martes"],
				':miercoles'		    =>	$_POST["miercoles"],
				':jueves'		    =>	$_POST["jueves"],
				':viernes'		    =>	$_POST["viernes"],
				':sabado'		    =>	$_POST["sabado"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE asistencia
			SET id_trabajador = :id_trabajador
				,id_jefe = :id_jefe
				,lunes = :lunes
				,martes = :martes
				,miercoles = :miercoles
				,jueves = :jueves
				,viernes = :viernes
				,sabado = :sabado
				 
			WHERE id_asistencia = :id
			";

			$query2 = "UPDATE pago_salario SET 
				total_pago = '$_POST[lunes]' +'$_POST[martes]'+'$_POST[miercoles]'
				+'$_POST[jueves]'+'$_POST[viernes]'+'$_POST[sabado]' WHERE id_trabajador='$_POST[id_trabajador]'";


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
	function delete($id)
	{
		$query = "DELETE FROM asistencia WHERE id_asistencia = '".$id."'";
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