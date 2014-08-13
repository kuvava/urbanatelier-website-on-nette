<?php

namespace App\Model;

use Nette;


/**
 * Startuje Texy s mým vlastním nastavením
 */
class MojeTexy extends Nette\Object
{

	/**
	* 
	* zde se uchovává objekt \Texy jako služba
	* 
	*/
	private static $texy;
	
	public static function dodejTexy()
	{
		if (isset(self::$texy)) {
			return self::$texy;
		} else {
			self::$texy = new \Texy();
			self::$texy = self::nastaveni(self::$texy);
			return self::$texy;
		}
	}
	
	private static function nastaveni($texy)
	{

		// můžeme jej nakonfigurovat
		$texy->imageModule->root  = '/images/';
		// $texy->headingModule->top = 2;
		// $texy->encoding = 'utf-8';
		
		return $texy;

	}

}