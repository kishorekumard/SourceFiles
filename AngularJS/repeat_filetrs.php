<html>
   
   <head>
      <title>AngularJS Directives</title>
   </head>
   
   <body>
      <h1>Sample Application</h1>
      
      <div ng-app = "" ng-init = "countries = [{locale:'en-US',name:'United States'}, {locale:'en-GB',name:'United Kingdom'}, {locale:'en-FR',name:'France'}]"> 
         <p>Enter your Name: <input type = "text" ng-model = "name"></p>
         <p>Enter your country: <input type = "text" ng-model = "contyr">Filter country</p>
         <p>Hello <span ng-bind = "name"></span>!</p>
         <p>List of Countries with locale:</p>
      
         <ol>
            <li ng-repeat = "country in countries | filter:contyr">
               {{ 'Country: ' + country.name + ', Locale: ' + country.locale }}
            </li>
         </ol>
         <p>{{countries[1].name +" -- "+countries[1].locale}}</p>
      </div>
      
      <script src = "angular.min.js"></script>
      
   </body>
</html>