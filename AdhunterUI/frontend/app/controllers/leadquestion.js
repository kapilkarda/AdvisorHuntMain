
adhunterApp.controller('leadquestion',function($scope, $http, $uibModal, $cookieStore,$timeout, services) {
 		
		$scope.indexToShow = 0;	
        	services.getQuestionByCategory(cat_id)
        	.then(function(response) {
	        	if(response.data != 0){
					$scope.questions=JSON.parse(response.data);
					$scope.questions.push( { question_type_id:-11, id:"lead_user_info"} );
					console.log($scope.questions);
					$scope.question_id = $scope.questions[0].id;

					  	services.getOptionsOfQuestion($scope.question_id).then(function(response){
					        // console.log(response.data);
					       if(response.data != 0){
							$scope.answers = JSON.parse(response.data);
								//console.log(JSON.parse(response.data));
							}
							else{
								$scope.answers='';		
							}
					    });									
	        		}
				else{
					$scope.questions='';
				}				
				 
				$scope.lead=[];
				$scope.back = function(){
					$scope.indexToShow = ($scope.indexToShow - 1) % $scope.questions.length;
					$scope.question_id = $scope.questions[$scope.indexToShow].id;
					services.getOptionsOfQuestion($scope.question_id)
			       		.then(function(response) {
							if(response.data != 0){

								$scope.answers = JSON.parse(response.data);
								//console.log(JSON.parse(response.data));
							}
							else{
								$scope.answers='';		
							}
			 		 });
				}
				$scope.last_form = 0;
			
   				$scope.change = function(qid,aid){

   						console.log(qid+" -- "+aid);
   						if (!aid) {
   							$scope.validatetext="Please enter value";
   							return false;
   						};

   						$scope.indexToShow = ($scope.indexToShow + 1) % $scope.questions.length;
 				 	
	 				 	var info = {qid: qid, aid: aid};
						
						// $scope.lead.push(info);
						$scope.lead[qid] = aid;
						//console.log($scope.lead);
						// $cookieStore.put('lead', $scope.lead);

						// console.log($cookieStore.get('lead'));
						console.log($scope.lead);
						// console.log($scope.answers);

						// console.log($cookieStore.get('lead'));

						
						$scope.question_id = $scope.questions[$scope.indexToShow].id;
						
						//console.log(qid);
						//console.log(aid);
						//console.log($scope.selection);
				       		services.getOptionsOfQuestion($scope.question_id)
				       		.then(function(response) {
								if(response.data != 0){

									$scope.answers = JSON.parse(response.data);
									//console.log(JSON.parse(response.data));
								}
								else{
									$scope.answers='';		
								}
				 		 });				 

						//console.log($scope.questions[$scope.indexToShow].id);
						$scope.selection=[];

						$scope.toggleSelection = function toggleSelection(id) {
							var elements = document.querySelectorAll('#multi-ans-select label input:checked');
							var selected = Array.prototype.map.call(elements, function(el, i){
							    return el.value;
							});
							$scope.selection = selected;
							console.log(selected)
						};
	    	};
						
 		});						

	    $scope.close = function () {
			$(".modal,.modal-backdrop").hide();
		}
		
});


