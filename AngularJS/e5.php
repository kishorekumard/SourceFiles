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
      <script src = "Application/mainApp.js"></script>
      <script src = "Controller/studentController.js"></script>
      <script src = "Controller/studentController1.js"></script>
   </body>
</html>