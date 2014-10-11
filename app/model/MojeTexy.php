<?php

namespace App\Model;

use Nette,
	Nette\Utils\Strings;


/**
 * Startuje Texy s mým vlastním nastavením
 */
class MojeTexy extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}
	
	/**
	* 
	* zde se uchovává objekt \Texy jako služba
	* 
	*/
	private $texy;
	
	public function dodejTexy()
	{
		if (isset($this->texy)) {
			return $this->texy;
		} else {
			$this->texy = new \Texy();
			$this->texy = $this->nastaveni($this->texy);
			return $this->texy;
		}
	}
	
	private function nastaveni($texy)
	{

		// můžeme jej nakonfigurovat
		$texy->imageModule->root  = '/images/';
		$texy->headingModule->top = 2;
		// $texy->encoding = 'utf-8';
		
		return $texy;

	}
	
	public function filtrujReference($string, $save = TRUE)
	{
		$results = Strings::matchAll($string, '~"[^"]+":\[xxx([0-9]+)\]~');
		\Tracy\Debugger::FireLog($results);
	}

}