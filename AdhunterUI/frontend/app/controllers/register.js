

adhunterApp.controller('register', function($scope, $http, $uibModal) {
		$scope.test = 'testlogin';	
		$scope.close = function () {
			console.log('@@@');
 			//$uibModal.close();
			$(".modal,.modal-backdrop").hide();
		}

});
