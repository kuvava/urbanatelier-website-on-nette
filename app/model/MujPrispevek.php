<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně příspěvku
 */
class MujPrispevek extends Nette\Object
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
	public function nalozPrispevek($mujNakladak, $presenterId, $url1, $url2, $presenterName = NULL)
	{
		$url1 = $url1 === NULL ? '' : $url1;
		$url2 = $url2 === NULL ? '' : $url2;
		$presenterId = (($presenterId === NULL) || ((int)$presenterId < 1)) ? $this->database->table('presenter')->where('jmeno = ?', $presenterName)->min('id') : (int)$presenterId;
		$mujNakladak->prispevek = $this->database->table('prispevek')->where('url1 = ?', $url1)->where('url2 = ?', $url2)->where('presenter_id = ?', $presenterId)->fetch();
	}
	
	public function sestavLink($id)
	{
		if ((int)$id > 0) {
			$row = $this->database->table('prispevek')->get((int)$id);
			if ($row) {
				$link['base'] = $row->ref('presenter')->jmeno . ':zobraz';
				$link['params'] = array('url1' => $row->url1, 'url2' => $row->url2);
			}
		} else {
			$link = FALSE;
		}
		return $link;
		
	}

}