<?php

namespace App\Model;

use Nette;


/**
 * Komunikace s databází ohledně položek menu
 */
class MyMenu extends Nette\Object
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
	public function getMenu($urlId = NULL)
	{
		$result = array();
		$result['menu'] = NULL;
		$result['menuAct'] = array();
		if ($urlId !== NULL && (int)$urlId > 0) {
			$navig = $this->database->table('menu')->where('url_id = ?', (int)$urlId)->order('priority DESC, id ASC')->limit(1)->fetch();
			if ($navig) {
				$relevantId = array();
				foreach ($this->database->table('menu')->where('lft <= ?',$navig->lft)->where('rgt >= ?', $navig->rgt) as $radek){
					$result['menuAct'][] = $radek->id;
					foreach ($this->database->table('menu')->where('lft > ?', $radek->lft)->where('rgt < ?', $radek->rgt)->where('level = ?', ($radek->level +1)) as $podradek){
						$relevantId[] = $podradek->id;
					}
				}
				if (!empty($relevantId)){
					$result['menu'] = $this->database->table('menu')->where('level = ? OR id ?', 0, $relevantId)->order('lft');
				}
			}
		}
		if (!$result['menu']) {
			$result['menu'] = $this->database->table('menu')->where('level = ?', 0)->order('lft');
			$result['menuAct'] = array();
		}
		return $result;
	}

}