<?php

namespace App\Model;

use Nette;


/**
 * Přenos veškerých informací mezi modelem, presenterem a šablonou...
 */
class MyLorry extends Nette\Object
{

	/** @var Model\MyUrl */
	private $myUrl;
	public function injectMyUrl(Model\MyUrl $myUrl)
	{
		$this->myUrl = $myUrl;
	}
	/** @var Model\MyMenu */
	private $myMenu;
	public function injectMyMenu(Model\MyUrl $myMenu)
	{
		$this->myMenu = $myMenu;
	}
	
	/** uchovává veškeré náležitosti příslušné stránky předané z databáze */
	private $urlContent = NULL;
	/** uchovává všechny příslušné položky menu předané z databáze */
	private $menu = NULL;
	/** pole ideček drobečkové navigace */
	private $menuAktivni = NULL;
	/** pole zveřejnitelných údajů o přihlášeném uživateli */
	private $uzivatel = NULL;

	public function setUrlContent($presenterId, $url1, $url2, $presenterName = NULL)
	{
		if ($this->urlContent === NULL) {
			$this->resetUrlContent($presenterId, $url1, $url2, $presenterName);
		}
		return $this;
	}
	public function resetUrlContent($presenterId, $url1, $url2, $presenterName = NULL)
	{
		$this->urlContent = $this->myUrl->getUrlContent($presenterId, $url1, $url2, $presenterName);
		return $this;
	}
	public function getUrlContent()
	{
		return $this->urlContent;
	}
	public function setMenu($urlId = NULL)
	{
		if ($this->menu === NULL) {
			$this->resetMenu($urlId)
		}
		return $this;
	}
	public function resetMenu($urlId = NULL)
	{
		if (($urlId === NULL) && ($this->urlContent !== NULL)) {
			$urlId = $this->urlContent->id;
		}
		$result = $this->myMenu->getMenu($urlId);
		$this->menu = $this->myMenu->getMenu($urlId);
		return $this;
	}
	public function getMenu()
	{
		return $this->menu;
	}



}