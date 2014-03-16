<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <section ng-controller="PlayerController">
    <a class="btn btn-default"  ng-href="/pennants/player/add/<% player.club_id %>" role="button">Add Player</a>
    <h1>Select a player</h1>
    <div class="list-group">
      <a ng-href="/pennants/player/<% player.id %>" class="list-group-item" ng-repeat="player in players">
        <h4><% player.name %></h4>
      </a>
      <p ng-show="!players.length">No players for this club</p>
    </div>
  </section>
</div>