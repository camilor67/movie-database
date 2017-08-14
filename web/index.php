  <?php include_once 'header.php'; ?>
  <div class="container initiative" ng-app="formApp" ng-controller="formController">
    <article class="inner clearfix">
      <form class= "clearfix" ng-submit="processForm()">
        <div class="form-group col-xs-12 search-div">
          <span class="oi oi-magnifying-glass"></span>
          <!-- <span class="oi oi-arrow-circle-bottom" ng-hide="loading"></span> -->
          <i class="fa fa-circle-o-notch fa-spin" ng-hide="loading"></i>
          <input type="text" class="form-control" id="name" name="name" placeholder="Search for person" ng-model="formData.name" required>
        </div>
      </form>
      <div id="messages" ng-show="message">{{ message }}</div>
      <div class="results" ng-hide="myVar">
        <div class="item profile list_item" ng-repeat="x in myData">
          <div class="image_content profile">
            <a id="person_{{ x.id}}" class="result" href="/person.php?id={{ x.id }}" title="{{ x.name }}" alt="{{ x.name}}">
              <img class="profile lazyautosizes lazyloaded" data-sizes="auto" src="{{ x.profile_path}}" alt="{{ x.name}}">
            </a>
          </div>

          <div class="content">
            <p class="name"><a id="person_{{ x.id }}" class="result" href="/person.php?id={{ x.id }}" title="{{ x.name }}" alt="{{ x.name}}">{{ x.name }}</a></p>
            <p class="sub">
              <span>{{ x.known_for }}</span>
            </p>
          </div>
        </div>
      </div>
    </article>
  </div>
  <script>
    var formApp = angular.module('formApp', []);

    formApp.controller('formController',  function($scope, $http) {
      $scope.formData = {};
      $scope.myData = {};
      $scope.myVar = false;
      $scope.loading = true;
      $scope.processForm = function() {
        $scope.loading = false;
        $http({
          method  : 'POST',
          url     : 'search.php',
          data    : $.param($scope.formData),
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        })
        .then(function(response) {
          $scope.result = response

          if (response.data.length <= 0) {
            $scope.message = 'No found data';
            $scope.myVar = true;
          } else {
            $scope.message = '';
            $scope.myData = response.data;
            $scope.myVar = false;
          }
          $scope.loading = true;
        },function myError(response) {
          $scope.message = response;
          $scope.loading = true;
        });
      };
    });
  </script>
  <?php include_once 'footer.php'; ?>