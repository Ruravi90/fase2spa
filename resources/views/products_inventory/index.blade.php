@extends('layouts.app')
@section('content')
  <div ng-controller="ProductInventoryController" ng-cloak>
    <div class="box box-primary color-palette-box">
      <div class="box-header with-border">
      	<h3 class="box-title"><i class="fa fa-group"></i> Inventario de productos</h3>
      	<button class="btn btn-xs btn-primary" ng-click="add()">
        	<i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- List group -->
      <ul class="list-group">
        <li class="list-group-item" ng-repeat="product in inventory | filter:anySearch">
          <div class="row">
          	<div class="col-md-4"><%product.product.name%></div>
            <div class="col-md-4">Precio: $<%product.product.price%></div>
            <div class="col-md-3">En stock: <%product.count%></div> 
            <div class="col-md-1">
            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
				      <button class="btn btn-xs btn-default pull-right" ng-click="edit()"><i class="fa fa-edit"></i></button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script type="text/ng-template" id="modalInventory.html">
	<form name="userForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nuevo' %> inventario</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="userForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
			<div class="row">
				<div class="form-group col-md-12">
			    	<select id="cmbRol" 
			    			style="width: 100%"
                            data-placeholder="Selecciona el rol"
                            ng-model="product.product_id"
                            sc-single-select>
                        <option ng-repeat="item in catProducts" ng-value="item.id" >
                           <%item.name%>
                        </option>
                    </select>
                </div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
			    	<input type="numero" class="form-control" ng-model="product.count" />
                </div>
			</div>
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
  <script src="{{ asset('js/controllers/ProductInventoryController.js') }}"></script>
@endsection