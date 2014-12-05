
  var rutaAbsoluta = 'http://decarlinimaside.com/';
  var DMApp = angular.module('DMApp', [
    'ngRoute',
    'ngAnimate',
    'DMControllers',
    'DMServices'], function($interpolateProvider)
  {
    $interpolateProvider.startSymbol('((');
    $interpolateProvider.endSymbol('))');
  });


  DMApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
        templateUrl: 'partials/proyectos/index.html'
      }).
      when('/proyectos/nuevo', {
        templateUrl: 'partials/proyectos/nuevo.html'
      }).
      when('/proyectos/:proyectoId/editar', {
        templateUrl: 'partials/proyectos/editar.html'
      }).
      when('/proyectos/:proyectoId/galeria', {
        templateUrl: 'partials/proyectos/galeria.html'
      }).
      when('/configuracion', {
        templateUrl: 'partials/proyectos/configuracion.html'
      }).
      otherwise({
        redirectTo: '/'
      });
  }]);

  DMApp.filter('orderObjectBy', function() {
  return function(items, field, reverse) {
    var filtered = [];
    angular.forEach(items, function(item) {
      filtered.push(item);
    });
    filtered.sort(function (a, b) {
      return (a[field] > b[field] ? 1 : -1);
    });
    if(reverse) filtered.reverse();
    return filtered;
  };
});
