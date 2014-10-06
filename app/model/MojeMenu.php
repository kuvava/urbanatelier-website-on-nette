<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně položek menu
 */
class MojeMenu extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	* 
	* nutno doplnit
	* 
	*/
	public function nalozMenu($mN)
	{
		if ($mN->prispevek) {
			$navig = $mN->prispevek->related('menu')->order('hlavni DESC')->limit(1)->fetch();
			if ($navig) {
				$relevantId = array();
				foreach ($this->database->table('menu')->where('lft <= ?',$navig->lft)->where('rgt >= ?', $navig->rgt) as $radek){
					$mN->menuAktivni[] = $radek->id;
					foreach ($this->database->table('menu')->where('lft > ?', $radek->lft)->where('rgt < ?', $radek->rgt)->where('hloubka = ?', ($radek->hloubka +1)) as $podradek){
						$relevantId[] = $podradek->id;
					}
				}
				$relevantId = array_filter($relevantId);
				if (!empty($relevantId)){
					$mN->menu = $this->database->table('menu')->where('hloubka = ? OR id ?', 0, $relevantId)->order('lft');
				}
			}
		}
		if (!$mN->menu) {
			$mN->menu = $this->database->table('menu')->where('hloubka = ?', 0)->order('lft');
		}
	}

}