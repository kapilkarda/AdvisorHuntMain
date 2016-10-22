adhunterApp.controller('myprofile', function($scope, $window, $uibModal, $state, $location, $stateParams, services, $timeout, $rootScope) {
		if(Boolean($window.sessionStorage.access_token) && $window.sessionStorage.role == "Provider" && $window.sessionStorage.proid){
			$scope.edit_fields = {};
			$scope.current_year = new Date().getFullYear();
			$scope.project_image_url = S3uploadsBase+'project_image/thumbs/midsize/'
			$scope.profile_image_url = S3uploadsBase+'profile/thumbs/midsize/'
	      	$scope.banner_image_url = S3uploadsBase+'banner/thumbs/midsize/'

	      	$rootScope.prof = {};

	      	$scope.onLoad = function(){
	      		$scope.loadProDetails();
	      		$scope.loadComapnyServices();
	      		$scope.loadComapnyServicesArea();
	      		$scope.loadStates();
	      		$scope.loadSubCategory();
	      		$scope.loadCompanyLiecense();
	      		$scope.loadReviewsByCompany();
	      		$scope.loadCompanyProject();
	      	}

	      	$scope.loadProDetails = function(){
	      		services.getProDetails($window.sessionStorage.proid).then(function(response){
		        	$rootScope.prof = response.data;
		            if($rootScope.prof.banner == ''){
		            	$rootScope.prof.banner = 'no_image.jpg';
		            }
		            if($rootScope.prof.profile_pic == ''){
		            	$rootScope.prof.profile_pic = 'no_image.jpg';
		            }
		            services.getAreaDetailsByZipid($rootScope.prof.zip_id).then(function(response){
		                $rootScope.prof['location'] = response.data;
		            });
		        });	
			}	    

			$scope.loadComapnyServices = function(){
				services.getCompanyServices($window.sessionStorage.proid).then(function(response){
					$rootScope.proServices= response.data;
		        });
		    }

			$scope.loadComapnyServicesArea = function(){
		       services.getCompanyServicesArea($window.sessionStorage.proid).then(function(response){
				    var areas = response.data;
	                angular.forEach(areas, function(area, key) {  
	                    services.getAreaDetailsByZipid(area.fk_i_service_area_zip).then(function(response){
	                        area['location'] = response.data;
	                    });
	                });
	                $rootScope.areas = areas;
	            });
		    }

		    $scope.loadStates = function(){		    
		        services.getStates().then(function(response){
		            $scope.states= response.data;
		        });
		    }

		    $scope.loadSubCategory = function(){		    
		    	$scope.services = [];
		   		services.getSubcategory().then(function(response){
			        $scope.categories = response.data.map(function(a) {return a;});
			        angular.forEach($scope.categories, function(catlist){
			            angular.forEach($rootScope.proServices, function(service){
			            	if(catlist.id == service.id){
		        				$scope.services.push(catlist);
		        			}
			        	});
			        });
			        console.log($scope.services);
			    });	
		   	}
			    
		   	$scope.loadCompanyLiecense = function(){
		        services.getCompanyLiecense($window.sessionStorage.proid).then(function(response){
		                $rootScope.proLiecense = response.data;
		                var Liecenses = response.data;//.map(function(a) {return a;});
		                angular.forEach(Liecenses, function(Liecense, key) {  
	                    services.getState(Liecense.fk_i_state_id).then(function(response){
	                        Liecense['state'] = response.data;       
	                    });
	                    $rootScope.proLiecense = Liecenses;
	                  });	                  
		        });
		    }
			
			$scope.loadReviewsByCompany = function(){
		    	services.getReviewsByCompany($window.sessionStorage.proid).then(function(response){
	                $scope.reviews= response.data;
	                $scope.rating_count = 0;
	                if(response.data){
	                  	var reviews = response.data.map(function(a) {return a;});
	                  	angular.forEach(reviews, function(review, key) {  
		                    services.getRatingByReview(review.pk_i_id).then(function(response){
		                        review['ratings'] = response.data;
		                        $scope.rating_count = $scope.rating_count + response.data.length;
		                    });
	                  	});
	                  	$scope.reviews = reviews;
	                  	$scope.avg_rating_count = $scope.rating_count /  $scope.reviews.length;
	                }
	            });
	        }

	  		$scope.loadCompanyProject = function(){
		    	services.getCompanyProject($window.sessionStorage.proid).then(function(response){
	                if(response.data){
	                    var projects = response.data.map(function(a) {return a;});
	                    angular.forEach(projects, function(project, key) {  
	                        services.getProjectimg(project.pk_i_id).then(function(response){
	                             project['images'] = response.data;
	                        });
	                    });
	                    $scope.projects = projects;
	                }
	            });
	        }

	        $scope.showCityState = function(zip) {
		        setTimeout(function() {
			        services.getAreaDetailsByZip(zip).then(function(response){
	                  	$scope.getAreaDetails= response.data;
	                  	if($scope.getAreaDetails){	   
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
					templateUrl: 'app/views/pro_myprofile/pro-edit-compname-popup.html',
					windowClass: 'app-proaccountedit-window'				
				});
			}		

			$scope.updateComapnyName = function(name){
				var proobj = {'id':$window.sessionStorage.proid, 'name':name};
				services.updateComapnyName(proobj).then(function(response){            
                    if(response.data == 1){
                    	$scope.close();
						$scope.$apply();
                    }
                });                   
			}

	        $scope.editServiceOffered = function () {	
	        	$rootScope.categories_root = $scope.categories;
	        	var modalInstance = $uibModal.open({
					templateUrl: 'app/views/pro_myprofile/pro-add-serviceoffered-popup.html',
					windowClass: 'app-proaccountedit-window',	
				});
			}

			$scope.updateServiceOffered = function () {
				var newServices = {'proid':$window.sessionStorage.proid, 'services':[]};
				angular.forEach($scope.services, function(val){
		            newServices['services'].push(val.id);
		        });
		        console.log(newServices);
		        services.updateComapnyServices(newServices).then(function(response){            
                    if(response.data == 1){
                    	$scope.close();   
                    	$scope.loadComapnyServices(); 
                    }
                });  	       
			}

			$scope.addAboutBusiness = function () {			
				var modalInstance = $uibModal.open({
					templateUrl: 'app/views/pro_myprofile/pro-add-aboutbusiness-popup.html',
					windowClass: 'app-proaccountedit-window',
				});		
			}

			$scope.updateAboutBusiness = function(form){
				//if(form.validate()) {
					var proobj = {'id':$window.sessionStorage.proid, 'about':$scope.prof.about, 'year_founded':$scope.prof.year_founded, 'website':$scope.prof.website};
					services.updateComapnyAbout(proobj).then(function(response){        
	                    if(response.data == 1){
	                    	$scope.close(); 
	                    	$scope.loadProDetails();
	                    	//window.location.reload(); 
	                    }
	                });
	            // /}
			}

			$scope.editProInfo = function () {		
				var modalInstance = $uibModal.open({
					templateUrl: 'app/views/pro_myprofile/pro-add-infoform-popup.html',
					windowClass: 'app-proaccountedit-window',	
				});		
			}

			$scope.updateProinfo = function () {
				$rootScope.personalarea;
				services.getAreaDetailsByZip($rootScope.prof['location'][0].zip).then(function(response){
	                  if(response.data){	                  		
	                  		$rootScope.personalarea = response.data[0];
	                  		var proobj = {'id':$window.sessionStorage.proid, 'mobile':$rootScope.prof.mobile, 'phone':$rootScope.prof.phone, 'email':$rootScope.prof.email, 'address':$rootScope.prof.address, 'zip_id':$rootScope.personalarea['id'], 'city_id':$rootScope.personalarea.city_id, 'state_id':$rootScope.personalarea.state_id, 'country_id':$rootScope.personalarea.country_id};
							services.updatePersonalProfile(proobj).then(function(response){      
							    if(response.data == 1){
			                    	$scope.close();  
			                    	$scope.loadProDetails();    
			                    	//window.location.reload(); 
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
					templateUrl: 'app/views/pro_myprofile/pro-add-licens-popup.html',
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
					templateUrl: 'app/views/pro_myprofile/pro-add-licens-popup.html',
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
	                   	$scope.loadCompanyLiecense();
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
	                   		$scope.loadCompanyLiecense();
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
			            if(response.data == 1){
			            	$scope.loadCompanyLiecense();
			            }
		        	});
				} else {
				    txt = "You pressed Cancel!";
				}
					
			}

			$scope.addServiceArea = function(name){
				$(".modal,.modal-backdrop").hide();
				var modalInstance = $uibModal.open({
					templateUrl: 'app/views/pro_myprofile/pro-add-area-popup.html',
					windowClass: 'app-proaccountedit-window',						
				});                  
			}

			$scope.saveServiceArea = function(zipcode){	
				services.getAreaDetailsByZip(zipcode).then(function(response){            
                    if(response.data){
                    	var area = {'proid':$window.sessionStorage.proid, 'zipid':response.data[0]['id']};
                    	services.saveServiceArea(area).then(function(response){   
                    		console.log(response);         
		                    if(response.data == 1){
		                    	$scope.close();      
		                    	$scope.loadComapnyServicesArea(); 
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
			            	$scope.loadComapnyServicesArea(); 
			            }
		        	});
				} else {
				    txt = "You pressed Cancel!";
				}
					
			}
			$scope.addBbbRating = function () {		
				var modalInstance = $uibModal.open({
					templateUrl: 'app/views/pro_myprofile/pro-add-bblrating-popup.html',
					windowClass: 'app-proaccountedit-window',	
				});			
			}

			$scope.addProject = function () {		
				var modalInstance = $uibModal.open({
					templateUrl: 'app/views/pro_myprofile/pro-add-project.html',
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

			$scope.onLoad();
			
			$(document).ready(function(){
				$('#propic').unbind('change').bind("change", function(){
					$('#uploadpicform').submit();  
					$('#editpropic').removeClass('fa fa-pencil');
					$('#editpropic').addClass('fa fa-spinner');
				});

				var uploadData = "";

				$('#banner').unbind('change').bind("change", function(){
					$('#editbanner').removeClass('fa fa-pencil');
					$('#editbanner').addClass('fa fa-spinner');
					$('#uploadbanner').submit();
				});


				$("#uploadbanner").unbind('submit').bind('submit',(function(e) {
					e.preventDefault();
					$('#proidforbanner').val(sessionStorage.getItem('proid'));
					$.ajax({
						url: serviceBase + 'companies/update-company-banner',
						type: "POST",
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						success: function(data){
							if(data == 1){
								alert("Banner image updated");
								$('#editbanner').removeClass('fa fa-spinner');
								$('#editbanner').addClass('fa fa-pencil');
								$scope.loadProDetails();
							}
							else{
								alert(data);
								$('#editbanner').removeClass('fa fa-spinner');
								$('#editbanner').addClass('fa fa-pencil');
							}
						}
					});
				}));

				$("#uploadpicform").unbind('submit').bind('submit',(function(e) {
					e.preventDefault();
					$('#proidforpic').val(sessionStorage.getItem('proid'));
					$.ajax({
						url: serviceBase + 'companies/update-company-pic', // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							if(data == 1){
								console.log(data);
								alert("Profile image updated");
								var scope = angular.element($('[ng-controller=myprofile]')).scope();
								scope.profile_image = data;
								$('#editpropic').removeClass('fa fa-spinner');
								$('#editpropic').addClass('fa fa-pencil');
								$scope.loadProDetails();
							}
							else{
								alert(data);
								$('#editpropic').removeClass('fa fa-spinner');
								$('#editpropic').addClass('fa fa-pencil');
							}
						}
					});
				}));
			});


			$rootScope.validationOptions = {
		        rules: {
		            first_name: {
		                required: true
		            },
		            last_name: {
		                required: true
		            },
		            email: {
		                required: true,
		                email:true
		            },
		            password: {
		                required: true
		            },
		            repeat_password: {
		                required: true
		            }
		        },
		        messages: {
		            first_name: {
		                required: "First Name should not be blank"
		            },
		            last_name: {
		                required: "Last Name should not be blank"
		            },
		            email: {
		                required: "Email should not be blank",
		                email: "Email is not valid"
		            },
		            password: {
		                required: "Password should not be blank"
		            },
		            repeat_password: {
		                required: "Repeat Password should not be blank"
		            }
		        }
		    }

		}else{
  			$state.go('proaccount.add-company');
  		}	

});	
