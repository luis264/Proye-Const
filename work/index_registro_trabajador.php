<!DOCTYPE html>
<html>
	<head>
		<title>DATOS REGISTRO TRABAJADOR</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR REGISTRO TRABAJADOR</h3>
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
							<th>NOMBRES</th>
							<th>APELLIDOS</th>
							<th>ID TIPO</th>
							<th>ID JEFE</th>
							<th>ID RANGO</th>
							<th>ID OBRA</th>
							<th>ID SALARIO</th>
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
		        	<h4 class="modal-title">Datos TRABAJADOR</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>NOMBRES</label>
			        	<input type="text" name="nombres" id="nombres" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>APELLIDOS</label>
			        	<input type="text" name="apellidos" id="apellidos" class="form-control" />
			        </div>
			     	<div class="form-group">
            			<label for="sectores">ID TIPO</label>
            			<select id="id_tipo" name="id_tipo" class="form-control" required="required"></select>          
         			</div>
         			<div class="form-group">
            			<label for="sectores">ID JEFE</label>
            			<select id="id_jefe" name="id_jefe" class="form-control" required="required"></select>          
         			</div>
         			<div class="form-group">
            			<label for="sectores">ID RANGO</label>
            			<select id="id_rango" name="id_rango" class="form-control" required="required"></select>          
         			</div>
         			<div class="form-group">
            			<label for="sectores">ID OBRA</label>
            			<select id="id_obra" name="id_obra" class="form-control" required="required"></select>          
         			</div>
         			<div class="form-group">
            			<label for="sectores">ID SALARIO</label>
            			<select id="id_salario" name="id_salario" class="form-control" required="required"></select>          
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

		var tipo_trabajo = $('#id_tipo');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_tipo_trabajo.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 tipo_trabajo.append($('<option/>', { value: item.id_tipo, text: item.nom_tipo }));
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

		var rango = $('#id_rango');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_rango.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 rango.append($('<option/>', { value: item.id_rango, text: item.nom_rango }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });

		var obra = $('#id_obra');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_obra.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 obra.append($('<option/>', { value: item.id_obra, text: item.nom_obra }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });

		var salario = $('#id_salario');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_salario.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 salario.append($('<option/>', { value: item.id_salario, text: item.id_salario }));
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
			url:"fetch_registro_trabajador.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS REGISTRO');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nombres').val() == '')
		{
			alert("Ingresar nombres");
		}
		else if($('#apellidos').val() == '')
		{
			alert("Ingrese apellidos");
		}
		else if($('#id_tipo').val() == '')
		{
			alert("Ingrese id tipo");
		}
		else if($('#id_jefe').val() == '')
		{
			alert("Ingrese id jefe");
		}
		else if($('#id_rango').val() == '')
		{
			alert("Ingrese id rango");
		}
		else if($('#id_obra').val() == '')
		{
			alert("Ingrese id obra");
		}
		else if($('#id_salario').val() == '')
		{
			alert("Ingrese id salario");
		}

		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_registro_trabajador.php",
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
			url:"action_registro_trabajador.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_trabajador);
				$('#nombres').val(data.nombres);
				$('#apellidos').val(data.apellidos);
				$('#id_tipo').val(data.id_tipo);
				$('#id_jefe').val(data.id_jefe);
				$('#id_rango').val(data.id_rango);
				$('#id_obra').val(data.id_obra);
				$('#id_salario').val(data.id_salario);
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
				url:"action_registro_trabajador.php",
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
</script>