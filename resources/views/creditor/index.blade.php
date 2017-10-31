@extends('layouts.app')
@section('content')
  	<div ng-controller="CreditorController" ng-cloak>
	    <div class="box box-primary color-palette-box">
	      <div class="box-header with-border">
	      	<h3 class="box-title"><i class="fa fa-group"></i> Acreedores</h3>
	      	<button class="btn btn-xs btn-primary" ng-click="add()">
	        	<i class="fa fa-plus"></i>
	        </button>
	      </div>
	      <!-- List group -->
	      <ul class="list-group">
	        <li class="list-group-item" ng-repeat="creditor in creditors | filter:anySearch">
	          <div class="row">
	            <div class="col-md-3"><%creditor.business_name%></div>
	            <div class="col-md-3 visible-lg visible-sm"><%creditor.contact_name%></div>
	            <div class="col-md-3 visible-lg visible-sm"><%creditor.office_phone%></div>
	            <div class="col-md-3">
	            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
					<button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
	            </div>
	          </div>
	        </li>
	      </ul>
			<div page="currentPage" 
			    page-size="pageSize" 
			    total="clients"
			    disabled="true"
			    scroll-top="true" 
			    hide-if-empty="true"
			    show-prev-next="true"
			    show-first-last="true">
			</div>  
	    </div>
  	</div>

	<script type="text/ng-template" id="modalCreditor.html">
		<form name="creditorForm">
			<div class="modal-header">
          		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> proveedor</h3>
      		</div>
  			<div class="modal-body" id="modal-body">
  				<div class="row" ng-if="creditorForm.$invalid">
	      			<div class="col-md-12">
	      				<label class="text-red">Los campos en rojo son requeridos.</label>
	      			</div>
	      		</div>
				<div class="row">
					<div class="form-group col-md-6" ng-class="{'has-error':creditorForm.business_name.$invalid && creditorForm.business_name.$pristine}">
				    	<input type="text" name="business_name" class="form-control" ng-model="creditor.business_name" placeholder="Proveedor" required>
				  	</div>
					<div class="form-group col-md-6" ng-class="{'has-error':creditorForm.contact_name.$invalid && creditorForm.contact_name.$pristine}">
				    	<input type="text" name="contact_name" class="form-control" ng-model="creditor.contact_name" placeholder="Nombre del contacto" required>
				  	</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6" ng-class="{'has-error':creditorForm.office_phone.$invalid && creditorForm.office_phone.$pristine}">
				    	<input type="text" name="office_phone" class="form-control" ng-model="creditor.office_phone" placeholder="Telefono de contacto" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" required>
						<span class="text-red" ng-if="creditorForm.office_phone.$error.pattern">Telefono a 10 numeros.</span>
				  	</div>
				  	<div class="form-group col-md-6" ng-class="{'has-error':creditorForm.email.$invalid && creditorForm.email.$pristine}">
				    	<input type="text" name="email" class="form-control" ng-model="creditor.email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" placeholder="Correo" required>
				    	<span class="text-red" ng-if="creditorForm.email.$error.pattern">Correo inválido eje: usuario@dominio.com</span>
				  	</div> 
				</div>
				<div class="row">
					<div class="form-group col-md-6">
				    	<input type="text" name="street" class="form-control" ng-model="creditor.street" placeholder="Calle">
				  	</div>
				  	<div class="form-group col-md-2">
				    	<input type="text" name="inner_number" class="form-control" ng-model="creditor.inner_number" placeholder="Int">
				  	</div>
				  	<div class="form-group col-md-2">
				    	<input type="text" name="outdoor_umber" class="form-control" ng-model="creditor.outdoor_number" placeholder="Ext">
				  	</div>
				</div>
				<div class="row">
					<div class="form-group col-md-5">
				    	<input type="text" name="state" class="form-control" ng-model="creditor.state" placeholder="Estado">
				  	</div>
				  	<div class="form-group col-md-5">
				    	<input type="text" name="town" class="form-control" ng-model="creditor.town" placeholder="Municipio">
				  	</div>
				  	<div class="form-group col-md-2">
				    	<input type="text" name="postal_code" class="form-control" ng-model="creditor.postal_code" placeholder="CP">
				  	</div>
				</div>
  			</div>
	      	<div class="modal-footer">
				<button class="btn btn-default" type="button" ng-click="$dismiss()">Cancel</button>
	          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="creditorForm.$invalid">Guardar</button>
				<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="creditorForm.$invalid">Actualizar</button>
	      	</div>
		</form>
  </script>

@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/CreditorController.js') }}"></script>
@endsection