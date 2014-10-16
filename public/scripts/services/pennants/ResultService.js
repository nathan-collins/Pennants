pennantsApp.service('ResultService', function($http, $cookies) {
  var seasonId = $cookies.pennantsSeason;
  var gradeId = $cookies.pennantsGrade;
  var matchId = Pennants.matchId;
  var opponentId = Pennants.opponentId;
  var clubId = Pennants.clubId;

  return {
    getResults: getResults,
    getOpponentPlayers: getOpponentPlayers,
    getTeamPlayers: getTeamPlayers
  };

  /**
   * Get a list of all the players selected for the match
   * @returns {*}
   */
  function getResults() {
    var request = $http({
      method: "get",
      url: "/api/v1/pennants/result/match/"+seasonId+"/"+gradeId+"/"+matchId
    });

    return( request.then( handleSuccess, handleError) );
  }

  /**
   * List of players in the current team
   * @returns {*}
   */
  function getTeamPlayers() {
    var request = $http({
      method: "get",
      url: '/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+clubId
    });

    return( request.then( handleSuccess, handleError) );
  }

  /**
   * List of players in the opponent team
   * @returns {*}
   */
  function getOpponentPlayers() {
    var request = $http({
      method: "get",
      url: '/api/v1/pennants/player/season/'+seasonId+'/'+gradeId+'/'+opponentId
    });

    return( request.then( handleSuccess, handleError) );
  }

  function handleError( response ) {
    // The API response from the server should be returned in a
    // nomralized format. However, if the request was not handled by the
    // server (or what not handles properly - ex. server error), then we
    // may have to normalize it on our end, as best we can.
    if (
      ! angular.isObject( response.data ) ||
        ! response.data.message
      ) {

      return( $q.reject( "An unknown error occurred." ) );

    }

  }

  function handleSuccess( response ) {
    return( response.data );
  }
});