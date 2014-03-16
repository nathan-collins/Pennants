<div class="col-xs-12 col-md-6 col-lg-8 outer content-container">
  <div class="jumbotron">
    <div season-display></div>
    <div grade-display></div>
  </div>
  <section ng-controller="AddClubController">
    <h1>Create a club</h1>
    <form name="AddClubForm" id="add-club-form" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="name" ng-model="club.name" class="form-control" id="grade-input-name" placeholder="Name">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" required="Name is required" ng-required="true" ng-disabled="AddClubForm.$invalid || isUnchanged(club)" ng-click="addClub(club)">Submit</button>
        </div>
      </div>
    </form>
  </section>
</div>