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
		$this->mustBeAdmin('Pro vstup do požadované části webu se nejprve musíte přihlásit jako uživatel s administrátorskými právy.');
	}
	
	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->httpRequest = $this->context->getService('httpRequest');
	}
	
	public function actionNahled()
	{
		$link = $this->myUrl->getLink($this->getParameter('number'));
		if ($link) {
			$this->redirect($link['base'], $link['params']);
		} else {
			$this->shootError();
		}
	}
	
	public function renderZaloha()
	{
		$number = $this->getParameter('number');
		$this->myLorry->resetUrlContentFromCopies($number);
		if (!$this->myLorry->urlContent) {
			$this->shootError();
		}
	}
	
	protected function createComponentChooseUrlForEditForm()
	{
		$pole = $this->myLorry->getUrlsList();
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
		$this->setCustomFormRendering($form);
		return $form;
	}
	
	public function chooseUrlForEditFormSubmitted(Nette\Application\UI\Form $form)
	{
		$this->mustBeAdmin();
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}
	
	protected function createComponentChooseCopyUrlForEditForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('number', 'Kolikátou zálohu od nejnovějších si přeješ editovat:')
			->setType('number')
			->setDefaultValue(1)
			->setRequired('Musíš zadat číslo.')
			->setAttribute('class','zaloha');
		$form->addButton('preview', 'Náhled vybraného archivního článku')
			->setAttribute('class','zaloha');
		$form->addSubmit('choose', 'Přejít k editaci');
		$form->onSuccess[] = array($this, 'chooseCopyUrlForEditForm');
		$this->setCustomFormRendering($form);
		return $form;
	}
	
	public function chooseCopyUrlForEditFormSubmitted(Nette\Application\UI\Form $form)
	{
		$this->mustBeAdmin();
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}
	
	protected function createComponentNewArticleEditForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addSubmit('new', 'Vytvořit nový článek');
		$form->onSuccess[] = array($this, 'newArticleEditFormSubmitted');
		$this->setCustomFormRendering($form);
		return $form;
	}
	
	public function newArticleEditFormSubmitted(Nette\Application\UI\Form $form)
	{
		$this->mustBeAdmin();
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}

}
