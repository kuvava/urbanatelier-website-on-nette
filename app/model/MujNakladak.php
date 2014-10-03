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

}