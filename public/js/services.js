
/* Controllers */


var DMServices = angular.module('DMServices', ['ngResource']);


DMServices.factory('Proyecto', ['$resource', function($resource)
{
  return $resource('/api/proyectos/:id', null,
  	{update:{
      method: 'PUT'
    }
});
 }]);

DMServices.factory('Categoria', ['$resource', function($resource)
{
  return $resource('/api/categorias/:id');
 }]);

