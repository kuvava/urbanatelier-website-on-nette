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
			$pole[$row->id] = 'http://' . $row->ref('presenter')->jmeno . '.atelierurban.cz/' . $row->url1 . (($row->url1 === '') ? '' : '/') . $row->url2 . (($row->url2 === '') ? '' : '/') . (($row->smazano > 0) ? ' (SMAZÁNO)' : '');
		}
		//\Tracy\Debugger::FireLog($pole);
		return $pole;
	}
	public function vyrobPolePresenteru()
	{
		$pole = NULL;
		$table = $this->database->table('presenter')->order('jmeno');
		foreach ($table as $row) {
			$pole[$row->id] = $row->jmeno;
		}
		
		return $pole;
	}

}