<section ng-controller="AddSeasonController">
	<form class="form-horizontal" role="form" ng-submit="editSeason()">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="name" class="form-control" id="grade-input-name" placeholder="Name" ng-model="grade.name">
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