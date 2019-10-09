<!DOCTYPE html>
<html>
	<head>
		<title>DATOS JEFE ENCARGADO</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR JEFE ENCARGADO</h3>
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
							<th>NOMBRE JEFE</th>
							<th>ID TIPO</th>
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
		        	<h4 class="modal-title">Datos Jefe Encargado</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Nombre Jefe</label>
			        	<input type="text" name="nom_jefe" id="nom_jefe" class="form-control" />
			        </div>
			     	<div class="form-group">
            			<label for="sectores">ID Tipo</label>
            			<select id="id_tipo" name="id_tipo" class="form-control" required="required"></select>          
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

	function fetch_data()
	{
		$.ajax({
			url:"fetch_jefe_encargado.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS JEFE ENCARGADO');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nom_jefe').val() == '')
		{
			alert("Ingresar nombre Jefe");
		}
		else if($('#id_tipo').val() == '')
		{
			alert("Ingrese id tipo");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_jefe_encargado.php",
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
			url:"action_jefe_encargado.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_jefe);
				$('#nom_jefe').val(data.nom_jefe);
				$('#id_tipo').val(data.id_tipo);
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
				url:"action_jefe_encargado.php",
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