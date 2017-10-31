var app = angular.module('App');

app.controller('CatPackagesController', function($rootScope, $scope, $http, $document, $uibModal, $ngConfirm, Notification) {
    $scope.pageSize = 10;
    $scope.currentPage = 1;
    $scope.getPackages = function() {
        $http.get(geturl() + 'api/cat_packages').then(function(xhr) {
            $scope.packages = xhr.data;
        });
    }

    /**/
    $scope.getPackages();
    $scope.showModal = function() {
        var parentElem = angular.element($document[0].querySelector('body'));
        $scope.modalPackage = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalPackage.html',
            controller: 'ModalCatPackagesCtrl',
            appendTo: parentElem,
            scope: $scope
        });

        $scope.modalPackage.result.then(function(result) {
            $scope.getPackages();
        }).catch(function(error) {});

    }

    $scope.add = function() {
        $scope.IsEdit = false;
        $scope.package = {};
        $scope.showModal();
    }

    $scope.edit = function() {
        $scope.IsEdit = true;
        $http.get(geturl() + 'api/cat_packages/' + this.package.id).then(function(xhr) {
            $scope.package = xhr.data;
            $scope.showModal();
        });
    }

    $scope.deleted = function(_token) {
        var _this = this;
        $ngConfirm({
            title: 'Confirmar!',
            content: 'Seguro de eliminar la Paquete?',
            scope: $scope,
            buttons: {
                No: {
                    text: 'Cancelar',
                    btnClass: 'btn-default',
                    action: function(scope, button) {}
                },
                Si: {
                    text: 'Si, confirmar!',
                    btnClass: 'btn-danger',
                    action: function(scope, button) {
                        $http.delete(geturl() + 'api/cat_packages/' + _this.package.id).then(function(xhr) {
                            $scope.getPackages();
                            Notification.success({
                                message: 'Paquete eliminado correctamente!'
                            });
                        });
                    }
                },
            }
        });
    }
});

app.controller('ModalCatPackagesCtrl', function($http, $scope, $uibModalInstance, Notification) {
    $scope.save = function() {
        var data = {
            name: $scope.package.name,
            price: $scope.package.price,
        }

        $http.post(geturl() + 'api/cat_packages', data).then(function(xhr) {
            Notification.success({
                message: 'Paquete creada correctamente!'
            });
            $uibModalInstance.close('add');
        });

    }

    $scope.update = function() {
        var data = {
            name: $scope.package.name,
            price: $scope.package.price,
        }

        $http.put(geturl() + 'api/cat_packages/' + $scope.package.id, data).then(function(xhr) {
            Notification.success({
                message: 'Paquete actualizado correctamente!'
            });
            $uibModalInstance.close('update');
        });
    }
});