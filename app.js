// module declaration
var picApp = angular.module('picApp', ['ngRoute', 'ngResource', 'landController', 'beautyController', 'skyController']);

// route provider
picApp.config(function($routeProvider) {
    
           $routeProvider
           
           .when('/', {                                     // this is the area where URL is typed
                templateUrl: 'landscape.php',               // this is the path where route will actually take you to
                controller: 'landController'
            })
   
            .when('/skyscraper', {                          // skyscraping routing controller
                templateUrl: 'skyscraper.php',
                controller: 'skyController'
            })
            
            .when('/beauty', {                              // beauty routing controller
                templateUrl: 'beauty.php',
                controller: 'beautyController'
            })
            
});


// landscape controller
picApp.controller('landController', ['$scope', function($scope){
    
}]);

// skyscrape controller
picApp.controller('skyController', ['$scope', function($scope){
    
}]);

// beauty controller
picApp.controller('skyController', ['$scope', function($scope){
    
}]);

