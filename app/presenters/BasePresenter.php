<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/** @var Model\MujPrispevek @inject */
	public $mujPrispevek;
	/** @var Model\MojeMenu @inject */
	public $mojeMenu;
	/** @var Model\MujNakladak @inject */
	public $mujNakladak;
	/** @var Model\MujUzivatel @inject */
	public $mujUzivatel;

	protected $presenter_id = NULL;
	
	public function beforeRender()
	{
		$this->mojeMenu->nalozMenu($this->mujNakladak);
		$this->template->mujNakladak = $this->mujNakladak;
		$user = $this->getUser();
		if ($user->isLoggedIn()) {
			$this->mujUzivatel->nalozUzivatele($this->mujNakladak, $user->id);
		}
	}
	
	public function renderZobraz()
	{
		
	}
	
	protected function shootError($message = 'Omlouváme se, ale stránku nelze nalézt.<br>Kontaktujte prosím správce webu: urbanovi&#64;<!-- -->kuvava.cz<br>nebo si vyberte jiný obsah v menu.', $class = 'flash-red')
	{
		$this->flashMessage($message,$class);
		$this->error('Odkazovaný obsah nelze nalézt.');
	}

}
