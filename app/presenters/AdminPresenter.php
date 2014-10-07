<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class AdminPresenter extends BasePresenter
{

	/** @var Model\AdminNakladak @inject */
	public $adminNakladak;
	/** @var Model\AdminPrispevek @inject */
	public $adminPrispevek;
	/** @var Model\AdminMenu @inject */
	public $adminMenu;
	
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
		$this->adminPrispevek->nalozPoleVsech($this->adminNakladak);
		$this->adminMenu->nalozPoleVsech($this->adminNakladak);
		parent::beforeRender();
	}

}
