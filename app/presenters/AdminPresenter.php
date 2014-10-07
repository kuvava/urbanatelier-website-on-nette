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
		parent::beforeRender();
	}	
	
	
	protected function createComponentChooseUrlForEditForm()
	{
		$pole = $this->adminNakladak->dejCiVyrobSeznamUrl($this->adminPrispevek);
		//\Tracy\Debugger::FireLog($pole);
		
		$form = new Nette\Application\UI\Form;
		$form->addSelect('url', 'Článek', $pole)
			->setPrompt('Vyber článek k editaci')
			->setRequired('Musíš si vybrat jeden konkrétní článek z nabídky');
		$form->addSubmit('choose', 'Přejít k editaci');
		$form->onSuccess[] = array($this, 'chooseUrlForEditFormSubmitted');
		return $form;
	}
	
	public function chooseUrlForEditFormSubmitted(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}

}
