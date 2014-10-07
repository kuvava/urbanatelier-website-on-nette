<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně položek menu
 */
class AdminMenu extends Nette\Object
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
		$table = $this->database->table('menu')->order('lft');
		foreach ($table as $row) {
			$aN->allMenus[$row->id] = array('hloubka' => $row->hloubka, 'url' => $aN->allUrls[$row->prispevek_id]);
		}
		\Tracy\Debugger::FireLog($aN->allMenus);
	}

}