<!DOCTYPE html>
<html ng-app="spaApp">
    <head>
      <!-- CSS -->
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-theme.min.css" />
    </head>
    <!-- define angular app -->
    
   <body ng-controller="index">
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#/">Single Page Application</a>
          </div>      
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#/"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="#/site/about"><i class="glyphicon glyphicon-tag"></i> About</a></li>
            <li><a href="#/site/contact"><i class="glyphicon glyphicon-envelope"></i> Contact</a></li>
          </ul>
        </div>
      </nav>
      <div id="main" class="container"> 
        <!-- angular templating -->
            <!-- this is where content will be injected -->
        <div ng-view></div>    
      </div>

      <footer class="text-center">
        <p>Yii 2.0.3 + AngularJs 1.3.15</p>
      </footer>

      <!-- JS -->
      <script src="assets/angular/angular.min.js"></script>
      <script src="assets/angular/angular-route.min.js"></script>

    </body>
</html>
  <!-- CSS -->