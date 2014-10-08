<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Sign in/out presenters.
 */
class UzivatelPresenter extends BasePresenter
{


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Vyplňte prosím přihlašovací jméno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte prosím příslušné heslo.');

		$form->addCheckbox('remember', 'Ponechat mě dlouhodobě přihlášeného');

		$form->addSubmit('send', 'Přihlásit');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form, $values)
	{
		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('1200 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Www:zobraz');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOdhlas()
	{
		$this->getUser()->logout();
		$this->flashMessage('Byl jste úspěšně odhlášen.');
		$this->redirect('prihlas');
	}
	
	public function actionZobraz()
	{
		$this->redirect('prihlas');
	}

}
