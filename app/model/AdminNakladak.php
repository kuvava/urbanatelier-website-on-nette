<?php

namespace App\Model;

use Nette;


/**
 * Přenos veškerých informací mezi modelem, presenterem a šablonou...
 */
class AdminNakladak extends Nette\Object
{

	/** pole všech id => url - předáno z databáze */
	public $allUrls = array();
	/** pole všech id => array(napis => value, url => value, lft => value, hloubka => value) - z databáze */
	public $allMenus = array();
	/** pole všech id příspěvků, které jsou v databázy označeny: smazano > 0 */
	public $allHidUrls = array();

}