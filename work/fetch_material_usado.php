<?php

//fetch.php

$api_url = "http://localhost/constructora/api/test_api_material_usado.php?action=fetch_all";

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
			<td>'.$row->cantidad1.'</td>
			<td>'.$row->descripcion_uso.'</td>
			<td>'.$row->id_material.'</td>
			
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_uso.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_uso.'">Delete</button></td>
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