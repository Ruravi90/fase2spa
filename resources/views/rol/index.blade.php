@extends('layouts.app')

@section('content')

  <div ng-controller="SalesController" ng-cloak>

    <div class="panel panel-default">

      <div class="panel-heading">

      	<div class="row">

      		Usuarios

	        <button class="btn btn-xs btn-default pull-right" ng-click="add()">

	        	Nuevo cliente 

	        </button>

      	</div>

      </div>



      <!-- List group -->

      <ul class="list-group">

        <li class="list-group-item" ng-repeat="user in users">

          <div class="row">

            <div class="col-md-1"><%user.name%></div>

            <div class="col-md-2"><%user.lastname%></div> 

            <div class="col-md-4 visible-lg visible-sm"><%user.email%></div>

            <div class="col-md-3 visible-lg visible-sm"><%user.phone_home%></div>

            <div class="col-md-2">

            	<button class="btn btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>

				<button class="btn btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>

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

      				Los campos en rojo son requeridos.

      			</div>

      		</div>

			<div class="row">

				<div class="form-group col-md-4" ng-class="{'has-error':clientForm.name.$invalid && clientForm.name.$pristine}">

				    <label for="name">Nombre(s)</label>

			    	<input type="text" name="name" class="form-control" ng-model="client.name" required>

			  	</div>

			  	<div class="form-group col-md-4" ng-class="{'has-error':clientForm.lastname.$invalid && clientForm.lastname.$pristine}">

				    <label for="lastName">Paterno </label>

			    	<input type="text" name="lastname" class="form-control" ng-model="client.lastname" required> 

			  	</div>

			  	<div class="form-group col-md-4">

				    <label for="motherLastName">Matterno</label>

			    	<input type="text" name="motherLastName" class="form-control" ng-model="client.motherlastname">

			  	</div>

			</div>

			<div class="row">

				<div class="form-group col-md-12" ng-class="{'has-error':clientForm.email.$invalid && clientForm.email.$pristine}">

				    <label for="email">Correo</label>

			    	<input type="email" name="email" class="form-control" ng-model="client.email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" required>

			    	<span ng-if="clientForm.email.$error.pattern">Digité un correo válido por ejemplo: usuario@dominio.com</span>

			  	</div>

			</div>

			<div class="row">

				<div class="form-group col-md-6" ng-class="{'has-error':clientForm.phone_home.$invalid && clientForm.phone_home.$pristine}">

				    <label for="phone_home">Telefono de casa</label>

			    	<input type="text" name="phone_home" class="form-control" ng-model="client.phone_home" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" required>

					<span ng-if="clientForm.phone_home.$error.pattern">Digité el telefono a 10 numeros.</span>

			  	</div>

			  	<div class="form-group col-md-6">

				    <label for="phone_mobile">Celular</label>

			    	<input type="text" name="phone_mobile" class="form-control" ng-model="client.phone_mobile">

			  	</div>

			</div>

			<div class="row">

				<div class="form-group col-md-6">

				    <label for="street">Calle</label>

			    	<input type="text" name="street" class="form-control" ng-model="client.street">

			  	</div>

			  	<div class="form-group col-md-2" ng-class="{'has-error':clientForm.outdoor_umber.$invalid && clientForm.outdoor_umber.$pristine}">

				    <label for="outdoor_umber">Ext</label>

			    	<input type="text" name="outdoor_umber" class="form-control" ng-model="client.outdoor_number" ng-required="client.street">

			  	</div>

			  	<div class="form-group col-md-2">

				    <label for="inner_number">Int</label>

			    	<input type="text" name="inner_number" class="form-control" ng-model="client.inner_number" >

			  	</div>

			  	<div class="form-group col-md-2">

				    <label for="postal_code">CP</label>

			    	<input type="text" name="postal_code" class="form-control" ng-model="client.postal_code">

			  	</div>

			</div>

			<div class="row">

				<div class="form-group col-md-6">

				    <label for="town">Municipio</label>

			    	<input type="text" name="town" class="form-control" ng-model="client.town">

			  	</div>

				<div class="form-group col-md-6">

				    <label for="state">Estado</label>

			    	<input type="text" name="state" class="form-control" ng-model="client.state">

			  	</div>

			</div>

			<div class="row">

				<div class="form-group col-md-6" ng-class="{'has-error':clientForm.reference.$invalid && clientForm.reference.$pristine}">

				    <label for="reference">Referencia</label>

			    	<select type="text" name="reference" class="form-control" ng-model="client.reference_id" required>

						<option ng-repeat="r in references" value="<%r.id%>"><%r.name%></option>

						<option value="0">Otro</option>

					</select>

			  	</div>

			  	<div class="form-group col-md-6" ng-if="client.reference_id == 0" ng-class="{'has-error':clientForm.other_reference.$invalid && clientForm.other_reference.$pristine}">

				    <label for="reference">Especifique</label>

			    	<input type="text" name="other_reference" class="form-control" ng-model="client.other_ref" ng-required="client.reference_id == 0"> 

			  	</div>

			</div> 

      </div>



      <div class="modal-footer"> 

			<button class="btn btn-default" type="button" ng-click="modalClient.dismiss()">Cancel</button>

          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save(clientForm)">Guardar</button>

			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update(clientForm)">Actualizar</button>

      </div>

	</form>

  </script>

@endsection



@section('scripts')

  <script src="{{ asset('controllers/SalesController.js') }}"></script>

@endsection