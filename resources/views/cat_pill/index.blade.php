@extends('layouts.app')

@section('content')

  <div ng-controller="CatProductsController" ng-cloak>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          Productos
          <button class="btn btn-xs btn-default pull-right" ng-click="add()">
          Nuevo producto 
          </button>
        </div>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="product in products">
          <div class="row">
            <div class="col-md-10"><%product.name%></div>
            <div class="col-md-2">
              <button class="btn btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
        <button class="btn btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalProduct.html">
    <form id="productForm">
      <div class="modal-header">
          <h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> Producto</h3>
      </div>
      <div class="modal-body" id="modal-body">
          <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Producto</label>
                <input type="text" id="name" class="form-control" ng-model="product.name">
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" type="button" ng-click="modalProduct.dismiss()">Cancel</button>
          <button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()">Guardar</button>
          <button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()">Actualizar</button>
      </div>
    </form>
  </script>

@endsection

@section('scripts')
  <script src="{{ asset('controllers/CatProductsController.js') }}"></script>
@endsection