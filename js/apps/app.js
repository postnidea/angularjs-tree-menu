// Creating an Angular JS Module
var CrudApp = angular.module('ProductDesignerApp',[
		'ngResource',
		'ngRoute',
		'mgcrea.ngStrap.modal',
		'mgcrea.ngStrap.tab',
		'crudService',
		'crudControllers',
		'multi_level_selector'
		]);


// Creating a Angular JS Configuration. 
 CrudApp.config(function($sceProvider) {
    // Completely disable SCE.  For demonstration purposes only!
    // Do not use in new projects.
    $sceProvider.enabled(false);
  });

CrudApp.config(['$routeProvider',function($routeProvider){

$routeProvider.
	when('/',
			{
				templateUrl:'partials/home.html',
				controller : 'homeCtrl'
			}
		).
	otherwise({
			redirectTo :'/home'
	});
}]);