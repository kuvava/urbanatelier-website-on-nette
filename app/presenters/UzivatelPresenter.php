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
		$form->addText('username', 'Username:')
			->setRequired('Vyplňte prosím uživatelské jméno.');

		$form->addPassword('password', 'Password:')
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
			$this->getUser()->setExpiration('20 minutes', TRUE);
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
		$this->redirect('WWW:zobraz',array('url1'=> 'u3', 'url2'=>'u5'));
	}
	
	public function actionZobraz()
	{
		$this->redirect('prihlas');
	}

}
