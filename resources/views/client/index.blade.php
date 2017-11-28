@extends('layouts.app')
@section('content')
  <div ng-controller="ClientsController" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
      	<h3 class="box-title"><i class="fa fa-group"></i> Clientes</h3>
      	<button class="btn btn-xs btn-primary" ng-click="add()">
        	<i class="fa fa-plus"></i>
        </button>
      </div>

      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="client in clients | filter:anySearch">
          <div class="row">
            <div class="col-md-1"><%client.name%></div>
            <div class="col-md-2"><%client.lastname%></div> 
            <div class="col-md-4 visible-lg visible-sm"><%client.email%></div>
            <div class="col-md-3 visible-lg visible-sm"><%client.phone_home%></div>
            <div class="col-md-2">
            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
				<button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalClient.html">
	<form name="clientForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> Cliente</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="clientForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
			<div class="row">
				<div class="form-group col-md-4" ng-class="{'has-error':clientForm.name.$invalid && clientForm.name.$pristine}">
			    	<input type="text" name="name" class="form-control" ng-model="client.name" required placeholder="Nombre(s)">
			  	</div>
			  	<div class="form-group col-md-4" ng-class="{'has-error':clientForm.lastname.$invalid && clientForm.lastname.$pristine}">
			    	<input type="text" name="lastname" class="form-control" ng-model="client.lastname" required placeholder="Paterno"> 
			  	</div>
			  	<div class="form-group col-md-4">
			    	<input type="text" name="motherLastName" class="form-control" ng-model="client.motherlastname" placeholder="Matterno">
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12" ng-class="{'has-error':clientForm.email.$invalid && clientForm.email.$pristine}">
			    	<input type="email" name="email" class="form-control" ng-model="client.email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" required placeholder="Correo">
			    	<span class="text-red" ng-if="clientForm.email.$error.pattern">Digité un correo válido por ejemplo: usuario@dominio.com</span>
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
			    	<input type="text" name="phone_home" class="form-control" ng-model="client.phone_home" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" placeholder="Telefono de casa">
					<span class="text-red" ng-if="clientForm.phone_home.$error.pattern">Digité el telefono a 10 numeros.</span>
			  	</div>
			  	<div class="form-group col-md-6">
			    	<input type="text" name="phone_mobile" class="form-control" ng-model="client.phone_mobile" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" placeholder="Telefono celular">
					<span class="text-red" ng-if="clientForm.phone_mobile.$error.pattern">Digité el telefono a 10 numeros.</span>
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
			    	<input type="text" name="street" class="form-control" ng-model="client.street" placeholder="Calle">
			  	</div>
			  	<div class="form-group col-md-2" ng-class="{'has-error':clientForm.outdoor_umber.$invalid && clientForm.outdoor_umber.$pristine}">
			    	<input type="text" name="outdoor_umber" class="form-control" ng-model="client.outdoor_number" ng-required="client.street" placeholder="Ext">
			  	</div>
			  	<div class="form-group col-md-2">
			    	<input type="text" name="inner_number" class="form-control" ng-model="client.inner_number" placeholder="Int">
			  	</div>
			  	<div class="form-group col-md-2">
			    	<input type="text" name="postal_code" class="form-control" ng-model="client.postal_code" placeholder="CP">
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
			    	<input type="text" name="town" class="form-control" ng-model="client.town" placeholder="Municipio">
			  	</div>
				<div class="form-group col-md-6">
			    	<input type="text" name="state" class="form-control" ng-model="client.state" placeholder="Estado">
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6" ng-class="{'has-error':client.reference_id == ''}">
 					<select id="cmbReference" name="reference" style="width: 100%"
                            data-placeholder="Selecciona la referencia"
                            data-allow-clear="true"
                            ng-model="client.reference_id"
                            ng-required="true"
                            sc-single-select>
                        <option ng-bind="options.placeholder"></option>
                        <option ng-repeat="item in references" ng-value="item.id" selected="<%client.reference_id == item.id%>">
                           <%item.name%>
                        </option>
                    </select>
			  	</div>
			  	<div class="form-group col-md-6" ng-if="client.reference_id == -1" ng-class="{'has-error':clientForm.other_reference.$invalid && clientForm.other_reference.$pristine}">
			    	<input type="text" name="other_reference" class="form-control" ng-model="client.other_ref" ng-required="client.reference_id == -1" placeholder="Especifique"> 
			  	</div>
			</div> 
      </div>

      <div class="modal-footer"> 
			<button class="btn btn-default" type="button" ng-click="modalClient.dismiss()">Cancel</button>
          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save(clientForm)" ng-disabled="clientForm.$invalid">Guardar</button>
			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update(clientForm)" ng-disabled="clientForm.$invalid">Actualizar</button>
      </div>
	</form>
  </script>
@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/ClientsController.js') }}"></script>
@endsection