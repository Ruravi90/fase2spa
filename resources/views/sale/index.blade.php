@extends('layouts.app')
@section('content')
  <div ng-controller="SalesController" ng-cloak>
	<div class="col-md-12">
		<div class="box box-primary color-palette-box">
		      <div class="box-header with-border">
		      	<h3 class="box-title"><i class="fa fa-usd"></i> Vetas</h3>
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
  </div>

  <script type="text/ng-template" id="modalSale.html">
	<form name="saleForm" novalidate>
		<div class="modal-header">
      		<h3 class="modal-title" id="modal-title"><% IsEdit?'Editar':'Nueva' %> venta</h3>
      	</div>
      	<div class="modal-body" id="modal-body">
      		<div class="row" ng-if="saleForm.$invalid">
      			<div class="col-md-12">
      				<label class="text-red">Los campos en rojo son requeridos.</label>
      			</div>
      		</div>
			<div class="row">
				<div class="form-group col-md-5"  ng-class="{'has-error':saleForm.cmbDepartments.$invalid && saleForm.cmbDepartments.$pristine}">
                    <select id="cmbDepartments" 
                    		name="cmbDepartments"
                    		class="form-control"
			    			style="width: 100%"
                            data-placeholder="Selecciona el departamento"
                            ng-model="addSale.department_id"
                            sc-single-select>
                        <option ng-repeat="item in departments" ng-value="item.id" ng-model="addSale.department_id">
                           <%item.name%>
                        </option>
                    </select>
                </div>
			  	<div class="form-group col-md-7"  ng-class="{'has-error':saleForm.cmbClients.$invalid && saleForm.cmbClients.$pristine}">
					<select id="cmbClients" 
							nameid="cmbClients" 
							class="form-control"
			    			style="width: 100%"
                            data-placeholder="Selecciona el tipo"
                            ng-model="addSale.client_id"
                            sc-single-select>
                        <option ng-repeat="item in clients" ng-value="item.id"  ng-model="addSale.client_id">
                           <%item.name + ' ' + item.lastname%>
                        </option>
                    </select>
                </div>
			</div>
			<div class="box box-primary color-palette-box">
		      <div class="box-header with-border">
		      	<h3 class="box-title"><i class="fa fa-cart-plus"></i> Agregar elementos</h3>
		      </div>
		      <div class="box-body">
		      	<div class="row">
					<div class="form-group col-md-3" ng-class="{'has-error':saleForm.cmbSaleType.$invalid && saleForm.cmbSaleType.$pristine}">
				    	<select id="cmbSaleType" 
				    			name="cmbSaleType" 
				    			ng-change="onSelectSaleType()"
				    			style="width: 100%"
	                            data-placeholder="Selecciona los permisos"
	                            ng-model="addSale.type_id"
	                            sc-single-select>
	                        <option ng-repeat="item in saleTypes" ng-value="item.id" >
	                           <%item.name%>
	                        </option>
	                    </select>
				  	</div>
				  	<div class="form-group col-md-6" ng-class="{'has-error':saleForm.cmbInventary.$invalid && saleForm.cmbInventary.$pristine}">
				    	<select id="cmbInventary" 
				    			name="cmbInventary" 
				    			ng-change="onSelecteElement()"
				    			style="width: 100%"
	                            data-placeholder="Selecciona el tipo"
	                            ng-model="addSale.element_id"
	                            sc-single-select>
	                        <option ng-repeat="item in elements" ng-value="item.id" >
	                           <%item.name%>
	                        </option>
	                    </select>
				  	</div>
				  	<div class="form-group col-md-3" ng-class="{'has-error':saleForm.discount.$invalid && saleForm.discount.$pristine}">
						<div class="input-group">
					      <input type="number" class="form-control" name="discount" ng-model="addSale.discount" 
					      min="0" max="100"
					      ng-change="onCalculateTotal()" ng-model-options='{ debounce: 1000 }'>
					      <span class="input-group-addon">%</span>
					    </div>
				  	</div>
				</div>
				<div class="row" ng-if="addSale.element_id">
					<div class="col-md-2" ng-if="(addSale.type_id == 'pill')">	
						<input type="number" class="form-control" name="count" min="0" 
						ng-model="addSale.count"
						ng-change="onCalculateTotal()" ng-model-options='{ debounce: 1000 }'>
					</div>
					<div class="col-md-5">	
						<label class="text-danger "><% 'Subtotal ' + (selectedElement.price | currency:"MX$":0)%></label>
					</div>
					<div class="col-md-5">
						<label class="text-danger"><% 'Total ' + (selectedElement.total | currency:"MX$":0)%></label>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-11" ng-class="{'has-error':saleForm.description.$invalid && saleForm.description.$pristine}">
				    	<textarea ng-if="addSale.discount" name="description" class="form-control" ng-model="addSale.description" 
				    	placeholder="Descripción del descuento"></textarea>
				  	</div>
				  	<div class="form-group col-md-1" >
				    	<button class="btn btn-sm btn-primary pull-right" ng-click="onAddSale()">
				    		<i class="fa fa-plus"></i>
				    	</button>
				  	</div>
				</div>
		      </div>
		    </div>
		    <div class="box box-primary color-palette-box">
		      <div class="box-header with-border">
		      	<h3 class="box-title"><i class="fa fa-shopping-cart"></i> Carrito</h3>
		      </div>
		      <!-- List group -->
		      <ul class="list-group">
		        <li class="list-group-item" ng-repeat="confirmSale in addSales">
		          <div class="row">
		            <div class="col-md-3"><%confirmSale.type_name%></div>
		            <div class="col-md-5"><%confirmSale.element_name%></div>
		            <div class="col-md-1"><%confirmSale.discount + '%'%></div>
		            <div class="col-md-2"><%confirmSale.total | currency:"MX$":0%></div>
		            <div class="col-md-1">
		            	<button class="btn btn-xs btn-danger pull-right" ng-click="deleted()"><i class="fa fa-trash"></i></button>
		            </div>
		          </div>
		        </li>
		      </ul>
		    </div>
      </div>
      <div class="modal-footer"> 
			<button class="btn btn-default" type="button" ng-click="modalSale.dismiss()">Cancel</button>
          	<button class="btn btn-primary" type="button" ng-if="!IsEdit" ng-click="save()" ng-disabled="saleForm.$invalid">	Generar compra
          	</button>
			<button class="btn btn-primary" type="button" ng-if="IsEdit" ng-click="update()" ng-disabled="saleForm.$invalid">
				Actualizar compra
			</button>
      </div>
	</form>
  </script>
@endsection
@section('scripts')
  <script src="{{ asset('js/controllers/SalesController.js') }}"></script>
@endsection