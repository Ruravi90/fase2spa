@extends('layouts.app')
@section('content')
  <div ng-controller="RolController" ng-cloak>

	<div class="col-md-6">
		<div class="box box-primary color-palette-box">
		      <div class="box-header with-border">
		      	<h3 class="box-title"><i class="fa fa-shield"></i> Roles</h3>
		      	<button class="btn btn-xs btn-primary" ng-click="add()">
		        	<i class="fa fa-plus"></i>
		        </button>
		      </div>
	      <!-- List group -->
	      <ul class="list-group">
	        <li class="list-group-item" ng-repeat="rol in roles | filter:anySearch">
	          <div class="row">
	            <div class="col-md-4"><%rol.name%></div>
	            <div class="col-md-6"><%rol.description%></div>
	            <div class="col-md-2">
	            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
					<button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
	            </div>
	          </div>
	        </li>
	      </ul>
	    </div>
	</div>

	<div class="col-md-6">
		<div class="box box-primary color-palette-box">
	      <div class="box-header with-border">
	      	<h3 class="box-title"><i class="fa fa-unlock"></i> Permisos</h3>
	      	<button class="btn btn-xs btn-primary" ng-click="addPermission()">
	        	<i class="fa fa-plus"></i>
	        </button>
	      </div>
	      <!-- List group -->
	      <ul class="list-group">
	        <li class="list-group-item" ng-repeat="permission in permissions | filter:anySearch">
	          <div class="row">
	            <div class="col-md-4"><%permission.name%></div>
	            <div class="col-md-6"><%permission.description%></div>
	            <div class="col-md-2">
	            	<button class="btn btn-xs btn-danger pull-right" ng-click="deletePermission()"><i class="fa fa-trash"></i></button>
					<button class="btn btn-xs btn-default pull-right" ng-click="editPermission()"><i class="fa fa-edit"></i></button>
	            </div>
	          </div>
	        </li>
	      </ul>
	    </div>
	</div>    

  </div>

  <script type="text/ng-template" id="modalRol.html">
	<form name="rolForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> rol</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="userForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
			<div class="row">
				<div class="form-group col-md-6" ng-class="{'has-error':rolForm.name.$invalid && rolForm.name.$pristine}">
			    	<input type="text" name="name" class="form-control" ng-model="rol.name" placeholder="Nombre" required>
			  	</div>
			  	<div class="form-group col-md-6" ng-class="{'has-error':rolForm.slug.$invalid && rolForm.slug.$pristine}">
			    	<input type="text" name="slug" class="form-control" ng-model="rol.slug" required placeholder="Identificador"> 
			  	</div>
			</div>
			<div class="row">
			  	<div class="form-group col-md-12">
			    	<textarea name="description" class="form-control" ng-model="rol.description" placeholder="Descripción"></textarea>
			  	</div>
			</div>
			<label class="text-default">Permisos</label>
			<div class="row">
			  	<div class="form-group col-md-10">
			    	<select id="cmbPermission" 
			    			style="width: 100%"
                            data-placeholder="Selecciona los permisos"
                            sc-single-select>
                        <option ng-repeat="item in list_permissions" ng-value="item.id" ng-model="permissions_id">
                           <%item.name%>
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-2">
			    	<button class="btn btn-primary" ng-click="assignPermisson()"><i class="fa fa-plus"></i></button>
                </div>
			</div>
			<div>
				<ul class="list-group">
				  	<li class="list-group-item row" ng-repeat="permission in rol.permissions track by permission.id"> 
						<span class="col-md-10"><%permission.name%></span> 
						<span class="col-md-2">
							<button class="btn btn-danger btn-xs pull-right">
						  		<i class="fa fa-trash" ng-click="removePermison()"></i>
						  	</button>	
						</span> 
			  		</li>
				</ul>
			</div>
      </div>
      <div class="modal-footer"> 
			<button class="btn btn-default" type="button" ng-click="modalRol.dismiss()">Cancel</button>
          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="rolForm.$invalid">Guardar</button>
			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="rolForm.$invalid">Actualizar</button>
      </div>
	</form>
  </script>

  <script type="text/ng-template" id="modalPermission.html">
	<form name="permissionForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> permiso</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="userForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
			<div class="row">
				<div class="form-group col-md-6" ng-class="{'has-error':permissionForm.name.$invalid && permissionForm.name.$pristine}">
			    	<input type="text" name="name" class="form-control" ng-model="permission.name" placeholder="Nombre" required>
			  	</div>
			  	<div class="form-group col-md-6" ng-class="{'has-error':permissionForm.slug.$invalid && permissionForm.slug.$pristine}">
			    	<input type="text" name="slug" class="form-control" ng-model="permission.slug" required placeholder="Identificador"> 
			  	</div>
			</div>
			<div class="row">
			  	<div class="form-group col-md-12">
			    	<textarea name="description" class="form-control" ng-model="permission.description" placeholder="Descripción"></textarea>
			  	</div>
			</div>
      </div>
      <div class="modal-footer"> 
			<button class="btn btn-default" type="button" ng-click="modalPermission.dismiss()">Cancel</button>
          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="permissionForm.$invalid">Guardar</button>
			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="permissionForm.$invalid">Actualizar</button>
      </div>
	</form>
  </script>
@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/RolController.js') }}"></script>
@endsection