<?php

//fetch.php

$api_url = "http://localhost/constructora/api/test_api_registro_trabajador.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->nombres.'</td>
			<td>'.$row->apellidos.'</td>
			<td>'.$row->id_tipo.'</td>
			<td>'.$row->id_jefe.'</td>
			<td>'.$row->id_rango.'</td>
			<td>'.$row->id_obra.'</td>
			<td>'.$row->id_salario.'</td>
			
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_trabajador.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_trabajador.'">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>