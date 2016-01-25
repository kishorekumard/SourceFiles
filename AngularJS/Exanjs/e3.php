<html>
   
   <head>
      <title>Angular JS Controller</title>
      <script src = "angular.min.js"></script>
   </head>
   
   <body>
      <h2>AngularJS Sample Application</h2>
      
      <div ng-app = "mainApp">
      
      <div ng-controller = "studentController">
         Enter first name: <input type = "text" ng-model = "student.firstName"><br><br>
         Enter last name: <input type = "text" ng-model = "student.lastName"><br>
         <br>
         You are entering: {{student.fullName()}}
         <br>
         You are entering: {{student.fullNamesmall()}}
         <br>
         You are entering: {{student.fullNameupper()}}

      
      
      <div ng-init = "countries = [{locale:'en-US',name:'United States'}, {locale:'en-GB',name:'United Kingdom'}, {locale:'en-FR',name:'France'}]">
           <p>{{countries[1].name +" -- "+countries[1].locale}}</p>
           <p>{{student.countries[0].name}}</p>
           
      </div>


      <ul>
          <li ng-repeat = "countries in student.countries">{{countries.name}}</li>
      </ul>
         
      <table>
          <tr>
              <th>Name</th>.
              <th>Marks</th>
          </tr>

          <tr ng-repeat = "subject in student.subjects">
              <td>{{ subject.name }}</td>
              <td>{{ subject.marks }}</td>
          </tr>

      </table>
      
             </div>  
         
       <div ng-controller = "studentController1">
         Enter first name: <input type = "text" ng-model = "student1.firstName"><br><br>
         Enter last name: <input type = "text" ng-model = "student1.lastName"><br>
      </div>

         
      </div>
      
      <script>
         var mainApp = angular.module("mainApp", []);
         
         mainApp.controller('studentController', function($scope) {
            $scope.student = {
               firstName: "Mahesh",
               lastName: "Parashar",
               countries :[
                   {locale:'en-IN',name:'India'},
                   {locale:'en-US',name:'United States'}, 
                   {locale:'en-GB',name:'United Kingdom'}, 
                   {locale:'en-FR',name:'France'}
               ],
               subjects:[
                  {name:'Physics',marks:70},
                  {name:'Chemistry',marks:80},
                  {name:'Math',marks:65},
                  {name:'English',marks:75},
                  {name:'Hindi',marks:67}
               ],
               fullName: function() {
                  var studentObject;
                  studentObject = $scope.student;
                  return studentObject.firstName + " " + studentObject.lastName;
               },
                 fullNamesmall: function() {
                  var studentObject;
                  studentObject = $scope.student;
                  return studentObject.firstName.toLowerCase() + " " + studentObject.lastName.toLowerCase();
               },
               fullNameupper: function() {
                  var studentObject;
                  studentObject = $scope.student;
                  return studentObject.firstName.toUpperCase() + " " + studentObject.lastName.toUpperCase();
               }
            };
         });
         
         
         mainApp.controller('studentController1', function($scope) {
            $scope.student1 = {
               firstName: "Mahesh12312",
               lastName: "Parashar12213",
            };
         });
      </script>
      
   </body>
</html>