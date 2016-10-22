
adhunterApp.controller('searchpro', function($scope, $rootScope, $window, $location, $state, services, $uibModal) {

      $scope.project_image_url = S3uploadsBase+'project_image/thumbs/midsize/'
      $scope.profile_image_url = S3uploadsBase+'profile/thumbs/midsize/'
      $scope.banner_image_url = S3uploadsBase+'banner/thumbs/midsize/'
      $scope.current_year = new Date().getFullYear();
      services.getSubcategory().then(function(response){
	        // console.log(response.data);
	        $scope.categories = response.data.map(function(a) {return a;});
	    });

      services.getMainCategoryList().then(function(response){
          // console.log(response.data);
          // var maincategories = response.data.map(function(a) {return a;});
          var maincategories = response.data;
          angular.forEach(maincategories, function(maincategory, key) {

            services.getSubcategoryByCategory(maincategory.id).then(function(response){
                // console.log(response.data);
                maincategory['subcategories'] = response.data;
            });

            // console.log(maincategory.id);  
          });
          $scope.maincategories = maincategories;
      }); 	

        $scope.searchbyzip = $window.sessionStorage.current_zip;
         // alert($window.sessionStorage.current_zip);
         if($scope.searchbyzip){
               services.getProListByZip($scope.searchbyzip).then(function(response){
                // console.log(response.data);
                  $scope.pros = response.data;
                  // console.log($scope.pros);
               });   
         }
         

            $scope.search1=function(){
                    console.log($scope.searchbyzip);
                    if($scope.searchbyzip){
                        services.getProListByZip($scope.searchbyzip).then(function(response){
                          $scope.pros = response.data;
                          // console.log($scope.pros);
                      });
                    }   
               }
                // if ($scope.searchbyzip!="") {
                //   services.getProListByZip($scope.searchbyzip).then(function(response){
                //       $scope.pros = response.data;
                //       // console.log($scope.pros);
                //   });
                // };
	              if($scope.searchbyzip){
                      services.getAreaDetailsByZip($scope.searchbyzip).then(function(response){
                          // console.log(response.data);
                          $scope.selectedzip = response.data;
                          // console.log($scope.selectedzip);
                      });
                } 

            $scope.formatPhoneNumber=function (s) {
                var s2 = (""+s).replace(/\D/g, '');
                var m = s2.match(/^(\d{3})(\d{3})(\d{4})$/);
                return (!m) ? null : "(" + m[1] + ") " + m[2] + "-" + m[3];
              }
          $scope.AddReview = function () {
              if(Boolean($window.sessionStorage.access_token) && $window.sessionStorage.role == "Provider") {
                  var modalInstance = $uibModal.open({
                      templateUrl: 'views/pro-write-review.html',
                      windowClass: 'app-write-review',
                  });
              }else{
                  $rootScope.register();
              }
            }
            $scope.reviewModel={};
            $scope.insertReview = function () {
                $scope.submitted = true;
                $scope.error = {};
                if(Boolean($window.sessionStorage.access_token) && $window.sessionStorage.role == "Provider") {
                    if(!$scope.reviewModel['s_review_comment']){
                        $scope.reviewModel['s_review_comment'] = "Please enter comment...";
                        return false;
                    }
                    $scope.reviewModel.fk_i_company_id = $window.sessionStorage.proid;
                    // console.log($scope.reviewModel);
                    services.addReview($scope.reviewModel).success(
                        function (response) {
                            console.log(response);

                        }).error(
                        function (response) {
                            angular.forEach(response, function (error) {
                                $scope.error[error.field] = error.message;
                            });
                        }
                    );

                }

            }
 

});

adhunterApp.controller('showpro', function($scope, $window, $state, $stateParams, services) {
         // services.getProDetails($stateParams.proid).then(function(response){
         // 	 // console.log(response.data);
         //    if(response.data){
         //        $scope.prof = response.data;
         //        services.getAreaDetailsByZipid($scope.prof.zip_id).then(function(response){
         //                  // console.log(response.data);
         //                  $scope.prof['location'] = response.data;
         //        });
         //        // console.log($scope.prof);
         //    }
	    // });

        services.getProDetails($stateParams.proid).success(
            function (data) {
                if(data) {
                    $scope.prof = data;
                    services.getAreaDetailsByZipid($scope.prof.zip_id).then(function (response) {
                        // console.log(response.data);
                        $scope.prof['location'] = response.data;
                    });
                }
            }).error(
            function (data){
                $state.go('404');
            }
        );

          services.getCompanyServicesArea($stateParams.proid).then(function(response){
                  if(response.data){
                        var areas = response.data.map(function(a) {return a;});
                         // console.log(areas);  
                        angular.forEach(areas, function(area, key) {  

                          services.getAreaDetailsByZipid(area.fk_i_service_area_zip).then(function(response){
                              // console.log(response.data);
                              area['location'] = response.data;
                          });

                        });
                        $scope.areas = areas;
                        // console.log(response.data);
                  }
            });

            services.getCompanyServices($stateParams.proid).then(function(response){
                  $scope.getcompoffer= response.data;
                  // console.log(response.data);

            }); 

          services.getCompanyProject($stateParams.proid).then(function(response){
                if(response.data){
                      var projects = response.data.map(function(a) {return a;});
                      // console.log(projects);  
                      angular.forEach(projects, function(project, key) {  
                          services.getProjectimg(project.pk_i_id).then(function(response){
                              // console.log(response.data);
                              project['images'] = response.data;
                          });
                      });
                      $scope.projects = projects;
                    }                 
            });
          
          services.getCompanyLiecense($stateParams.proid).then(function(response){
                  $scope.proLiecense = response.data;

                  var Liecenses = response.data;//.map(function(a) {return a;});
                  angular.forEach(Liecenses, function(Liecense, key) {  

                    services.getState(Liecense.fk_i_state_id).then(function(response){            
                        Liecense['state'] = response.data;       
                    });
                    $scope.proLiecense = Liecenses;
                  });                   
          });

          services.getReviewsByCompany($stateParams.proid).then(function(response){
                  $scope.reviews= response.data;
                  $scope.rating_count = 0;
                  if(response.data){
                        var reviews = response.data.map(function(a) {return a;});
                        // console.log(projects);  
                        angular.forEach(reviews, function(review, key) {  

                          services.getRatingByReview(review.pk_i_id).then(function(response){
                              // console.log(response.data);
                              review['ratings'] = response.data;
                              $scope.rating_count = $scope.rating_count + response.data.length;
                          });
                        });
                        $scope.reviews = reviews;

                  }
              $scope.avg_rating_count = $scope.rating_count /  $scope.reviews.length;
            });


});
