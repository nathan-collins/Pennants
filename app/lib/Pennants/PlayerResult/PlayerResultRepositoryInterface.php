<?php
/**
 * Created by IntelliJ IDEA.
 * User: nathancollins
 * Date: 22/12/13
 * Time: 11:46 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Pennants\Interfaces;


interface PlayerResultRepositoryInterface {
	public function all();
	public function find($id);
}