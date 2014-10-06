<?php

namespace App\Model;

use Nette;


/**
 * Přenos veškerých informací mezi modelem, presenterem a šablonou...
 */
class MujNakladak extends Nette\Object
{

	/** uchovává veškeré náležitosti příspěvku předané z databáze */
	public $prispevek = NULL;
	/** uchovává všechny příslušné položky menu předané z databáze */
	public $menu = NULL;
	/** ukazuje v databázové tabulce `menu` na konkrétní řádek týkající se aktivního příspěvku */
	public $menuAktivni = NULL;

}