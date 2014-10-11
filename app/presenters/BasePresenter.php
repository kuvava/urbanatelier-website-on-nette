<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/** @var Model\MyUrl */
	protected $myUrl;
	public function injectMyUrl(Model\MyUrl $myUrl)
	{
		$this->myUrl = $myUrl;
	}
	/** @var Model\MyMenu */
	protected $myMenu;
	public function injectMyMenu(Model\MyMenu $myMenu)
	{
		$this->myMenu = $myMenu;
	}
	/** @var Model\MyLorry */
	protected $myLorry;
	public function injectMyLorry(Model\MyLorry $myLorry)
	{
		$this->myLorry = $myLorry;
	}
	/** @var Model\MyUser */
	protected $myUser;
	public function injectMyUser(Model\MyUser $myUser)
	{
		$this->myUser = $myUser;
	}

	protected $presenter_id = NULL;
	
	public function beforeRender()
	{
		$this->myLorry->setMenu();
		$this->template->myLorry = $this->myLorry;
		if ($this->user->isLoggedIn()) {
			$this->myLorry->setUser($user->id);
		}
	}
	
	public function renderZobraz()
	{
		
	}
	
	protected function shootError($message = 'Omlouváme se, ale stránku nelze nalézt.<br>Kontaktujte prosím správce webu: urbanovi&#64;<!-- -->kuvava.cz<br>nebo si vyberte jiný obsah v menu.', $class = 'flash-red', $errorText = 'Odkazovaný obsah nelze nalézt.')
	{
		$this->flashMessage($message,$class);
		$this->error($errorText);
	}
	
	protected function setCustomFormRendering(Nette\Application\UI\Form $form)
	{
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = 'dl';
		$renderer->wrappers['pair']['container'] = 'div';
		$renderer->wrappers['label']['container'] = 'dt';
		$renderer->wrappers['control']['container'] = 'dd';
	}

}
