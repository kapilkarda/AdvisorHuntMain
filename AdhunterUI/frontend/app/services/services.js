'use strict';
adhunterApp.factory("services", function($http,$location,$state) {
    var obj = {};
    
    obj.getMainCategoryList = function(){
        return $http.get(serviceBase + 'categories');
    }

    obj.getSubcategoryByCategory = function(categoryID){
        return $http.get(serviceBase + 'categories/get-subcategory-by-category/'+ categoryID);
    }

    obj.getSubcategory = function(){
        return $http.get(serviceBase + 'subcategories');
    }	

    obj.getSubcategoryListHomePage = function(subcat){
        return $http.get(serviceBase + 'subcategories/home-list?q='+ subcat);
    }   

    obj.getProDetails = function(companyID){
        return $http.get(serviceBase + 'companies/'+ companyID);
    }

    obj.getCompanyServices = function(companyID){
        return $http.get(serviceBase + 'companies/services-by-company/'+ companyID);
    }

    obj.getCompanyLiecense = function(companyID){
        return $http.get(serviceBase + 'companies/liecense-by-company/'+ companyID);
    }

    obj.getState = function(stateID){
        return $http.get(serviceBase + 'states/'+ stateID);
    }

    obj.getCompanyServicesArea = function(companyID){
        return $http.get(serviceBase + 'companies/service-area-by-company/'+ companyID);
    }

    obj.getCompanyProject = function(companyID){
        return $http.get(serviceBase + 'companies/project-by-company/'+ companyID);
    }

    obj.getProjectimg = function(projectID){
        return $http.get(serviceBase + 'companies/images-by-project/'+ projectID);
    }

    obj.getReviewsByCompany = function(companyID){
        return $http.get(serviceBase + 'companies/company-reviews-by-company/'+ companyID);
    }

    obj.getRatingByReview = function(reviewID){
        return $http.get(serviceBase + 'companies/ratings-by-review/'+ reviewID);
    }
    //Comapny Search Page
    obj.getProListByZip = function(zipcode){
        return $http.get(serviceBase + 'apis/pro-by-zip/'+ zipcode);
    }

    obj.getOptionsOfQuestion = function(questionID){
        return $http.get(serviceBase + 'subcategories/options-by-question/'+ questionID);
    }

    obj.getQuestionByCategory = function(categoryID){
        return $http.get(serviceBase + 'subcategories/questions-by-category/'+ categoryID);
    }

    obj.getAreaDetailsByZipid = function(zipID){
        return $http.get(serviceBase + 'zipcodes/location-by-zipid/'+ zipID);
    }
	
    obj.getAreaDetailsByZip= function(zip){
        return $http.get(serviceBase + 'zipcodes/location-by-zipcode/'+ zip);
    }
    //Normal user Login
    obj.login = function(loginDetails){ 
        return $http.post(serviceBase + 'apis/login', loginDetails);
    }
    //Normal user Signup
    obj.signup = function(userDetails){ 
        return $http.post(serviceBase + 'apis/signup', userDetails);
    }
    //pro sign up step 1
    obj.prosignup = function(prouserModel){ 
        return $http.post(serviceBase + 'apis/pro-signup', prouserModel);
    }
    //pro sign up step 2
    obj.addNewComapny = function(companyModel){ 
        return $http.post(serviceBase + 'companies', companyModel);
    }

    obj.getStates = function(newServices){
        return $http.get(serviceBase + 'states');
    }
    //Edit Pro profile
    obj.updateComapnyName = function(proobj){
        return $http.post(serviceBase + 'companies/update-company-name', proobj);
    }

    obj.updateComapnyAbout = function(proobj){
        return $http.post(serviceBase + 'companies/update-company-about', proobj);
    }

    obj.updatePersonalProfile = function(proobj){
        return $http.post(serviceBase + 'companies/update-company-personalinfo', proobj);
    }

    obj.updateComapnyServices = function(newServices){
        return $http.post(serviceBase + 'companies/update-company-services', newServices);
    }

    obj.addLicense = function(liecenseModel){
        return $http.post(serviceBase + 'companylicenses', liecenseModel);
    }

    obj.updateLicense = function(liecenseModel){ 
        return $http.post(serviceBase + 'companies/update-company-license', liecenseModel);
    }

    obj.getLicense = function(liecenseID){
        return $http.get(serviceBase + 'companylicenses/'+liecenseID);
    }

    obj.deleteLicense = function(liecenseID){
        return $http.delete(serviceBase + 'companylicenses/'+liecenseID);
    }

    obj.saveServiceArea = function(prozipID){
        return $http.post(serviceBase + 'companies/save-service-area', prozipID);
    }

    obj.deleteServiceArea = function(prozipID){
        return $http.post(serviceBase + 'companies/delete-service-area', prozipID);
    }

    obj.addReview = function(reviewModel){console.log('dddddd');console.log(sessionStorage);
        return $http.post(serviceBase + 'apis/add-review', reviewModel);
    }

    return obj;   
});

adhunterApp.factory('authInterceptor', function ($q, $window, $location) {
    return {
        request: function (config) {
            if ($window.sessionStorage.access_token) {
                //HttpBearerAuth
                config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
            }else{
                config.headers.Authorization = 'Bearer 0BZcnr1Ym2rpi5P94gPYYlzyxV4mVLJc';
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                alert('Unauthorized! - You are requesting with an invalid credential');
                $location.path('/').replace();
            }
            return $q.reject(rejection);
        }
    };
});
