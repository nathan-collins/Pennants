<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <section ng-controller="ClubController">
    <a class="btn btn-default"  ng-href="/pennants/club/add" role="button">Add Club</a>
    <h1>Select a club</h1>
    <div class="list-group">
      <a ng-href="dashboard/pennants/club/<% club.id %>" class="list-group-item" ng-repeat="club in clubs">
        <h4><% club.name %></h4>
      </a>
    </div>
  </section>
</div>