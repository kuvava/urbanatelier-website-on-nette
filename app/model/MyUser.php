<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně zveřejnitelných údajů o přihlášeném uživateli
 */
class MujUzivatel extends Nette\Object
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
	public function nalozUzivatele($mN, $userID)
	{
		$mN->uzivatel['username'] = $this->database->table('uzivatel')->get($userID)->username;
	}

}