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

	protected $presenter_id = NULL;
	
	public function beforeRender()
	{
		if ($this->name !== 'Error') {
			
			$this->mujPrispevek->nalozPrispevek($this->mujNakladak, $this->presenter_id, $this->getParameter('url1'), $this->getParameter('url2'), $this->name);
			if (!$this->mujNakladak->prispevek) {
				$this->flashMessage('Omlouváme se, ale stránku nelze nalézt.<br>Kontaktujte prosím správce webu: urbanovi&#64;<!-- -->kuvava.cz<br>nebo si vyberte jiný obsah v menu.','flash-red');
				$this->error('Odkazovaný obsah nelze nalézt.');
			}
			$this->mojeMenu->nalozMenu($this->mujNakladak);
			$this->template->mujNakladak = $this->mujNakladak;
		}
	}
	
	public function renderZobraz()
	{
		
	}

}
