<?php

namespace App\Model;

use Nette;


/**
 * Přenos veškerých informací mezi modelem, presenterem a šablonou...
 */
class MyLorry extends Nette\Object
{

	/** @var MyUrl */
	private $myUrl;
	public function injectMyUrl(MyUrl $myUrl)
	{
		$this->myUrl = $myUrl;
	}
	/** @var MyMenu */
	private $myMenu;
	public function injectMyMenu(MyMenu $myMenu)
	{
		$this->myMenu = $myMenu;
	}
	/** @var MyUser */
	private $myUser;
	public function injectMyUser(MyUser $myUser)
	{
		$this->myUser = $myUser;
	}
	
	/** uchovává veškeré náležitosti příslušné stránky předané z databáze */
	private $urlContent = NULL;
	/** uchovává všechny příslušné položky menu předané z databáze */
	private $menu = NULL;
	/** pole ideček drobečkové navigace */
	private $menuAct = NULL;
	/** pole zveřejnitelných údajů o přihlášeném uživateli */
	private $user = NULL;
	private $presentersList = NULL;
	private $urlsList = NULL;

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
	public function setNullUrlContent()
	{
		$this->urlContent = NULL;
	}
	public function setMenu($urlId = NULL)
	{
		if ($this->menu === NULL) {
			$this->resetMenu($urlId);
		}
		return $this;
	}
	public function resetMenu($urlId = NULL)
	{
		if (($urlId === NULL) && ($this->urlContent !== NULL)) {
			$urlId = $this->urlContent->id;
		}
		$result = $this->myMenu->getMenu($urlId);
		$this->menu = $result['menu'];
		$this->menuAct = $result['menuAct'];
		return $this;
	}
	public function getMenu()
	{
		return $this->menu;
	}
	public function getMenuAct()
	{
		return $this->menuAct;
	}
	
	public function setUser($userId)
	{
		if ($this->user === NULL) {
			$this->resetUser($userId);
		}
		return $this;
	}
	public function resetUser($userId)
	{
		$this->user = $this->myUser->getAllowedInfo($userId);
		return $this;
	}
	public function getUser()
	{
		return $this->user;
	}



	public function getPresentersList()
	{
		if ($this->presentersList === NULL) {
			$this->resetPresentersList();
		}
		return $this->presentersList;
	}
	public function setPresentersList()
	{
		if ($this->presentersList === NULL) {
			$this->resetPresentersList();
		}
		return $this;
	}
	public function resetPresentersList()
	{
		$this->presentersList = $this->myUrl->getPresentersList();
		return $this;
	}
	public function getUrlsList()
	{
		if ($this->urlsList === NULL) {
			$this->resetUrlsList();
		}
		return $this->urlsList;
	}
	public function setUrlsList()
	{
		if ($this->urlsList === NULL) {
			$this->resetUrlsList();
		}
		return $this;
	}
	public function resetPresentersList()
	{
		$this->urlsList = $this->myUrl->getUrlsList();
		return $this;
	}



}