@if($reference->exists)
<form action="{{route('update_cat_reference_path',['reference'=> $reference->id])}}" method="POST">
	{{ method_field('PUT') }}
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Editar referenceia
				</div>
@else
<form action="{{route('add_cat_reference_path')}}" method="POST">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Nueva referenceia
				</div>
@endif
{{ csrf_field() }}

				<div class="panel-body">
					<div class="row">
						<div class="form-group col-md-4">
			              <label for="name">Referencia</label>
			              <input type="text" name="name" class="form-control" id="name" value="{{$reference->name or old('name')}}">
			            </div>
		            </div>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>

