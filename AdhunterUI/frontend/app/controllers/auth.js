
// adhunterApp.controller('ContactController', ['$scope', '$http', '$window',
//     function($scope, $http, $window) {
//         $scope.captchaUrl = 'site/captcha';
//         $scope.contact = function () {
//             $scope.submitted = true;
//             $scope.error = {};
//             $http.post('api/contact', $scope.contactModel).success(
//                 function (data) {
//                     $scope.contactModel = {};
//                     $scope.flash = data.flash;
//                     $window.scrollTo(0,0);
//                     $scope.submitted = false;
//                     $scope.captchaUrl = 'site/captcha' + '?' + new Date().getTime();
//             }).error(
//                 function (data) {
//                     angular.forEach(data, function (error) {
//                         $scope.error[error.field] = error.message;
//                     });
//                 }
//             );
//         };

//         $scope.refreshCaptcha = function() {
//             $http.get('site/captcha?refresh=1').success(function(data) {
//                 $scope.captchaUrl = data.url;
//             });
//         };
//     }]);

adhunterApp.controller('provider', function($scope, $state, $window) {
           $scope.test = 'This is provider dashboard';  
           // $scope.providerDetails = $window.sessionStorage.userdetails; 
           // console.log( $window.sessionStorage.userdetails);  

});

adhunterApp.controller('customer', function($scope, $state, $window) {      
           $scope.test = 'This is Customer dashboard';
           
});

adhunterApp.controller('dashboard', function($scope, $window, $location, $state) {
            if($window.sessionStorage.role == "Provider"){  
                  if(!$window.sessionStorage.proid){
                      $state.go("proaccount.add-company");
                  }          		      
                  else{
                      $state.go("dashboard.provider");

                  }                     
            }else if($window.sessionStorage.role == "Customer"){
                // $scope.user = 'customer';
             		$state.go('dashboard.customer');
            }else{
                //alert($window.sessionStorage.role);
                $state.go('home');
            }
});

adhunterApp.controller('LoginController', function($scope, $window, $state, $location, services,$uibModal) {
        $scope.login = function () {
            $scope.submitted = true;
            $scope.error = {};
            // $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
            services.login($scope.userModel).success(    
                function(data) {
                  console.log(data);
                      if(data.status == 1){
                        // alert("Login Successful");
                          $window.sessionStorage.access_token = data.access_token;
                          $window.sessionStorage.role = data.role;
                          $window.sessionStorage.setItem('userdetails', data.userdetails);
                          if(data.role == "Provider")
                             $window.sessionStorage.setItem('proid', data.userdetails['id']);
                          $state.go('dashboard');
                          // $location.path('dashboard').replace();
                          $scope.close();
                          console.log("-----"); console.log(data);  console.log("-----");                
                      }else{
                            alert("Invalid user Or Email Not Verified");
                            delete $window.sessionStorage.access_token;
                            delete $window.sessionStorage.role;
                            delete $window.sessionStorage.userdetails
                            delete $window.sessionStorage.proid
                            $state.go('home');
                      }	          
                }).error(
                    function(data) {
                        angular.forEach(data, function (error) {
                            $scope.error[error.field] = error.message;
                        });
                    }
                );
        };
    
        $scope.forgetpassword = function () {
    			  $(".modal,.modal-backdrop").hide();
    			  var modalInstance = $uibModal.open({
        				templateUrl: 'views/forgetpassword-popup.html',
        				windowClass: 'app-forgetpassword-window',			
			     });
        }
        $scope.close = function () {
            $(".modal,.modal-backdrop").hide();
            $location.path('/').replace();
        }
        
});

adhunterApp.controller('signup', function($scope, $http, $window, $state, $location, services) {
        $scope.signup = function () {
            $scope.submitted = true;
            $scope.error = {};
            services.signup($scope.userModel).success(  
            function (data) {                  
              // console.log(data);
                    	alert("Registration successful");                
                    $scope.close();
                    $state.go('home');
			          
            }).error(
                function (data) {
                    angular.forEach(data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };
        $scope.close = function () {
    			$(".modal,.modal-backdrop").hide();
          $location.path('/').replace();
    		}
});

