<div class="col-xs-12 col-md-6 col-lg-8 outer content-container">
  <section ng-controller="AddGradeController">
    <form class="form-horizontal" role="form" ng-submit="editGrade()">
        <div class="form-group">
          <label for="year" class="col-sm-2 control-label">Year</label>
          <div class="col-sm-10">
            <input type="year" class="form-control" id="season-input-year" placeholder="Year" ng-model="season.name">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="name" class="form-control" id="season-input-name" placeholder="Name" ng-model="season.year">
          </div>
        </div>
        <div class="form-group">
          <input type="hidden" name="id" value="{{ season.id }}"/>
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>
  </section>
</div>