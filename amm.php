<!DOCTYPE html>
<html>
<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>  
<body>

<h2>Validation Example</h2>

<form ng-app="myApp" ng-controller="validateCtrl" 
name="myForm" novalidate>

<p>Username:<br>
<input type="text" name="user" ng-model="user" required>
<span style="color:red" ng-show="myForm.user.$dirty && myForm.user.$invalid">
<span ng-show="myForm.user.$error.required">Username is required.</span>
</span>
</p>

<p>Email:<br>
<input type="email" name="email" ng-model="email" user-domain-email="{ email: user.email }" ng-pattern="/^(?=[A-Z0-9][A-Z0-9._%+-]{5,253}+$)[A-Z0-9._%+-]{1,64}+@(?:(?=[A-Z0-9-]{1,63}+\.)A-Z0-9]++(?:-[A-Z0-9]++)*+\.){1,8}+[A-Z]{2,63}+$/" onclick="javascript:email();" onblur="javascript:email();" onchange="javascript:email();" required>
<span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
<span ng-show="myForm.email.$error.required">Email is required.</span>
<span ng-show="myForm.email.$error.email">Invalid email address.</span>
</span>
</p>

<p>
<input type="submit" ng-disabled="myForm.user.$dirty && myForm.user.$invalid ||  myForm.email.$dirty && myForm.email.$invalid">
</p>

</form>

<script>
var app = angular.module('myApp', []);
app.controller('validateCtrl', function($scope) {
    $scope.user = 'John Doe';
    $scope.email = 'john.doe@gmail.com';
});

function email()
{
alert("email");
}
</script>

</body>
</html>
