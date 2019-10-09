<!DOCTYPE html>
<html>
	<head>
		<title>DATOS ASISTENCIA</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR ASISTENCIA</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			<button type="button" name="atras" id="atras" class="btn btn-success btn-xs">
				<a class="navbar-brand" href="../index.html">Atras</a></button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>TRABAJADOR</th>
							<th>JEFE</th>
							<th>LUNES</th>
							<th>MARTES</th>
							<th>MIERCOLES</th>
							<th>JUEVES</th>
							<th>VIERNES</th>
							<th>SABADO</th>
							<th>MODIFICAR</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Datos Asistencia</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
            			<label for="sectores">TRABAJADOR</label>
            			<select id="id_trabajador" name="id_trabajador" class="form-control" required="required"></select>          
         			</div>
         			<div class="form-group">
            			<label for="sectores">JEFE</label>
            			<select id="id_jefe" name="id_jefe" class="form-control" required="required"></select>          
         			</div>
		      		<div class="form-group">
			        	<label>LUNES</label>
			        	<input type="text" name="lunes" id="lunes" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>MARTES</label>
			        	<input type="text" name="martes" id="martes" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>MIERCOLES</label>
			        	<input type="text" name="miercoles" id="miercoles" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>JUEVES</label>
			        	<input type="text" name="jueves" id="jueves" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>VIERNES</label>
			        	<input type="text" name="viernes" id="viernes" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>SABADO</label>
			        	<input type="text" name="sabado" id="sabado" class="form-control" />
			        </div>
			     
         		
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();

		var registro_trabajador = $('#id_trabajador');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_registro_trabajador.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 registro_trabajador.append($('<option/>', { value: item.id_trabajador, text: item.nombres }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });

		var jefe_encargado = $('#id_jefe');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_jefe_encargado.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 jefe_encargado.append($('<option/>', { value: item.id_jefe, text: item.nom_jefe }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });



	function fetch_data()
	{
		$.ajax({
			url:"fetch_asistencia.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS ASISTENCIA');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#lunes').val() == '')
		{
			alert("Ingresar lunes");
		}
		else if($('#martes').val() == '')
		{
			alert("Ingrese martes");
		}
		else if($('#miercoles').val() == '')
		{
			alert("Ingrese miercoles");
		}
		else if($('#jueves').val() == '')
		{
			alert("Ingrese jueves");
		}
		else if($('#viernes').val() == '')
		{
			alert("Ingrese viernes");
		}
		else if($('#sabado').val() == '')
		{
			alert("Ingrese sabado");
		}
		

		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_asistencia.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted using PHP API");
					}
					if(data == 'update')
					{
						alert("Data Updated using PHP API");
					}
				}
			});
			console.info("luego de ajax")
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action_asistencia.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_asistencia);
				$('#id_trabajador').val(data.id_trabajador);
				$('#id_jefe').val(data.id_jefe);
				$('#lunes').val(data.lunes);
				$('#martes').val(data.martes);
				$('#miercoles').val(data.miercoles);
				$('#jueves').val(data.jueves);
				$('#viernes').val(data.viernes);
				$('#sabado').val(data.sabado);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos Responsable');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Esta seguro de eliminar el Dato"))
		{
			$.ajax({
				url:"action_asistencia.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Data Deleted using PHP API");
				}
			});
		}
	});

});
</script>p