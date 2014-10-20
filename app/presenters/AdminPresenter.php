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
		return $form;
	}
	
	public function chooseUrlForEditFormSubmitted(Nette\Application\UI\Form $form)
	{
		$this->mustBeAdmin();
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}

}
