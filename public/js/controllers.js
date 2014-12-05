/* Controllers */
var DMControllers = angular.module('DMControllers', ['blueimp.fileupload', 'ui.bootstrap']);

//
DMControllers.config([
        '$httpProvider', 'fileUploadProvider',
        function($httpProvider, fileUploadProvider) {
            delete $httpProvider.defaults.headers.common['X-Requested-With'];
            fileUploadProvider.defaults.redirect = window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            );
            angular.extend(fileUploadProvider.defaults, {
                // Enable image resizing, except for Android and Opera,
                // which actually support image resizing, but fail to
                // send Blob objects via XHR requests:
                url: 'galeria/cargarImagenes',
                dataType: 'json',
                autoUpload: true,
                sequentialUploads: true,
                disableImagePreview: true,
                disableImageResize: /Android(?!.*Chrome)|Opera/
                    .test(window.navigator.userAgent),
                maxFileSize: 5000000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
            });
        }
    ])
    //

DMControllers.controller('ProyectoListaController', ['$scope', 'Proyecto', '$modal', '$http', function($scope, Proyecto, $modal, $http) {
    this.proyectos = Proyecto.query();
    var p = this.proyectos;
    $scope.parseOrden = function(val) {
            val.orden = parseInt(val.orden);
        }

    this.openBorrarProyecto = function(proyecto) {
        var modalInstance = $modal.open({
            templateUrl: 'modalBorrarProyecto.html',
            scope: $scope,
            controller: function() {
                $scope.proyecto = proyecto;

                $scope.eliminarProyecto = function() {
                    $http.get('api/proyectos/' + proyecto.id + '/eliminar');
                    index = p.indexOf(proyecto);
                    p.splice(index, 1);
                    modalInstance.close();
                }
                $scope.cancelar = function() {
                    modalInstance.close();
                }
            },
            resolve: {
                proyecto: function() {
                    return 'proyecto';
                }
            }
        });
    }
}]);

DMControllers.controller('NuevoProyectoController', ['$scope', 'Proyecto', '$location', function($scope, Proyecto, $location) {
    this.storeProyecto = function()
    {
        Proyecto.save(this.proyecto, function(data)
        {
            $location.path('/proyectos/' + data.proyecto.id + '/galeria');   
        });
    }
}]);

DMControllers.controller('EditarProyectoController', ['$scope', '$routeParams', 'Proyecto', 'Categoria', '$location', function($scope, $routeParams, Proyecto, Categoria, $location) {
    this.proyecto = Proyecto.get({
        id: $routeParams.proyectoId
    });
    this.categorias = Categoria.query();

    this.updateProyecto = function() {
        Proyecto.update({
            id: this.proyecto.id
        }, this.proyecto);
        $location.path('/');
    }
}]);

