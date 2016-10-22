adhunterApp.controller('update', function($scope, $window, $state, services) {
  			$scope.page ='teste1111';
 			$scope.example13model ="[]";
			$scope.example13data = [
				    {id: 1, label: "David"},
				    {id: 2, label: "Jhon"},
				    {id: 3, label: "Lisa"},
				    {id: 4, label: "Nicole"},
				    {id: 5, label: "Danny"}];

		$scope.saveCompanyName = function () {
			alert( "Please Save edited Company Name");
			$state.go("proaccountedit");
		}
});