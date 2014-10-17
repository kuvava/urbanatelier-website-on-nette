<?php

namespace App\Model;

use Nette,
	Nette\Utils\Strings;


/**
 * Texy s mým vlastním nastavením jako služba
 */
class MyTexy extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;
	/** @var \Texy */
	private $texy;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
		$this->texy = new \Texy();

		/* základní nastavení objektu $this->texy */
		$this->texy->imageModule->root  = '/images/';
		$this->texy->headingModule->top = 2;
		// $texy->encoding = 'utf-8';
	}
	


	private function filterReferences($string, $saveInternalLinks = TRUE)
	{
		$results = Strings::matchAll($string, '~"[^"]+":\[xxx([0-9]+)\]~');
		\Tracy\Debugger::FireLog($results);
	}
	
	public function process($string, $saveInternalLinks = TRUE)
	{
		$links = Strings::matchAll($string, '~"[^"]+":\[xxx([0-9]+)\]~');
		\Tracy\Debugger::FireLog($results);
	}

}