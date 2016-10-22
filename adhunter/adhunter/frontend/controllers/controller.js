
'use strict';

adhunterApp.controller('myAutoCtrl',function($scope, $http) {
   var categories;
  $scope.selected = undefined;
   $http.get("http://sachin/Advisorhunter/adhunter/adhunter/api/web/v1/subcategories")
            .then(function(response) {
            //$scope.categories= response.data;
            $scope.categories = response.data.map(function(a) {return a.name;});
        console.log(categories);
        });
  
});
 