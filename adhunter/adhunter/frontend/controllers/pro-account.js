adhunterApp.controller('proaccount', function($scope, $http, $window, $state, $location, services) {
$scope.page = 'Step 1 of 2';
	$scope.prosignup = function () {
        $scope.submitted = true;
        $scope.error = {};
        services.prosignup($scope.prouserModel).success(  
        function (data) {console.log(data);
            	if(data.status == 1){
                          $window.sessionStorage.access_token = data.access_token;
                          $window.sessionStorage.role = data.role;
                          $window.sessionStorage.setItem('user_id', data.user_id);
                          $state.go('proaccount.add-company');
                }
                else{
                	alert('Something wrong!!!');
                }	    
        	}).error(
            function (data) {
                angular.forEach(data, function (error) {
                    $scope.error[error.field] = error.message;
                });
            }
        );
    };
});

adhunterApp.controller('pro-add-company', function($scope, $window, $state, services) {
 
  	if(Boolean($window.sessionStorage.access_token) && $window.sessionStorage.role == "Provider"){
  		$scope.page ='Step 2 of 2';
  		$scope.companyModel = {};
  			services.getSubcategory().then(function(response){
                  $scope.getSubcategory= response.data;
                    // console.log($scope.getSubcategory);
            });
	  		$scope.showCityState = function(zip) {
		        setTimeout(function() {
		        services.getAreaDetailsByZip(zip).then(function(response){
	                  $scope.getAreaDetails= response.data;
	                  if($scope.getAreaDetails){	   
	                  console.log($scope.getAreaDetails);              	 	
	                  		$scope.city_id = $scope.getAreaDetails[0].city_name;
	                  		$scope.state_id = $scope.getAreaDetails[0].state_name;
	                  		$scope.country_id = $scope.getAreaDetails[0].country_name;
	                  		$scope.companyModel.city_id = $scope.getAreaDetails[0].city_id;
	            			$scope.companyModel.state_id = $scope.getAreaDetails[0].state_id;
	            			$scope.companyModel.country_id = $scope.getAreaDetails[0].country_id;
	                  }
		            });
	        	}, 500);
	      	}
  			$scope.addNewCompany = function () {console.log($window.sessionStorage);
  				$scope.submitted = true;
        		$scope.error = {};

	            $scope.companyModel.user_id = $window.sessionStorage.user_id;

  				services.addNewComapny($scope.companyModel).success(
		        function (data) {
					console.log(data);
					$window.sessionStorage.setItem('proid', data.company_id);
		            	if(data.status == 1){
		                          $state.go("myprofile");
		                }
		                else{
		                	alert('Something wrong!!!');
		                }
		        	}).error(
		            function (data){
		                angular.forEach(data, function (error) {
		                    $scope.error[error.field] = error.message;
		                });
		            }
		        );
			}
  	}else{
  		$state.go('home');
  	}
});


			// function format(inputDate) {
			//     var date = new Date(inputDate);
			//     if (!isNaN(date.getTime())) {
			//         var day = date.getDate().toString();
			//         var month = (date.getMonth() + 1).toString();
			//         // Months use 0 index.

			//         return (month[1] ? month : '0' + month[0]) + '/' +
			//            (day[1] ? day : '0' + day[0]) + '/' +
			//            date.getFullYear();
			//     }
			// }