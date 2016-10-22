adhunterApp.controller('proaccount', function($scope, $http, $window, $state, $location, services) {
    $scope.page = 'Step 1 of 2';

    $scope.prouserModel = {};

    $scope.prosignup = function (form) {
        if(form.validate()) {
            $scope.submitted = true;
            $scope.error = {};

            if($scope.prouserModel.first_name==undefined || $scope.prouserModel.first_name=="undefined"){
                $scope.error["first_name"] = "First name should not be blank";
                return false;
            }
            if($scope.prouserModel.last_name==undefined || $scope.prouserModel.last_name=="undefined"){
                $scope.error["last_name"] = "Last name should not be blank";
                return false;
            }
            if($scope.prouserModel.email==""){
                $scope.error["email"] = "Email should not be blank";
                return false;
            }
            if($scope.prouserModel.email==undefined || $scope.prouserModel.email=="undefined"){
                $scope.error["email"] = "Email is invalid";
                return false;
            }
            if($scope.prouserModel.mobile==undefined || $scope.prouserModel.mobile=="undefined"){
                $scope.error["mobile"] = "Mobile Number should not be blank";
                return false;
            }
            if($scope.prouserModel.mobile.length!=10){
                $scope.error["mobile"] = "Mobile Number should not be more than or less that 10 character";
                return false;
            }
            if($scope.prouserModel.password==undefined || $scope.prouserModel.password=="undefined"){
                $scope.error["password"] = "Password should not be blank";
                return false;
            }
            if($scope.prouserModel.repeat_password==undefined || $scope.prouserModel.repeat_password=="undefined"){
                $scope.error["repeat_password"] = "Repeat password should not be blank";
                return false;
            }
            if($scope.prouserModel.password!=$scope.prouserModel.repeat_password){
                $scope.error["repeat_password"] = "Password and Repeat Password should be same";
                return false;
            }
            if($scope.prouserModel.terms==undefined || $scope.prouserModel.terms=="undefined"){
                $scope.error["terms"] = "Please accept terms.";
                return false;
            }

            services.prosignup($scope.prouserModel).success(
                function (data) {console.log(data);
                    if(data.status == 1){
                        localStorage.setItem('phone', $scope.prouserModel.mobile);
                        localStorage.setItem('email', $scope.prouserModel.email);
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
        }
    };

    $scope.validationOptions = {
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
});

adhunterApp.controller('pro-add-company', function($scope, $window, $state, services) {
    if(Boolean($window.sessionStorage.access_token) && $window.sessionStorage.role == "Provider"){
        $scope.page ='Step 2 of 2';
        $scope.companyModel = {};
        $scope.getSubcategory = []

        $scope.loadSubCategory = function(){
            services.getSubcategory().then(function(response){
                $scope.getSubcategory= response.data;
            });
        };

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

        $scope.addNewCompany = function (form) {
            if(form.validate()) {
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
        }

        $scope.copyPersonalContact = function(){
            if($scope.companyModel.same){
                $scope.companyModel.phone = localStorage.getItem('phone');
                $scope.companyModel.email = localStorage.getItem('email');
            }else{
                $scope.companyModel.phone = "";
                $scope.companyModel.email = "";
            }
        }

    }else{
        $state.go('home');
    }


    $scope.validationOptions = {
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
});