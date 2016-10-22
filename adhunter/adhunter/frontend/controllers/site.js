'use strict';
spaApp_site.config(['$routeProvider', function($routeProvider) {
  $routeProvider
  .when('http://sachin/Advisorhunter/adhunter/adhunter/frontend/#/', {
		templateUrl: 'views/site/index.html',
	})
	.when('/site/index', {
		templateUrl: 'views/site/login.html',
		controller: 'index'
	})
	.when('#/site/about', {
		templateUrl: 'views/site/about.html',
		controller: 'about'
	})
	.when('/site/contact', {
		templateUrl: 'views/site/contact.html',
		controller: 'contact'
	})
	.when('/site/contact', {
		templateUrl: 'views/site/contact.html',
		controller: 'contact'
	})
	.otherwise({
		redirectTo: ''
	});
}])
.controller('index', ['$scope', '$http', function($scope,$http) {
	// create a message to display in our view
}])
.controller('about', ['$scope', '$http', function($scope,$http) {
	// create a message to display in our view
	$scope.message = 'Look! I am an about page.';
}])



