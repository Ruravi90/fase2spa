@extends('layouts.app')
@section('content')
  <div ng-controller="UserController" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
      	<h3 class="box-title"><i class="fa fa-group"></i> Usuarios</h3>
      	<button class="btn btn-xs btn-primary" ng-click="add()">
        	<i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="user in users | filter:anySearch">
          <div class="row">
          	<div class="col-md-1"><%user.username%></div>
            <div class="col-md-2"><%user.name%></div>
            <div class="col-md-4"><%user.lastname%></div> 
            <div class="col-md-4 visible-lg visible-sm"><%user.email%></div>
            <div class="col-md-1">
            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
				<button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalUser.html">
	<form name="userForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> usuario</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="userForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
      		<div class="row">
				<div class="form-group col-md-4" 
				ng-class="{'has-error':userForm.username.$invalid && userForm.username.$pristine}">
			    	<input type="text" 
			    	name="username" 
			    	class="form-control" 
			    	ng-model="user.username" 
			    	placeholder="Usuario" 
			    	ng-change="validateUsername()" 
			    	ng-model-options="{ debounce: 1000 }" 
			    	ng-pattern="/^[a-z]{5,15}/"
			    	pattern="/^[a-z]{5,15}/"
					title="El usuario debe contener minúsculas de máximo 15 letras sin número y sin espacios"
			    	required>
			    	
			  	</div>
			  	<div class="col-md-8">
			  		<span class="text-red" ng-if="!validUsername && userForm.username.$error.pattern">
			  			El usuario debe contener minúsculas de máximo 15 letras sin número y sin espacios
			  		</span>
					<h4 ng-if="validUsername != null && validUsername">
						<label class="label label-success" >
							Usuario disponible
			  			</label>
					</h4>
			  		<h4 ng-if="validUsername != null && !validUsername">
						<label class="label label-danger" >
							Usuario en uso
			  			</label>
					</h4>
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4" ng-class="{'has-error':userForm.name.$invalid && userForm.name.$pristine}">
			    	<input type="text" name="name" class="form-control" ng-model="user.name" placeholder="Nombre(s)" required>
			  	</div>
			  	<div class="form-group col-md-4" ng-class="{'has-error':userForm.lastname.$invalid && userForm.lastname.$pristine}">
			    	<input type="text" name="lastname" class="form-control" ng-model="user.lastname" required placeholder="Paterno"> 
			  	</div>
			  	<div class="form-group col-md-4">
			    	<input type="text" name="motherLastName" class="form-control" ng-model="user.motherlastname" placeholder="Matterno">
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6" ng-class="{'has-error':userForm.email.$invalid && userForm.email.$pristine}">
			    	<input type="email" name="email" class="form-control" ng-model="user.email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" placeholder="Correo" required>
			    	<span ng-if="userForm.email.$error.pattern">Digité un correo válido por ejemplo: usuario@dominio.com</span>
			  	</div>
				<div class="form-group col-md-6">
			    	<input type="text" name="phone_mobile" class="form-control" ng-model="user.phone_mobile" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" placeholder="Telefono">
					<span class="text-red" ng-if="userForm.phone_mobile.$error.pattern">Digité el telefono a 10 numeros.</span>
			  	</div>
			</div>

			<label class="text-default">Roles</label>
			<div class="row">
				<div class="form-group col-md-10">
			    	<select id="cmbRol" 
			    			style="width: 100%"
                            data-placeholder="Selecciona el rol"
                            ng-model="rol_id"
                            sc-single-select>
                        <option ng-repeat="item in list_roles" ng-value="item.id" >
                           <%item.name%>
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-2">
			    	<button class="btn btn-primary" ng-click="assignRol()"><i class="fa fa-plus"></i></button>
                </div>
			</div>
			<ul class="list-group">
			  	<li class="list-group-item row" ng-repeat="rol in user.roles track by rol.id"> 
					<span class="col-md-10"><%rol.name%></span> 
					<span class="col-md-2">
						<button class="btn btn-danger btn-xs pull-right">
					  		<i class="fa fa-trash" ng-click="removeRol()"></i>
					  	</button>	
					</span> 
		  		</li>
			</ul>
      </div>
      <div class="modal-footer"> 
			<button class="btn btn-default" type="button" ng-click="modalUser.dismiss()">Cancel</button>
          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="userForm.$invalid">Guardar</button>
			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="userForm.$invalid">Actualizar</button>
      </div>
	</form>
  </script>
@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/UserController.js') }}"></script>
@endsection