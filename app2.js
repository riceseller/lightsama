
// module
var picApp = angular.module('picApp', ['ngRoute', 'ngResource']);



// router
picApp.config(function($routeProvider) {
   $routeProvider
            .when('/', {
                templateUrl: 'page1.php',
                controller: 'page1Controller',
                directive: 'page1Directive'
            })
            .when('/:category', {
                templateUrl: 'page1.php',
                controller: 'page1Controller',
                directive: 'page1Directive'
            })
});

// controller

picApp.controller('page1Controller', ['$scope', '$resource', '$routeParams', function($scope, $resource, $routeParams){
        
        
        $scope.category = $routeParams.category || 'landscape';                     // parse parameters
        $scope.indexRequest = $resource("/index_json.php");
        $scope.indexResult = $scope.indexRequest.get({category: $scope.category});  // get json encoding result 

}]);
