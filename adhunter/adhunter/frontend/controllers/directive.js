adhunterApp.directive('progressbar', [function() {
    return {
        restrict: 'A',
        scope: {
            'progress': '=progressbar'
        },
        controller: function($scope, $element, $attrs) {
            $element.progressbar({
                value: $scope.progress
            })

            $scope.$watch(function() {
                $element.progressbar({value: $scope.progress})
            })
        }
    }
}])


adhunterApp.directive('loading', function () {
      return {
        restrict: 'E',
        replace:true,
        template: '<div class="loading"><img src="http://www.nasa.gov/multimedia/videogallery/ajax-loader.gif" width="20" height="20" />LOADING...</div>',
        link: function (scope, element, attr) {
              scope.$watch('loading', function (val) {
                  if (val)
                      $(element).show();
                  else
                      $(element).hide();
              });
        }
      }
  })