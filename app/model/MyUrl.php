<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně příspěvku
 */
class MyMenu extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	* 
	* vloží podle příslušné url adresy do MujNaklad->prispevek příslušný řádek z databázové tabulky `prispevek`
	* pokud pro daný MujNaklad->prispevek->smazano je hodnota 0, potom vrací pro celý MujNaklad->prispevek = FALSE, jakoby příslušný databázový řádek neexistoval...
	* 
	*/
	public function getUrlContent($presenterId, $url1, $url2, $presenterName = NULL)
	{
		$url1 = $url1 === NULL ? '' : $url1;
		$url2 = $url2 === NULL ? '' : $url2;
		$presenterId = (($presenterId === NULL) || ((int)$presenterId < 1)) ? $this->database->table('presenter')->where('name = ?', $presenterName)->min('id') : (int)$presenterId;
		return $this->database->table('url')->where('url1 = ?', $url1)->where('url2 = ?', $url2)->where('presenter_id = ?', $presenterId)->fetch();
	}
	
	public function getLink($id)
	{
		if ((int)$id > 0) {
			$row = $this->database->table('url')->get((int)$id);
			if ($row) {
				$link['base'] = $row->ref('presenter')->name . ':zobraz';
				$link['params'] = array('url1' => $row->url1, 'url2' => $row->url2);
			}
		} else {
			$link = NULL;
		}
		return $link;
		
	}

}