<html>

   <head>
      <title>Angular JS Services</title>
      <script src = "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   </head>
   
   <body>
      <h2>AngularJS Sample Application</h2>
      
      <div ng-app = "mainApp">
      
       <div ng-view></div>
         <script type = "text/ng-template" id = "addStudent.htm">
            <h2> Add Student </h2>
            <div ng-controller = "CalcController">
            <p>Enter a number: <input type = "number" ng-model = "number" /></p>
            <button ng-click = "square()">X<sup>2</sup></button>
            <p>Result: {{result}}</p>
            </div>
         </script>
         
         <script type = "text/ng-template" id = "viewStudents.htm">
            <h2> View Students </h2>
            {{message}}
         </script>
         
         
      
      
      <div ng-controller = "CalcController1">
         <p>Enter a number: <input type = "number" ng-model = "number" /></p>
         <button ng-click = "add()">X<sup>2</sup></button>
         <p>Result: {{result1}}</p>
      </div>
      
      <script>
         var mainApp = angular.module("mainApp", ['ngRoute']);
         
         mainApp.config(['$routeProvider', function($routeProvider) {
            $routeProvider.
            
            when('/addStudent', {
               templateUrl: 'addStudent.htm',
               controller: 'AddStudentController'
            }).
            
            when('/viewStudents', {
               templateUrl: 'viewStudents.htm',
               controller: 'ViewStudentsController'
            }).
            
            otherwise({
               redirectTo: '/addStudent'
            });
         }]);
         
         mainApp.factory('MathService', function() {
            var factory = {};
            
            factory.multiply = function(a, b) {
               return a * b
            }
            return factory;
         });
         
         mainApp.service('CalcService', function(MathService){
            this.square = function(a) {
               return MathService.multiply(a,a);
            }
         });
         
         mainApp.controller('CalcController', function($scope, CalcService) {
            $scope.square = function() {
               $scope.result = CalcService.square($scope.number);
            }
         });
         
         
         mainApp.factory('MathAdd', function() {
            var factory = {};
            factory.add = function(a, b) {
               return a + b
            }
            return factory;
         });
         
         mainApp.service('CalcAdd', function(MathAdd){
            this.add = function(a) {
               return MathAdd.add(a,a);
            }
         });
         
         mainApp.controller('CalcController1', function($scope, CalcAdd) {
            $scope.add = function() {
               $scope.result1 = CalcAdd.add($scope.number);
            }
         });
         
         
      </script>
      
   </body>
</html>