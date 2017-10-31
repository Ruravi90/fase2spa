@extends('layouts.app')

@section('content')

  <div ng-controller="CatReferencesController" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-group"></i> Referencias</h3>
        <button class="btn btn-xs btn-primary" ng-click="add()">
          <i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="referent in references | filter:anySearch">
          <div class="row">
            <div class="col-md-10"><%referent.name%></div>
            <div class="col-md-2">
              <button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
              <button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalReference.html">
    <form id="referenceForm">
      <div class="modal-header">
          <h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nueva' %> Referencia</h3>
      </div>
      <div class="modal-body" id="modal-body">
          <div class="row">
            <div class="form-group col-md-12">
                <input type="text" id="name" class="form-control" ng-model="reference.name" placeholder="Referencia">
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" type="button" ng-click="modalReference.dismiss()">Cancel</button>
          <button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()">Guardar</button>
          <button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()">Actualizar</button>
      </div>
    </form>
  </script>

@endsection

@section('scripts')
  <script src="{{ asset('js/controllers/CatReferencesController.js') }}"></script>
@endsection