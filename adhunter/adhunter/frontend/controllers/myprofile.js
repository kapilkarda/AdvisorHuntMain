adhunterApp.controller('myprofile', function($scope, $timeout, $window, $uibModal, $state, $location, $stateParams, services) {
		if(Boolean($window.sessionStorage.access_token) && $window.sessionStorage.role == "Provider" && $window.sessionStorage.proid){
			$scope.edit_fields = {};
			$scope.current_year = new Date().getFullYear();
			$scope.project_image_url = S3uploadsBase+'project_image/thumbs/midsize/'
			$scope.profile_image_url = S3uploadsBase+'profile/thumbs/midsize/'
	      	$scope.banner_image_url = S3uploadsBase+'banner/thumbs/midsize/'

	   		services.getProDetails($window.sessionStorage.proid).then(function(response){
	         	$scope.prof = response.data;
	            // console.log(response.data);
	            if($scope.prof.banner == ''){
	            	$scope.prof.banner = 'no_image.jpg';
	            }
	            if($scope.prof.profile_pic == ''){
	            	$scope.prof.profile_pic = 'no_image.jpg';
	            }
	            // alert($scope.prof.zip_id);
	            services.getAreaDetailsByZipid($scope.prof.zip_id).then(function(response){
	                        // console.log(response.data);
	                $scope.prof['location'] = response.data;
	            });
		    });		    

			services.getCompanyServices($window.sessionStorage.proid).then(function(response){
	                $scope.proServices= response.data;

	        });

	       services.getCompanyServicesArea($window.sessionStorage.proid).then(function(response){

                  //var areas = response.data.map(function(a) {return a;});
			      var areas = response.data;
                   // console.log(areas);  
                  angular.forEach(areas, function(area, key) {  

                    services.getAreaDetailsByZipid(area.fk_i_service_area_zip).then(function(response){
                        // console.log(response.data);
                        area['location'] = response.data;
                    });

                  });
                  $scope.areas = areas;
                  // console.log(response.data);

            });

	        services.getStates().then(function(response){
	                $scope.states= response.data;
	                // console.log($scope.states);
	        });

			$scope.services = [];
	   		services.getSubcategory().then(function(response){

		        $scope.categories = response.data.map(function(a) {return a;});
		        angular.forEach($scope.categories, function(catlist){
		            angular.forEach($scope.proServices, function(service){

		            	if(catlist.id == service.id){
		        				$scope.services.push(catlist);
		        			}	
		        	});
		        });
		    });	

		    

	        services.getCompanyLiecense($window.sessionStorage.proid).then(function(response){
	                $scope.proLiecense = response.data;

	                var Liecenses = response.data;//.map(function(a) {return a;});
	                angular.forEach(Liecenses, function(Liecense, key) {  

                    services.getState(Liecense.fk_i_state_id).then(function(response){            
                        Liecense['state'] = response.data;       
                    });
                    $scope.proLiecense = Liecenses;
                  });	                  
	        });

  			services.getReviewsByCompany($window.sessionStorage.proid).then(function(response){
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
                  $scope.avg_rating_count = $scope.rating_count /  $scope.reviews.length;
                  }
                  
            });
  			services.getCompanyProject($window.sessionStorage.proid).then(function(response){
                if(response.data){
                      var projects = response.data.map(function(a) {return a;});
                       //console.log(projects);  
                      angular.forEach(projects, function(project, key) {  
                          services.getProjectimg(project.pk_i_id).then(function(response){
                              // console.log(response.data);
                              project['images'] = response.data;
                          });
                      });
                      $scope.projects = projects;
                    } console.log($scope.projects); 
            });

	        $scope.showCityState = function(zip) {
		        setTimeout(function() {
		        services.getAreaDetailsByZip(zip).then(function(response){
	                  $scope.getAreaDetails= response.data;
	                  if($scope.getAreaDetails){	   
	                  // console.log($scope.getAreaDetails);
	                  //console.log($scope.prof.city_id);               	 	
	                  		$scope.prof['location'][0].city_name = $scope.getAreaDetails[0].city_name;
	                  		$scope.prof['location'][0].state_name = $scope.getAreaDetails[0].state_name;
	                  		$scope.prof['location'][0].country_name = $scope.getAreaDetails[0].country_name;
	                  		$scope.prof.city_id = $scope.getAreaDetails[0].city_id;
	            			$scope.prof.state_id = $scope.getAreaDetails[0].state_id;   
	                  }
		            });
	        	}, 500);
	      	}

			$scope.editCompanyName = function () {

				$(".modal,.modal-backdrop").hide();
					var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-edit-compname-popup.html',
						windowClass: 'app-proaccountedit-window',						
				});
			}		

			$scope.updateComapnyName = function(name){
				var proobj = {'id':$window.sessionStorage.proid, 'name':name};
				services.updateComapnyName(proobj).then(function(response){            
                    if(response.data == 1){
                    	$scope.close();
						callResult = fakeAjaxCall($scope);

                    	// window.location.reload();
                    }
                });                   
			}

			var fakeAjaxCall = function(scope){
				$timeout(function (item) {
					if (-1 == -1) {  //success
						$scope.prof.name =$scope.prof.name;
					}
				}, 2000);
			};


	        $scope.editServiceOffered = function () {		
					var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-serviceoffered-popup.html',
						windowClass: 'app-proaccountedit-window',	
				});		
			}

			$scope.updateServiceOffered = function () {
				var newServices = {'proid':$window.sessionStorage.proid, 'services':[]};
				angular.forEach($scope.services, function(val){
		            newServices['services'].push(val.id);
		        });
		         // console.log(newServices);
		        services.updateComapnyServices(newServices).then(function(response){            
                    console.log(response.data);
                    if(response.data == 1){
                    	$scope.close();      
                    	window.location.reload(); 
                    }
                });  	       
			}

			$scope.addAboutBusiness = function () {			
					var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-aboutbusiness-popup.html',
						windowClass: 'app-proaccountedit-window',	
				});		
			}

			$scope.updateAboutBusiness = function () {
				var proobj = {'id':$window.sessionStorage.proid, 'about':$scope.prof.about, 'year_founded':$scope.prof.year_founded, 'website':$scope.prof.website};
				services.updateComapnyAbout(proobj).then(function(response){        
                    if(response.data == 1){
                    	$scope.close();      
                    	window.location.reload(); 
                    }
                });
			}

			$scope.editProInfo = function () {		
					var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-infoform-popup.html',
						windowClass: 'app-proaccountedit-window',	
				});		
			}

			$scope.updateProinfo = function () {
				$scope.personalarea;
				services.getAreaDetailsByZip($scope.prof['location'][0].zip).then(function(response){
	                  if(response.data){	                  		
	                  		$scope.personalarea = response.data[0];
	                  		var proobj = {'id':$window.sessionStorage.proid, 'mobile':$scope.prof.mobile, 'phone':$scope.prof.phone, 'email':$scope.prof.email, 'address':$scope.prof.address, 'zip_id':$scope.personalarea['id'], 'city_id':$scope.personalarea.city_id, 'state_id':$scope.personalarea.state_id, 'country_id':$scope.personalarea.country_id};
							services.updatePersonalProfile(proobj).then(function(response){      
							console.log(response.data);
			                    if(response.data == 1){
			                    	$scope.close();      
			                    	window.location.reload(); 
			                    }
			                });
	                  }else{
	                  		alert('invalid zipcode');
	                  }
	             });
			}

			$scope.addLicens = function () {
				$scope.licenseop = "new";		
				$scope.liecenseModel= '';
				var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-licens-popup.html',
						scope: $scope,
						windowClass: 'app-proaccountedit-window',	
				});		
			}
			
			$scope.editLicense = function(id) {
			$scope.licenseop = "update";		
			services.getLicense(id).then(function(response){
	                $scope.liecenseModel= response.data;
	                $scope.liecenseModel.fk_i_company_id = $window.sessionStorage.proid;
	                $scope.liecenseModel.dt_expiration = new Date($scope.liecenseModel.dt_expiration);
	        });
				var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-licens-popup.html',
						scope: $scope,
						windowClass: 'app-proaccountedit-window',	
				});		
			}

			$scope.submitLicense = function (operation) {
				if(operation=="new"){
					$scope.submitted = true;
					$scope.error = {};
					$scope.liecenseModel.fk_i_company_id = $window.sessionStorage.proid;
		            services.addLicense($scope.liecenseModel).success(  
		            function (data) {                                
	                    $scope.close();
	                   	window.location.reload(); 
					          
		            }).error(
		                function (data) {
		                    angular.forEach(data, function (error) {
		                        $scope.error[error.field] = error.message;
		                    });
		                }
		            );
				}
				if(operation=="update"){
					$scope.submitted = true;
					$scope.error = {};
					$scope.liecenseModel.fk_i_company_id = $window.sessionStorage.proid;
		            services.updateLicense($scope.liecenseModel).success(  
		            function (data) { 
		            	if(data == 1){
		            		$scope.close();
	                   		window.location.reload(); 
		            	}                         
		            }).error(
		                function (data) {
		                    angular.forEach(data, function (error) {
		                        $scope.error[error.field] = error.message;
		                    });
		                }
		            );		
				}
			}

			$scope.deleteLicense = function(id) {	
				var r = confirm("Are you sure");
				if (r == true) {
				    services.deleteLicense(id).then(function(response){
			            if(response == 1){
			            	window.location.reload(); 
			            }
		        	});
				} else {
				    txt = "You pressed Cancel!";
				}
					
			}

			$scope.addServiceArea = function(name){
				$(".modal,.modal-backdrop").hide();
					var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-area-popup.html',
						windowClass: 'app-proaccountedit-window',						
				});                  
			}

			$scope.saveServiceArea = function(zipcode){	
				services.getAreaDetailsByZip(zipcode).then(function(response){            
                    if(response.data){
                    	var area = {'proid':$window.sessionStorage.proid, 'zipid':response.data[0]['id']};
                    	services.saveServiceArea(area).then(function(response){            
		                    if(response.data == 1){
		                    	$scope.close();      
		                    	window.location.reload(); 
		                    }
		                    if(response.data == 2){
		                    	alert("You have this serviec area");
		                    }
		                }); 
                    }else{
                    	alert("Invalid Zipcode");
                    	return false;
                    }
                });                
			}
			$scope.deleteArea = function(id) {	
				var area = {'proid':$window.sessionStorage.proid, 'zipid':id};
				var r = confirm("Are you sure");
				if (r == true) {
				    services.deleteServiceArea(area).then(function(response){
			            if(response.data == 1){
			            	window.location.reload(); 
			            }
		        	});
				} else {
				    txt = "You pressed Cancel!";
				}
					
			}
			$scope.addBbbRating = function () {		
				var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-bblrating-popup.html',
						windowClass: 'app-proaccountedit-window',	
				});			
			}

			$scope.addProject = function () {		
				var modalInstance = $uibModal.open({
						templateUrl: 'views/pro-add-project.html',
						windowClass: 'app-proaccountedit-window',	
				});		
			}
			
			$scope.saveUrlRating = function () {
				alert( "Please add BBl Rating Url");
				$state.go("proaccountedit");
			}
			
			$scope.close = function () {
	            $(".modal,.modal-backdrop").hide();
	            
	        }
			$scope.formatPhoneNumber=function (s) {
  				var s2 = (""+s).replace(/\D/g, '');
  				var m = s2.match(/^(\d{3})(\d{3})(\d{4})$/);
 			 	return (!m) ? null : "(" + m[1] + ") " + m[2] + "-" + m[3];
			}

		}else{
  			$state.go('proaccount.add-company');
  		}	

});