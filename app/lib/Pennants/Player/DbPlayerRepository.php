<?php namespace Pennants\Player;

use Pennants\PlayerSeason\PlayerSeasonRepositoryInterface;
use Player;
use PlayerSeason;

class DbPlayerRepository implements PlayerRepositoryInterface
{

	public function __construct(PlayerSeasonRepositoryInterface $playerSeason)
	{
		$this->playerSeason = $playerSeason;
	}

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Player::leftJoin( 'player_seasons', 'players.id', '=', 'player_seasons.player_id' )->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find( $id )
	{
		return Player::find( $id );
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update( $id )
	{
		$player = $this->get( $id );

		$player->save( \Input::all() );

		return $player;
	}

	/**
	 * @param $id
	 * @return bool
	 */

	public function delete( $id )
	{
		$player = $this->get( $id );

		if ( !$player ) {
			return false;
		}

		return $player->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Players
	 */

	public function create( $data )
	{
		if ( !isset( $data[ 'playerId' ] ) ) {
			$player_data = array( 'name' => $data[ 'name' ], );

			unset( $data[ 'name' ] );

			$player = new Player( $player_data );
			$player->settings = json_encode( array() );

			$player->save( $player->toArray() );
		} else {
			$player = new Player();
			$player->id = $data[ 'playerId' ];
		}

		$player_season_data = $this->playerSeasonData( $player, $data );

		$player_season = new PlayerSeason( (array)$player_season_data );
		$player_season->save( $player_season->toArray() );

		return $player;
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function searchPlayerByName( $name )
	{
		return Player::join( 'player_seasons', function ( $join ) use ( $name ) {
			$join->on( 'players.id', '=', 'player_seasons.player_id' )->where( 'players.name', 'LIKE', '%' . $name . '%' );
		} );
	}

	/**
	 * @param $player
	 * @param $data
	 * @return \stdClass
	 */
	private function playerSeasonData( $player, $data )
	{
		$playerSeasonData = new \stdClass();
		$playerSeasonData->player_id 				= $player->id;
		$playerSeasonData->season_id 				= $data[ 'season_id' ];
		$playerSeasonData->club_id 					= $data[ 'club_id' ];
		$playerSeasonData->grade_id 				= $data[ 'grade_id' ];
		$playerSeasonData->golf_link_number = isset( $data[ 'golf_link_number' ] ) ? $data[ 'golf_link_number' ] : '';
		$playerSeasonData->handicap 				= $data[ 'handicap' ];

		return $playerSeasonData;
	}

	/**
	 * @param $playerId
	 * @return mixed
	 */
	public function getPlayerById( $playerId )
	{
		return PlayerSeason::where( 'player_id', $playerId );
	}

	/**
	 * @param $playerId
	 */
	public function getPlayerHandicap( $player_id ) {
		$handicap = $this->playerSeason->getPlayerHandicap($player_id);
		return $handicap;
	}
}