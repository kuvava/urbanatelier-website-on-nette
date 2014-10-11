<?php

namespace App\Model;

use Nette,
	Nette\Utils\Strings;


/**
 * Komunikace s databází ohledně příspěvku
 */
class AdminPrispevek extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function dodejDatabazi()
	{
		return $this->database;
	}
	/**
	* 
	* nutno doplnit
	* 
	*/
	public function vyrobPoleVsech()
	{
		$pole = NULL;
		$table = $this->database->table('prispevek')->order('presenter_id, url1, url2');
		foreach ($table as $row) {
			$pole[$row->id] = (($row->smazano > 0) ? 'SKRYTO:' : '') . Strings::lower($row->ref('presenter')->jmeno) . '/' . $row->url1 . (($row->url1 === '') ? '' : '/') . $row->url2 . (($row->url2 === '') ? '' : '/');
		}
		//\Tracy\Debugger::FireLog($pole);
		return $pole;
	}
	public function vyrobPolePresenteru()
	{
		$pole = NULL;
		$table = $this->database->table('presenter')->order('jmeno');
		foreach ($table as $row) {
			$pole[$row->id] = Strings::lower($row->jmeno);
		}
		
		return $pole;
	}
	public function ulozNahled($values)
	{
		$this->database->table('nahled')->insert($values);
	}

}