@extends('layouts.app')

@section('content')

  <div ng-controller="ProviderController" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
      	<h3 class="box-title"><i class="fa fa-truck"></i> Proveedores</h3>
      	<button class="btn btn-xs btn-primary" ng-click="add()">
        	<i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="provider in providers | filter:anySearch">
          <div class="row">
            <div class="col-md-3"><%provider.business_name%></div>
            <div class="col-md-3 visible-lg visible-sm"><%provider.contact_name%></div>
            <div class="col-md-3 visible-lg visible-sm"><%provider.office_phone%></div>
            <div class="col-md-3">
            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
				<button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalProvider.html">
		<form name="providerForm" novalidate>
			<div class="modal-header">
          		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> proveedor</h3>
      		</div>
  			<div class="modal-body" id="modal-body">
  				<div class="row" ng-if="providerForm.$invalid">
	      			<div class="col-md-12">
	      				<label class="text-red">Los campos en rojo son requeridos.</label>
	      			</div>
	      		</div>
				<div class="row">
					<div class="form-group col-md-6" ng-class="{'has-error':providerForm.business_name.$invalid && providerForm.business_name.$pristine}">
				    	<input type="text" name="business_name" class="form-control" ng-model="provider.business_name" placeholder="Proveedor" required>
				  	</div>
					<div class="form-group col-md-6" ng-class="{'has-error':providerForm.contact_name.$invalid && providerForm.contact_name.$pristine}">
				    	<input type="text" name="contact_name" class="form-control" ng-model="provider.contact_name" placeholder="Nombre del contacto" required>
				  	</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6" ng-class="{'has-error':providerForm.office_phone.$invalid && providerForm.office_phone.$pristine}">
				    	<input type="text" name="office_phone" class="form-control" ng-model="provider.office_phone" placeholder="Telefono de contacto" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" required>
						<span class="text-red" ng-if="providerForm.office_phone.$error.pattern">Telefono a 10 numeros.</span>
				  	</div>
				  	<div class="form-group col-md-6" ng-class="{'has-error':providerForm.email.$invalid && providerForm.email.$pristine}">
				    	<input type="text" name="email" class="form-control" ng-model="provider.email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" placeholder="Correo" required>
				    	<span class="text-red" ng-if="providerForm.email.$error.pattern">Correo inválido eje: usuario@dominio.com</span>
				  	</div> 
				</div>
				<div class="row">
					<div class="form-group col-md-6">
				    	<input type="text" id="street" class="form-control" ng-model="provider.street" placeholder="Calle">
				  	</div>
				  	<div class="form-group col-md-2">
				    	<input type="text" id="inner_number" class="form-control" ng-model="provider.inner_number" placeholder="Int">
				  	</div>
				  	<div class="form-group col-md-2">
				    	<input type="text" id="outdoor_umber" class="form-control" ng-model="provider.outdoor_number" placeholder="Ext">
				  	</div>
				</div>
				<div class="row">
					<div class="form-group col-md-5">
				    	<input type="text" id="state" class="form-control" ng-model="provider.state" placeholder="Estado">
				  	</div>
				  	<div class="form-group col-md-5">
				    	<input type="text" id="town" class="form-control" ng-model="provider.town" placeholder="Municipio">
				  	</div>
				  	<div class="form-group col-md-2">
				    	<input type="text" id="postal_code" class="form-control" ng-model="provider.postal_code" placeholder="CP">
				  	</div>
				</div>
  			</div>
	      	<div class="modal-footer">
				<button class="btn btn-default" type="button" ng-click="$dismiss()">Cancel</button>
	          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="providerForm.$invalid">Guardar</button>
				<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="providerForm.$invalid">Actualizar</button>
	      	</div>
		</form>
  </script>

@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/ProviderController.js') }}"></script>
@endsection