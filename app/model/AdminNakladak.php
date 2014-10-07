<?php

namespace App\Model;

use Nette;


/**
 * Přenos veškerých informací mezi modelem, presenterem a šablonou...
 */
class AdminNakladak extends Nette\Object
{

	/** pole všech id => url - předáno z databáze */
	protected $allUrls = NULL;
	/** pole všech id => array(napis => value, url => value, lft => value, hloubka => value) - z databáze */
	protected $allMenus = NULL;
	/** pole všech id příspěvků, které jsou v databázy označeny: smazano > 0 */
	protected $allHidUrls = NULL;
	
	public function dejCiVyrobSeznamUrl($adminPrispevek)
	{
		if ($this->allUrls !== NULL) {
			return $this->allUrls;
		} else {
			$this->allUrls = $adminPrispevek->vyrobPoleVsech();
			return $this->allUrls;
		}
	}
	public function dejCiVyrobSeznamMenu($adminPrispevek, $adminMenu)
	{
		if ($this->allMenus !== NULL) {
			return $this->allMenus;
		} else {
			$allUrls = $this->dejCiVyrobSeznamUrl($adminPrispevek);
			$this->allMenus = $adminMenu->vyrobPoleVsech($allUrls);
			return $this->allMenus;
		}
	}

}