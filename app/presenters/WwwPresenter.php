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
		if ((!$this->mujNakladak->prispevek) || (($this->mujNakladak->prispevek->smazano > 0) && !$this->user->isInRole('admin'))) {
				$this->shootError();
		}
		if ($this->user->isInRole('admin') && ($this->mujNakladak->prispevek->smazano > 0)) {
			$force = $this->getParameter('force');
			if ($force !== 'ano') {
				$this->flashMessage('Tento příspěvek je pro běžné uživatele skrytý (smazaný). Nyní je zobrazen pouze v důsledku Vašich administrátorských práv...', 'flash-red');
				$parametry = $this->getParameters();
				$parametry['force'] = 'ano';
				$this->redirect('this', $parametry);
			}
		}
		parent::beforeRender();
	}

}
