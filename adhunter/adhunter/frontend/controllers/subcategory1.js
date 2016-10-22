'use strict';
spaApp_subcategory.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/subcategory/index', {
            templateUrl: 'views/subcategory/index.html',
            controller: 'index'
        })
        .otherwise({
            redirectTo: '/subcategory/index'
        });
}]);

spaApp_subcategory.controller('index', ['$scope', '$http', 'services',
        function($scope, $http, services) {
            $scope.message = 'Everyone come and see how good I look!';
            services.getSubcategorys().then(function(data) {
                $scope.subcategorys = data.data;
            });
        }
    ]);
