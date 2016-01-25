<html>
   
   <head>
      <title>AngularJS First Application</title>
   </head>
   
   <body>
      <h1>Sample Application</h1>
      
      <div ng-app = "">
         <p>Enter your Name: <input type = "text" ng-model = "name"></p>
         <p>Hello <span ng-bind = "name"></span>!</p>
<!--      </div>
      
      <div ng-app = ""> -->
         <p>Enter your Name: <input type = "text" ng-model = "name1"></p>
         <p>Hello <span ng-bind = "name1"></span>!</p>
      </div>
      <script src = "angular.min.js"></script>
      
   </body>
</html>