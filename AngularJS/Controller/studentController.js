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