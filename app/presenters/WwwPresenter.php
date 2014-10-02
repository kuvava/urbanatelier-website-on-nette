<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class WwwPresenter extends BasePresenter
{

	public function renderZobraz()
	{
		$this->template->anyVariable = 'any value';
	}

}
