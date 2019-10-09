<?php

//action.php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		echo "insert"; 
		$form_data = array(
			'id_trabajador'		=>	$_POST['id_trabajador'],
			'id_jefe'		=>	$_POST['id_jefe'],
			'lunes'		=>	$_POST['lunes'],
			'martes'		=>	$_POST['martes'],
			'miercoles'		=>	$_POST['miercoles'],
			'jueves'		=>	$_POST['jueves'],
			'viernes'		=>	$_POST['viernes'],
			'sabado'		=>	$_POST['sabado']
		);
		$api_url = "http://localhost/constructora/api/test_api_asistencia.php?action=insert";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}

	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = "http://localhost/constructora/api/test_api_asistencia.php?action=fetch_single&id=".$id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'id_trabajador'		=>	$_POST['id_trabajador'],
			'id_jefe'		=>	$_POST['id_jefe'],
			'lunes'		=>	$_POST['lunes'],
			'martes'		=>	$_POST['martes'],
			'miercoles'		=>	$_POST['miercoles'],
			'jueves'		=>	$_POST['jueves'],
			'viernes'		=>	$_POST['viernes'],
			'sabado'		=>	$_POST['sabado'],
			'hidden_id'				=>	$_POST['hidden_id']
		);
		$api_url = "http://localhost/constructora/api/test_api_asistencia.php?action=update";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}
		}
	}
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://localhost/constructora/api/test_api_asistencia.php?action=delete&id=".$id.""; //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>