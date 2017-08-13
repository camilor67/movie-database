  <?php include_once 'header.php'; ?>
  <div class="container initiative" ng-app="formApp" ng-controller="formController">
    <article class="inner clearfix">
      <form class= "clearfix" ng-submit="processForm()">
        <div class="" style="float: left; width: 100%">
          <div class="form-group col-xs-12 col-sm-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Search for person" ng-model="formData.name" required>
          </div>
        </div>
        <!-- <p class="m-all"><input type="submit" name="cf-submitted" id="cf-submitted" class="btn btn-warning y-button" value="Search"></p> -->
      </form>
      <!-- SHOW ERROR/SUCCESS MESSAGES --> 
      <div id="messages" ng-show="message">{{ message }}</div>
      <div class="results" ng-hide="myVar">
        <div class="item profile list_item" ng-repeat="x in myData">
          <div class="image_content profile">
            <a id="person_{{ x.id}}" class="result" href="/person.php?id={{ x.id }}" title="{{ x.name }}" alt="{{ x.name}}">
              <img class="profile lazyautosizes lazyloaded" data-sizes="auto" src="https://image.tmdb.org/t/p/w90_and_h90_bestv2{{ x.profile_path}}">
            </a>
          </div>

          <div class="content">
            <p class="name"><a id="person_{{ x.id }}" class="result" href="/person.php?id={{ x.id }}" title="{{ x.name }}" alt="{{ x.name}}">{{ x.name }}</a></p>
            <p class="sub">
              <span ng-repeat="know in x.known_for">{{ know.original_title + ', ' }}</span>
            </p>
          </div>
        </div>
      </div>
    </article>
  </div>
  <script>
    // define angular module/app
    var formApp = angular.module('formApp', []);

    // create angular controller and pass in $scope and $http
    formApp.controller('formController',  function($scope, $http) {
      $scope.formData = {};
      $scope.myData = {};
      $scope.myVar = false;
      $scope.processForm = function() {
        $http({
          method  : 'POST',
          url     : 'search.php',
          data    : $.param($scope.formData),  // pass in data as strings
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
          })
        .then(function(response) {
          $scope.result = response
          console.log(response.data);

          if (response.data.total_results<=0) {
            // if not successful, bind errors to error variables
            // $scope.errorName = data.errors.name;
            // $scope.errorSuperhero = data.errors.superheroAlias;
            $scope.message = 'No found data';
            $scope.myVar = true;
          } else {
            // if successful, bind success message to message
            $scope.message = '';
            $scope.myData = response.data.results;
            $scope.myVar = false;
          }
        },function myError(response) {
          $scope.message = response;
        });
      };
    });
  </script>
  <?php include_once 'footer.php'; ?>