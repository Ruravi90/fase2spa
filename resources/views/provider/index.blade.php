@extends('layouts.app')

@section('content')

  <div ng-controller="ProviderController" ng-cloak>
    <div class="panel panel-default">
      <div class="panel-heading">
        Proveedores
        <button class="btn btn-xs btn-default pull-right" ng-click="add()">
        Nuevo proveedor
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="provider in providers">
          <div class="row">
            <div class="col-md-3"><%provider.business_name%></div>
            <div class="col-md-3 visible-lg visible-sm"><%provider.contact_name%></div>
            <div class="col-md-3 visible-lg visible-sm"><%provider.office_phone%></div>
            <div class="col-md-3">
            	<button class="btn btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
				<button class="btn btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalProvider.html">
		<form id="clientForm">
			<div class="modal-header">
          		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> proveedor</h3>
      		</div>
  			<div class="modal-body" id="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
						    <label for="business_name">Proveedore</label>
					    	<input type="text" id="business_name" class="form-control" ng-model="provider.business_name">
					  	</div>
						<div class="form-group col-md-6">
						    <label for="contact_name">Nombre del contacto</label>
					    	<input type="text" id="contact_name" class="form-control" ng-model="provider.contact_name">
					  	</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						    <label for="office_phone">Telefono de contacto</label>
					    	<input type="text" id="office_phone" class="form-control" ng-model="provider.office_phone">
					  	</div>
					  	<div class="form-group col-md-6">
						    <label for="email">Correo</label>
					    	<input type="text" id="email" class="form-control" ng-model="provider.email"> 
					  	</div> 
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						    <label for="street">Calle</label>
					    	<input type="text" id="street" class="form-control" ng-model="provider.street">
					  	</div>
					  	<div class="form-group col-md-2">
						    <label for="inner_number">Int</label>
					    	<input type="text" id="inner_number" class="form-control" ng-model="provider.inner_number">
					  	</div>
					  	<div class="form-group col-md-2">
						    <label for="outdoor_umber">Ext</label>
					    	<input type="text" id="outdoor_umber" class="form-control" ng-model="provider.outdoor_number">
					  	</div>
					</div>
					<div class="row">
						<div class="form-group col-md-5">
						    <label for="state">Estado</label>
					    	<input type="text" id="state" class="form-control" ng-model="provider.state">
					  	</div>
					  	<div class="form-group col-md-5">
						    <label for="town">Municipio</label>
					    	<input type="text" id="town" class="form-control" ng-model="provider.town">
					  	</div>
					  	<div class="form-group col-md-2">
						    <label for="postal_code">CP</label>
					    	<input type="text" id="postal_code" class="form-control" ng-model="provider.postal_code">
					  	</div>
					</div>
  			</div>
	      	<div class="modal-footer">
				<button class="btn btn-default" type="button" ng-click="$dismiss()">Cancel</button>
	          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()">Guardar</button>
				<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()">Actualizar</button>
	      	</div>
		</form>
  </script>

@endsection

@section('scripts')
  <script src="{{ asset('controllers/ProviderController.js') }}"></script>
@endsection