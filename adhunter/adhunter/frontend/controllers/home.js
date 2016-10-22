
adhunterApp.controller('home',function($scope, $rootScope, $location, $http, $uibModal, $window, $state, services) {
	$scope.location_error = "";
    $scope.current = $state.current

    $scope.isActive = function(route) {
        return route === $location.path();
    }
    if($location.path() == '/proaccount/pro-signup' || $location.path() == '/proaccount/add-company'){
        $scope.hideNav = true;
    }
	$scope.getlocation = function() {
			if (isNaN($scope.zip)) {
				$scope.location_error = "Invalid Zipcode";
				return false;

    		}else{
    			 getAddressInfoByZip($scope.zip);

	            function response(obj){
		            if(obj.success != false){
		            	$scope.city = obj.city;
		                $scope.state = obj.state;
		                $window.sessionStorage.current_zip = obj.zipcode;
		                
		                $scope.current_zip = $window.sessionStorage.current_zip;
		                $scope.location_error = "";
                    $scope.$apply();


			            // console.log( $window.sessionStorage.current_zip );
		            }else{
		            	$scope.location_error = "Invalid Zipcode";
		            }            
	            }
    		}
           
                        
         function getAddressInfoByZip(zip){
          if(zip.length >= 5 && typeof google != 'undefined'){
            var addr = {};
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': zip }, function(results, status){
              if (status == google.maps.GeocoderStatus.OK){
            if (results.length >= 1) {
              for (var ii = 0; ii < results[0].address_components.length; ii++){
                var street_number = route = street = city = state = zipcode = country = formatted_address = '';
                var types = results[0].address_components[ii].types.join(",");
                if (types == "street_number"){
                  addr.street_number = results[0].address_components[ii].long_name;
                }
                if (types == "route" || types == "point_of_interest,establishment"){
                  addr.route = results[0].address_components[ii].long_name;
                }
                if (types == "sublocality,political" || types == "locality,political" || types == "neighborhood,political" || types == "administrative_area_level_3,political"){
                  addr.city = (city == '' || types == "locality,political") ? results[0].address_components[ii].long_name : city;
                }
                if (types == "administrative_area_level_1,political"){
                  addr.state = results[0].address_components[ii].short_name;
                }
                if (types == "postal_code" || types == "postal_code_prefix,postal_code"){
                  addr.zipcode = results[0].address_components[ii].long_name;
                }
                if (types == "country,political"){
                  addr.country = results[0].address_components[ii].long_name;
                }
              }
              addr.success = true;
              for (name in addr){
                //  console.log('### google maps api ### ' + name + ': ' + addr[name] );
              } //return addr;
              response(addr);
            } else {//return false;
              response({success:false});
            }
              } else {//return false;
            response({success:false});
              }
            });
          } else {//return false;
            response({success:false});
          }
        }
             
    };



	navigator.geolocation.getCurrentPosition(function (position) {
		var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';
         $.getJSON(GEOCODING).done(function(location) {
         	// alert($window.sessionStorage.current_zip+' '+$scope.current_zip);
        	if(!$window.sessionStorage.current_zip){
	        	$scope.city = location.results[0].address_components[5].long_name;
	        	$scope.state = location.results[0].address_components[7].short_name;
        		$scope.current_zip  = location.results[0].address_components[9].long_name;			
        		$scope.$apply();   
        	}else{
        		$scope.zip = $window.sessionStorage.current_zip;
        		$scope.$apply();  
        		$scope.getlocation();
        	} 	
        	  	       	     
        });  
    }, function () {

    });

	 $scope.loggedIn = function() {
        return Boolean($window.sessionStorage.access_token);
    };

    $scope.logout = function () {
        delete $window.sessionStorage.access_token;
        delete $window.sessionStorage.role;
        delete $window.sessionStorage.userdetails;
        delete $window.sessionStorage.proid;
        $location.path('/').replace();
    };
    var serviceList;
    $scope.getCategoryList = function (subcat) {
        if(subcat.length > 1){ 
            services.getSubcategoryListHomePage(subcat).then(function(response){
              if(response.data)
                  $scope.serviceList = response.data.map(function(a) {return a;});
            }); 
        } 
    }

    $rootScope.login = function () {
		$(".modal,.modal-backdrop").hide();
		var modalInstance = $uibModal.open({
			templateUrl: 'views/login-popup.html',
			windowClass: 'app-login-window',
			
		});
	}

    $rootScope.register = function () {
			$(".modal,.modal-backdrop").hide();
			var modalInstance = $uibModal.open({
			templateUrl: 'views/register-popup.html',
			windowClass: 'app-register-window',
		});
	}  
           
  $scope.selected = '';         
	$scope.searchcat = function (cat) {
		if(cat == ''){
			$scope.selected = 'Please Enter Category';
			return false;
		}
		for (i = 0; i < $scope.serviceList.length; i++) { 
		   if($scope.serviceList[i].name == cat){
		   		cat_id = $scope.serviceList[i].id;
		   }
		}
		var modalInstance = $uibModal.open({
			templateUrl: 'views/leadquestions-popup.html',
			controller: 'leadquestion',
                            windowClass: 'app-leadquestion-window',
                            size:'lg',
                     
            resolve: {
                param: function () {
                    return {'cat_id':cat_id,};
                }
            }
		});
	}
});





