app.controller('homeCtrl', function ($scope,$location,$timeout) {

    function init(){
      alertClassSuccess= "alert alert-success";
      alertClassError= "alert alert-danger";
      alertClassWarning = "alert alert-warning";
      erro="error";
      sucesso="success";
      atencao="warning";
      $scope.msgDefault= "";
      $scope.alertClass= "";
    };

    $scope.login = function (){
       message("Sucesso! Logado.",sucesso);
       $location.path('/home');
    };

    $scope.msgTest = function (){
       message("Sucesso! Logado.",sucesso);
    };

    function message(msg, status){
      $scope.msgDefault = msg;
        if(status=='error')
           $scope.alertClass = alertClassError;
        else if(status=='success')
            $scope.alertClass = alertClassSuccess;
         else if(status=='warning'){
            $scope.alertClass = alertClassWarning;
         }
      $timeout(function(){
        $scope.alertClass = null,
        $scope.msgDefault = null
      }, 6000);
      return false;
    }

    init();
});
