<?php

//fetch.php

$api_url = "http://localhost/constructora/api/test_api_asistencia.php?action=fetch_all";

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
			<td>'.$row->id_trabajador.'</td>
			<td>'.$row->id_jefe.'</td>
			<td>'.$row->lunes.'</td>
			<td>'.$row->martes.'</td>
			<td>'.$row->miercoles.'</td>
			<td>'.$row->jueves.'</td>
			<td>'.$row->viernes.'</td>
			<td>'.$row->sabado.'</td>

			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_asistencia.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_asistencia.'">Delete</button></td>
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