(function()
{
  'use strict';
  var rutaAbsoluta = 'http://decarlinimaside.com/';
  var DMApp = angular.module('DMApp', ['ngRoute'], function($interpolateProvider)
  {
    $interpolateProvider.startSymbol('((');
    $interpolateProvider.endSymbol('))');
  });

  DMApp.controller('ProyectoController', function($scope, $http, $location, $window){
    

    this.proyecto = {};
    this.addProyecto = function()
    {
      $http.post(rutaAbsoluta + 'admin/proyectos/guardar', this.proyecto).
      success(function(data)
        {
          console.log(data);
          if(data.success)
            {
              $window.location.href = rutaAbsoluta + 'admin/proyectos/' + data.proyecto.id + '/galeria';
            }//$location.path('/../'+ data.proyecto.id + '/galeria');
        });
      $window.location.href = 'http://www.google.com';
      //window.alert('agregado');
      this.proyecto = {};
      this.submitted = false;
    };
  });




  //service
/*  angular.module('proyectoService', [])
  .factory('Proyecto', function($http)
  {
    return
    {
      save:function(proyecto)
      {

      }
    }
  });*/
})();