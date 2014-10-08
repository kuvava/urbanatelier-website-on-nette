<?php

namespace App\Presenters;

use Nette,
	App\Model,
	Nette\Application\UI\Form,
	Nette\Utils\Html;


/**
 * Homepage presenter.
 */
class AdminPresenter extends BaseAdminPresenter
{

	public function startup()
	{
		parent::startup();
		if (!$this->user->isInRole('admin')) {
			$this->flashMessage('Pro vstup do požadované části webu se nejprve musíte přihlásit jako uživatel s administrátorskými právy.','flash-red');
				$this->redirect('Uzivatel:prihlas');
		}
	}
	
	public function actionNahled()
	{
		$link = $this->mujPrispevek->sestavLink($this->getParameter('cislo'));
		if ($link) {
			$this->redirect($link['base'], $link['params']);
		} else {
			$this->shootError();
		}
	}
	
	protected function createComponentChooseUrlForEditForm()
	{
		$pole = $this->adminNakladak->dejCiVyrobSeznamUrl($this->adminPrispevek);
		//\Tracy\Debugger::FireLog($pole);
		
		$form = new Nette\Application\UI\Form;
		$form->addSelect('url', 'Článek', $pole)
			->setPrompt('Vyber článek k editaci')
			->setRequired('Musíš si vybrat jeden konkrétní článek z nabídky')
			->setAttribute('class','nahled');
		$form->addButton('preview', 'Náhled vybraného článku')
			->setAttribute('class','nahled');
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
