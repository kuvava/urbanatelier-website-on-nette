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
	/** @var Model\MujNakladak @inject */
	public $mujNakladak;

	protected $presenter_id = NULL;
	
	public function beforeRender()
	{
		$this->mujPrispevek->nalozPrispevek($this->mujNakladak, $this->presenter_id, $this->getParameter('url1'), $this->getParameter('url2'), $this->name);
		$this->template->mujNakladak = $this->mujNakladak;
	}
	
	public function renderZobraz()
	{
		
	}

}
