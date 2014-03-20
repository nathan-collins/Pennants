<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <section ng-controller="MatchController">
    <a class="btn btn-default pull-right"  ng-href="/dashboard/pennants/match/add" role="button">Add A Match</a>
    <h1>Select a match</h1>
    <div class="list-group">
      <a ng-href="/dashboard/pennants/match/<% match.id %>" class="list-group-item" ng-repeat="match in matches">
        <h4><% match.name %></h4>
      </a>
      <p ng-show="!matches.length">No matches for this club</p>
    </div>
  </section>
</div>