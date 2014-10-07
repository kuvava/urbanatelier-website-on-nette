<?php

namespace App\Model;

use Nette;


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
	public function nalozPoleVsech($aN)
	{
		$table = $this->database->table('prispevek')->order('presenter_id, url1, url2');
		foreach ($table as $row) {
			$aN->allUrls[$row->id] = 'http://' . $row->ref('presenter')->jmeno . '.atelierurban.cz/' . $row->url1 . (($row->url1 === '') ? '' : '/') . $row->url2 . (($row->url2 === '') ? '' : '/');
		}
	}

}