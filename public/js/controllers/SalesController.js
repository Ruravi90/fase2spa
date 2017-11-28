var app = angular.module('App');


app.filter('highlight', function($sce) {
    return function(text, phrase) {
      if (phrase) text = text.replace(new RegExp('('+phrase+')', 'gi'),
        '<span class="highlighted">$1</span>')

      return $sce.trustAsHtml(text)
    }
})

app.controller('SalesController',function($rootScope,$scope, $http,$document,$uibModal,$ngConfirm,Notification) {
    var $ctrl = this;
    $scope.pageSize = 10;
    $scope.currentPage = 1;

    $scope.getUsers=function(){
        $http.get(geturl()+'api/users')
        .then(function(xhr){
            $scope.users = xhr.data;
        });
    }
    
    $scope.getUsers(); 

    $scope.showModal = function(){
        var parentElem =  angular.element($document[0].querySelector('body'));
        $scope.modalSale = $uibModal.open({
            animation: true,
            templateUrl: 'modalSale.html',
            controller:'ModalSaleCtrl', 
            scope: $scope
        })

        $scope.modalSale.result.then(function (result) {
             $scope.getUsers(); 
        }, function () {
        });
    }

    $scope.add = function(){
        $scope.IsEdit =false;
        $scope.sale ={};
        $scope.showModal();
    }

    $scope.edit = function(){
        $scope.IsEdit = true;
        $http.get(geturl()+'api/users/'+this.user.id)
        .then(function(xhr){
            $scope.user = xhr.data;
            $scope.showModal();
        }); 
    }

    $scope.deleted= function(_token){
        var _this = this;
        $ngConfirm({
            title: 'Confirmar!',
            content: 'Seguro de eliminar al Proveedor?',
            scope: $scope,
            buttons: {
                No: {
                    text: 'Cancelar',
                    btnClass: 'btn-default',
                    action: function(scope, button){
                    }
                },
                Si: {
                    text: 'Si, confirmar!',
                    btnClass: 'btn-danger',
                    action: function(scope, button){
                        $http.delete(geturl()+'api/users/'+_this.user.id) 
                        .then(function(xhr){
                            $scope.getProviders();
                            Notification.success({message:'Proveedor eliminado correctamente!'});
                        });
                    }
                },
            }
        });
    }
});
 
app.controller('ModalSaleCtrl', function ($http,$scope,$uibModalInstance,Notification) {
    $scope.init_roles=[];
    $scope.clients=[];
    $scope.addSales=[];
    $scope.addSale={};
    $scope.addSale.discount = 0;
    $scope.addSale.count = 1;
    $scope.saleTypes=[
        {id:"product",name:"Producto"},
        {id:"service",name:"Servicio"},
        {id:"package",name:"Paquete"},
        {id:"pill",name:"Pastillas"},
    ];
    $scope.validUsername = null;

    $http.get(geturl()+'api/departments')
    .then(function(xhr){
        $scope.departments = xhr.data;
    });

    $http.get(geturl()+'api/clients')
    .then(function(xhr){
        $scope.clients = xhr.data;
    });


    $scope.onSelectSaleType=function(){
        var url = "";
        switch ($scope.addSale.type_id) {
            case "product":
                url = geturl()+'api/cat_products';
                break;
            case "service":
                url = geturl()+'api/cat_services';
                break;
            case "package":
                url = geturl()+'api/cat_packages';
                break;
            case "pill":
                url = geturl()+'api/cat_pills';
                break;
        }

        $http.get(url)
        .then(function(xhr){
            $scope.elements = xhr.data;
        });

    }

    $scope.onSelecteElement=function(){
         $scope.selectedElement = $scope.elements[$scope.elements.findIndex(e=> e.id === $scope.addSale.element_id)];
         $scope.onCalculateTotal();
    }

    $scope.onCalculateTotal=function(){
        var total = $scope.selectedElement.price;
        if($scope.addSale.type_id == "pill"){
            total = $scope.selectedElement.price * $scope.addSale.count;
        }
        $scope.selectedElement.discount = (($scope.addSale.discount * total) / 100);
        $scope.selectedElement.total = total - $scope.selectedElement.discount; 
    }

    $scope.onAddSale =function(){

        var data = {
            department_id:$scope.addSale.department_id,
            client_id:$scope.addSale.client_id,
            discount:$scope.addSale.discount,
            description:$scope.addSale.description,
        }

        switch ($scope.addSale.type_id) {
            case "product":
                data.product_id = $scope.addSale.element_id;
                break;
            case "service":
                data.service_id = $scope.addSale.element_id;
                break;
            case "package":
                data.package_id = $scope.addSale.element_id;
                break;
            case "pill":
                data.pill_id = $scope.addSale.element_id;
                break;
        }

        data.type_name =  $scope.saleTypes[$scope.saleTypes.findIndex(e=> e.id === $scope.addSale.type_id)].name;
        data.element_name =  $scope.selectedElement.name;
        data.total =  $scope.selectedElement.total;
        $scope.addSales.push(data);

        $scope.addSale.discount = null;
        $scope.addSale.description = null;
        $scope.addSale.type_id = null;
        $scope.elements=[];
        $scope.addSale.element_id = null;
        $scope.selectedElement = {};
    }

    $scope.save = function(){
        $http.post(geturl()+'api/sales',$scope.sale)  
        .then(function(xhr){
            Notification.success({message:'Usuario creado correctamente!'});
            $uibModalInstance.close('ok');
        });
    }

    $scope.update = function(){ 
        var data = {
            name:$scope.user.name,
            lastname:$scope.user.lastname,
            motherlastname:$scope.user.motherlastname,
            email:$scope.user.email,
            username:$scope.user.username,
            phone_mobile:$scope.user.phone_mobile,
            roles:$scope.user.roles
        }
        $http.put(geturl()+'api/users/'+$scope.user.id,data)
        .then(function(xhr){
            Notification.success({message:'Usuario actualizado correctamente!'});
            $uibModalInstance.close('ok');
        });
    }
});