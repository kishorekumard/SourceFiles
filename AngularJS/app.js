var validationApp = angular.module('validationApp', []);

// create angular controller
validationApp.controller('mainController', function($scope) {

  // function to submit the form after all validation has occurred            
  $scope.submitForm = function(isValid) {
    // check to make sure the form is completely valid
    if (isValid) {
     var ContactEmail =$scope.user.email;
     var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i; 
     if (!ck_email.test(ContactEmail))
     {
      //  $scope.disableTagButton = {'visibility': 'visible'};
      $scope.modelName=true;
        return false;
     }else{
         alert("ok");
      $scope.modelName=false;
       // $scope.disableTagButton = {'visibility': 'hidden'};
     }
    }

  };

});