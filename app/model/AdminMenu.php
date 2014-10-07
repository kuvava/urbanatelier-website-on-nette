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
	public function vyrobPoleVsech($allUrls)
	{
		$pole = NULL;
		$table = $this->database->table('menu')->order('lft');
		foreach ($table as $row) {
			$pole[$row->id] = array('hloubka' => $row->hloubka, 'url' => $allUrls[$row->prispevek_id], 'urlId' => $row->prispevek_id, 'napis' => ($row->special_napis === '' ? $row->ref('prispevek')->napis_menu : $row->special_napis));
		}
		//\Tracy\Debugger::FireLog($pole);
		return $pole;
		
	}

}