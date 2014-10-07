<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class AdminPresenter extends BasePresenter
{

	protected $user = NULL;
	
	public function startup()
	{
		parent::startup();
		$this->user = $this->getUser();
		if (!$this->user->isInRole('admin')) {
			$this->flashMessage('Pro vstup do požadované části webu se nejprve musíte přihlásit jako uživatel s administrátorskými právy.','flash-red');
				$this->redirect('Uzivatel:prihlas');
		}
	}
	
	public function beforeRender()
	{
		
		parent::beforeRender();
	}

}
