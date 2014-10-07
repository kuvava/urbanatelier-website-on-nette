<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class WwwPresenter extends BasePresenter
{

	protected $presenter_id = 1;
	
	public function beforeRender()
	{
		$this->mujPrispevek->nalozPrispevek($this->mujNakladak, $this->presenter_id, $this->getParameter('url1'), $this->getParameter('url2'), $this->name);
		if (!$this->mujNakladak->prispevek) {
				$this->flashMessage('Omlouváme se, ale stránku nelze nalézt.<br>Kontaktujte prosím správce webu: urbanovi&#64;<!-- -->kuvava.cz<br>nebo si vyberte jiný obsah v menu.','flash-red');
				$this->error('Odkazovaný obsah nelze nalézt.');
		}
		parent::beforeRender();
	}

}
