pennantsApp.service('CookieService', function($cookie) {
  return {
    setCookies: setCookies
  }

  function setCookies(response) {
    var seasonId  = response.seasonId;
    var gradeId   = response.gradeId;
    var clubId    = response.clubId;
    var matchId   = response.matchId;
    var playerId  = response.playerId;
    var resultId  = response.resultId;

    seasonCookie(seasonId);
    gradeCookie(gradeId);
    clubCookie(clubId);
    matchCookie(matchId);
    playerCookie(playerId);
    resultCookie(resultId);
  }

  function seasonCookie(seasonId) {
    $cookie.put('pennantsSeason', seasonId);
  }

  function gradeCookie(gradeId) {
    $cookie.put('pennantsGrade', gradeId);
  }

  function clubCookie(clubId) {
    $cookie.put('pennantsClub', clubId);
  }

  function matchCookie(matchId) {
    $cookie.put('pennantsMatch', matchId);
  }

  function playerCookie(playerId) {
    $cookie.put('pennantsPlayer', playerId);
  }

  function resultCookie(resultId) {
    $cookie.put('pennantsResult', resultId);
  }
});