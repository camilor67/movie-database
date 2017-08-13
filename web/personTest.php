  <?php include_once 'header.php'; ?>
  <div class="container initiative" ng-app="formApp" ng-controller="formController" ng-init="id='<?php echo $_GET['id']?>'">
    <article class="inner clearfix">
      <form ng-submit="processForm()">
        <input type="hidden" class="form-control" id="id" name="id" ng-model="formData.id" value="<?php echo $_GET['id']?>">
        <!-- <div class="" style="float: left; width: 100%">
          <div class="form-group col-xs-12 col-sm-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Search for person" ng-model="formData.name" required>
          </div>
        </div> -->
        <!-- <p class="m-all"><input type="submit" name="cf-submitted" id="cf-submitted" class="btn btn-warning y-button" value="Search"></p> -->
      </form>
      <!-- SHOW ERROR/SUCCESS MESSAGES --> 
      <!-- <div id="messages" ng-show="message">{{ message }}</div> -->
      <div class="results">
        <div class="item profile list_item" ng-repeat="x in myData">
          <div class="image_content profile">
            <!-- <a id="person_{{ x.id}}" class="result" href="/person?id=10990" title="{{ x.name }}" alt="{{ x.name}}"> -->
            <img class="profile lazyautosizes lazyloaded" data-sizes="auto" src="https://image.tmdb.org/t/p/w90_and_h90_bestv2{{ x.poster_path}}">
            <!-- </a> -->
          </div>

          <div class="content">
            <p class="name">{{ x.title }}</p>
            <p class="sub">
              {{ x.release_date }}
            </p>
            <p class="sub">
              {{ x.overview }}
            </p>
          </div>
        </div>
      </div>
      <pre>
        <!-- {{ formData }} -->
      </pre>
    </article>
  </div>
  <script>
    // define angular module/app
    var formApp = angular.module('formApp', []);

    // create angular controller and pass in $scope and $http
    formApp.controller('formController',  function($scope, $http) {
      // $scope.formData = {};
      $scope.myData = {};
      // console.log($scope.id);
      // $scope.processForm = function() {
        $http({
          method  : 'POST',
          url     : 'searchCredits.php',
          // data    : $.param($scope.formData),  // pass in data as strings
          data    : { id: '<?php echo $_GET['id']?>' },
          headers : { 'Content-Type': 'application/json' }  // set the headers so angular passing info as form data (not request payload)
        })
        .then(function(response) {
          // $scope.result = response
          // console.log(response.data);

          if (response.data.total_results<=0) {
            // if not successful, bind errors to error variables
            // $scope.errorName = data.errors.name;
            // $scope.errorSuperhero = data.errors.superheroAlias;
            $scope.message = response.data.errors;
          } else {
            // if successful, bind success message to message
            $scope.myData = response.data.results;
          }
        },function myError(response) {
          $scope.message = response;
        });
      // };
    });
  </script>
  <?php include_once 'footer.php'; ?>