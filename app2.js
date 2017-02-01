// module
var picApp = angular.module('picApp', ['ngRoute', 'ngResource']);

// router
picApp.config(function($routeProvider) {
   $routeProvider
   
            .when('/', {
                templateUrl: 'page1.php',
                controller: 'page1Controller'
   })
           .when('/page2.php', {
               templateUrl: 'page2.php',
               controller: 'page2Controller'
   })
   
   
});

// controller
picApp.controller('page1Controller', ['$scope', function($scope){
        
}]);

picApp.controller('page2Controller', ['$scope', function($scope){
        
}]);

