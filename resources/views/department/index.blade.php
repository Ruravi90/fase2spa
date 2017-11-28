@extends('layouts.app')
@section('content')
  <div ng-controller="DepartmentController" class="col-md-6 col-md-offset-3" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
      	<h3 class="box-title"><i class="fa fa-group"></i> Departamentos</h3>
      	<button class="btn btn-xs btn-primary" ng-click="add()">
        	<i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="department in departments | filter:anySearch">
          <div class="row">
          	<div class="col-md-5"><%department.name%></div>
            <div class="col-md-5"><%department.description%></div>
            <div class="col-md-2">
            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
				<button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalDepartment.html">
	<form name="departmentForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> departamento</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="userForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
			<div class="row">
				<div class="form-group col-md-12" ng-class="{'has-error':departmentForm.name.$invalid && departmentForm.name.$pristine}">
			    	<input type="text" name="name" class="form-control" ng-model="department.name" placeholder="Nombre" required>
			  	</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
			    	<textarea class="form-control" ng-model="department.description" placeholder="Descripción del departamento"></textarea>
			  	</div>
			</div>
      </div>
      <div class="modal-footer"> 
			<button class="btn btn-default" type="button" ng-click="modalDepartment.dismiss()">Cancel</button>
          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="departmentForm.$invalid">Guardar</button>
			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="departmentForm.$invalid">Actualizar</button>
      </div>
	</form>
  </script>
@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/DepartmentController.js') }}"></script>
@endsection