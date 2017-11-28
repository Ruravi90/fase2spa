@extends('layouts.app')
@section('content')
  <div ng-controller="CatServicesController" class="col-md-6 col-md-offset-3" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-group"></i> Servicios</h3>
        <button class="btn btn-xs btn-primary" ng-click="add()">
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="service in services | filter:anySearch">
          <div class="row">
            <div class="col-md-5"><%service.name%></div>
            <div class="col-md-5"><%service.description%></div>
            <div class="col-md-2">
              <button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
              <button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalService.html">
  <form name="serviceForm" novalidate>
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> servicio</h3>
      </div>
      <div class="modal-body" id="modal-body">
          <div class="row" ng-if="serviceForm.$invalid">
            <div class="col-md-12">
              <label class="text-red">Los campos en rojo son requeridos.</label>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12" ng-class="{'has-error':serviceForm.name.$invalid && serviceForm.name.$pristine}">
                <input type="text" name="name" class="form-control" ng-model="service.name" placeholder="Nombre" required>
              </div>
          </div>
      </div>
      <div class="modal-footer"> 
        <button class="btn btn-default" type="button" ng-click="modalService.dismiss()">Cancel</button>
        <button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="serviceForm.$invalid">Guardar</button>
        <button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="serviceForm.$invalid">Actualizar</button>
      </div>
  </form>
  </script>
@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/CatServicesController.js') }}"></script>
@endsection