DMControllers.controller('GaleriaProyectoController', ['$scope', '$routeParams', 'Proyecto', 'Categoria', '$http', '$modal', function($scope, $routeParams, Proyecto, Categoria, $http, $modal) {
    $scope.proyecto = Proyecto.get({
        id: $routeParams.proyectoId
    });
    $scope.progreso = 0;
    var p = $scope.proyecto;
    var sorted = null;
    $('#contenedorImagenes').sortable({
        start: function(event, ui) {
            ui.item.children('.eliminar').addClass('hidden');
        },
        stop: function(event, ui) {
            //
            sorted = $(".selector").sortable("toArray");
            $http.post('admin/proyectos/' + p.id + '/galeria/ordenar', {
                    'sorted': sorted
                })
                .success(function(data) {
                    angular.forEach($scope.proyecto.imagenes, function(value, index) {
                        value.orden = parseInt(data.ordenes[index].orden);
                    });

                });

            ui.item.children('.eliminar').removeClass('hidden');

            //actualizarOrdenGaleria({{ $proyecto->id }});
        }
    });
    $('#contenedorImagenes').disableSelection();

    //
    $scope.parseOrden = function(val) {
            val.orden = parseInt(val.orden);
        }
        //  

    $scope.hoverIn = function() {
        this.hoverImagen = true;
    };

    $scope.hoverOut = function() {
        this.hoverImagen = false;
    };
    this.options = {
        url: 'admin/proyectos/' + $routeParams.proyectoId + '/galeria/cargarImagenes',
        dataType: 'json',
        autoUpload: true,
        sequentialUploads: true,
        disableImagePreview: true,
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        maxFileSize: 5000000,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        progressall: function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.progress-bar').css(
                'width',
                progress + '%'
            );
            this.proyecto = Proyecto.get({
                id: $routeParams.proyectoId
            });
            this.progreso = progress;
        },
        done: function(e, data) {
            p.imagenes.push(data._response.result.nuevaImagen);
        }
    };

    this.getImagenSrc = function(imagen) {
            //http://decarlinimaside.com/(( imagen.ruta ))min/hola.jpg(( foto.nombre_archivo ))
            return 'http://decarlinimaside.com/' + imagen.ruta + 'min/' + imagen.nombre_archivo;
        }
        //this.proyecto.categoria = this.proyecto.categoria;

    this.openBorrarFoto = function(imagen) {
        var modalInstance = $modal.open({
            templateUrl: 'modalBorrarFoto.html',
            scope: $scope,
            controller: function() {
                $scope.imagen = imagen;

                $scope.eliminarFoto = function() {
                    index = p.imagenes.indexOf(imagen);
                    $http.get('api/imagenes/' + imagen.id + '/eliminar');
                    p.imagenes.splice(index, 1);
                    modalInstance.close();
                }
                $scope.cancelar = function() {
                    modalInstance.close();
                }
            },
            resolve: {
                imagen: function() {
                    return 'foto';
                }
            }
        });
    }

    this.openBorrarFotos = function(imagen) {
        var modalInstance = $modal.open({
            templateUrl: 'modalBorrarFotos.html',
            scope: $scope,
            controller: function() {
                $scope.imagen = imagen;

                $scope.eliminarFotos = function() {
                    //index = p.imagenes.indexOf(imagen);
                    //p.imagenes = null;
                    p.imagenes.splice(0, p.imagenes.length);
                    $http.get('api/proyectos/' + p.id + '/eliminarImagenes');
                    //p.imagenes.splice(index, 1);
                    modalInstance.close();
                }
                $scope.cancelar = function() {
                    modalInstance.close();
                }
            },
            resolve: {
                imagen: function() {
                    return 'foto';
                }
            }
        });
    }
}]);

DMControllers.controller('UsuarioController', ['$scope', '$routeParams', '$http', '$location', function($scope, $routeParams, $http, $location) {
    $http.get('api/usuario')
    .success(function(data) {
        $scope.usuario = data.usuario;
    });

    $scope.noCoinciden = false;
    $scope.claveValida = true;
    $scope.cambiada = false;
    $scope.submitted = false;
    $scope.claveIncorrecta = false;

    $scope.invalidarClave = function()
    {
        $scope.claveValida = true;
    }

    $scope.evaluarNuevaClave = function()
    {
        if($scope.usuario.claveNueva == $scope.usuario.claveNueva_confirmation)
            $scope.noCoinciden = false;
        else
            $scope.noCoinciden = true;
    }

    $scope.updateUsuario = function()
    {
        $http.post('api/usuario/actualizarDatos', {
                    'usuario': $scope.usuario
                })
                .success(function(data)
                {
                    if(data.ok == true)
                    {
                        $scope.claveIncorrecta = true;
                        $scope.cambiada = true;
                        $scope.submitted = false;
                        $scope.usuario.clave = '';
                        $scope.usuario.claveNueva = '';
                        $scope.usuario.claveNueva_confirmation = '';
                        $scope.formCambioClave.$setPristine();
                    }
                    else
                    {
                        $scope.claveIncorrecta = true;
                        $scope.usuario.clave = '';
                        $scope.usuario.claveNueva = '';
                        $scope.usuario.claveNueva_confirmation = '';
                        //$scope.formCambioClave.$setPristine();
                    }
                });
    }

    this.updateProyecto = function() {
        Proyecto.update({
            id: this.proyecto.id
        }, this.proyecto);
        $location.path('/');
    }
}]);