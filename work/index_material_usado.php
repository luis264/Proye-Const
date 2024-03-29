<!DOCTYPE html>
<html>
	<head>
		<title>DATOS MATERIAL USADO</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR MATERIAL USADO</h3>
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

							<th>CANTIDAD</th>
							<th>DESCRIPCION USO</th>
							<th>ID MATERIAL</th>
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
		        	<h4 class="modal-title">Datos Material Usado</h4>
		      	</div>
		      	<div class="modal-body">
		      	
		      		<div class="form-group">
			        	<label>cantidad</label>
			        	<input type="text" name="cantidad1" id="cantidad1" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>descripcion uso</label>
			        	<input type="text" name="descripicion_uso" id="descripcion_uso" class="form-control" />
			        </div>
			       <div class="form-group">
            		<label for="sectores">ID MATERIAL</label>
            			<select id="id_material" name="id_material" class="form-control" required="required"></select>     
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

		var material = $('#id_material');
		$.ajax({
			 url: 'http://localhost/constructora/api/test_api_material.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					 material.append($('<option/>', { value: item.id_material, text: item.nom_material }));
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
			url:"fetch_material_usado.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS MATERIAL USADO');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#cantidad1').val() == '')
		{
			alert("Ingrese cantidad");
		}
		else if($('#descripcion_uso').val() == '')
		{
			alert("Ingrese descripcion_uso");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_material_usado.php",
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
			url:"action_material_usado.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_uso);
				$('#cantidad1').val(data.cantidad1);
				$('#descripcion_uso').val(data.descripcion_uso);
				$('#id_material').val(data.id_material);
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
				url:"action_material_usado.php",
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