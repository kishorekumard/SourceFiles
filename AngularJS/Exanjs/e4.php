<html>
   <head>
      <title>Angular JS Filters</title>
      <script src = "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   </head>
   <body>
      <h2>AngularJS Sample Application</h2>
      <div ng-app = "mainApp" ng-controller = "studentController">
         <table border = "0">
            <tr>
               <td>Enter first name:</td>
               <td><input type = "text" ng-model = "student.firstName"></td>
            </tr>
            
            <tr>
               <td>Enter last name: </td>
               <td><input type = "text" ng-model = "student.lastName"></td>
            </tr>
            
            <tr>
               <td>Enter fees: </td>
               <td><input type = "text" ng-model = "student.fees"></td>
            </tr>
            
            <tr>
               <td>Enter subject: </td>
               <td><input type = "text" ng-model = "subjectName"></td>
            </tr>
         </table>
         <br/>
         
         <table border = "0">
            <tr>
               <td>Name in Upper Case: </td><td>{{student.fullName() | uppercase}}</td>
            </tr>
         
            <tr>
               <td>Name in Lower Case: </td><td>{{student.fullName() | lowercase}}</td>
            </tr>
         
            <tr>
               <td>fees: </td><td>{{student.fees | currency}}
               </td>
            </tr>
                
            <tr>
               <td>Subject:</td>

               <td>
                  <ul>
                     <li ng-repeat = "subject in student.subjects | filter: subjectName |orderBy:'marks'|lowercase">
                        {{ subject.name + ', marks:' + subject.marks }}
                     </li>
                  </ul>
               </td>
            </tr>
                              
                     <tr ng-repeat = "subject in student.subjects | filter: subjectName |orderBy:'marks'|lowercase">
                       <td> {{ subject.name + ', marks:' + subject.marks }}</td>
                     </tr>
                  
         </table>
         
         <table border = "0">
            <tr>
               <td><input type = "checkbox" ng-model = "enableDisableButton">Disable Button</td>
               <td><button ng-disabled = "enableDisableButton">Click Me!</button></td>
            </tr>
            
            <tr>
               <td><input type = "checkbox" ng-model = "showHide1">Show Button</td>
               <td><button ng-show = "showHide1">Click Me!</button></td>
            </tr>
            
            <tr>
               <td><input type = "checkbox" ng-model = "showHide2">Hide Button</td>
               <td><button ng-hide = "showHide2">Click Me!</button></td>
            </tr>
            
            <tr>
               <td><p>Total click: {{ clickCounter }}</p></td>
               <td><button ng-click = "clickCounter = clickCounter + 1">Click Me!</button></td>
            </tr>
         </table>
         
      </div>
      
      <script>
         var mainApp = angular.module("mainApp", []);
         
         mainApp.controller('studentController', function($scope) {
            $scope.student = {
               firstName: "Mahesh",
               lastName: "Parashar",
               fees:500,
               
               subjects:[
                  {name:'Physics',marks:70},
                  {name:'Chemistry',marks:80},
                  {name:'Math',marks:65}
               ],
               
               fullName: function() {
                  var studentObject;
                  studentObject = $scope.student;
                  return studentObject.firstName + " " + studentObject.lastName;
               }
            };
         });
      </script>
      
   </body>
</html>