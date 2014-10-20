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
	


	public function filterReferences($string = '"a":[xxx2],"b":[xxx5],"c":[xxx12]...')
	{
		$results = Strings::matchAll($string, '~"[^"]+":\[xxx([0-9]+)\]~');
		\Tracy\Debugger::FireLog($results);
		return $results;
	}
	
	public function process($string, $references)
	{
		$toProcess = $references . "\r\n\r\n\r\n" . $string;
		$result = $this->texy->process($toProcess);
		return $result;
	}

}