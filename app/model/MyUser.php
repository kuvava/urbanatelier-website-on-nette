<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně zveřejnitelných údajů o přihlášeném uživateli
 */
class MyUser extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	* 
	* nutno doplnit
	* 
	*/
	public function getAllowedInfo($userID)
	{
		$allowed['username'] = $this->database->table('user')->get($userID)->username;
		return $allowed;
	}

}