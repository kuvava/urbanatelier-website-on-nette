<?php

namespace App\Presenters;

use Nette,
	App\Model,
	Nette\Application\UI\Form,
	Nette\Utils\Html;


/**
 * Homepage presenter.
 */
class BaseAdminPresenter extends BasePresenter
{

	/** @var Model\AdminNakladak @inject */
	public $adminNakladak;
	/** @var Model\AdminPrispevek @inject */
	public $adminPrispevek;
	/** @var Model\AdminMenu @inject */
	public $adminMenu;


	protected function createComponentEditArticleForm()
	{
		$pole = $this->adminNakladak->dejCiVyrobSeznamPresenteru($this->adminPrispevek);
		//\Tracy\Debugger::FireLog($pole);		
		$form = new Nette\Application\UI\Form;
		$form->addSelect('presenter_id', 'Subdoména:', $pole)
			->setPrompt('Vyber jednu z veřejných subdomén')
			->setRequired('Musíš si vybrat konkrétní subdoménu');
		$form->addText('url1', '1. část URL adresy:', 50, 100)
			->setOption('description', html::el('small')->setHtml('<p>Ve výsledcích googlu se malým písmem zobrazuje i adresa. Zkušení uživatelé se podle ní mohou rozhodnout o kliknutí/nekliknutí na výsledek...</p><p>Jinak: google v pohodě skloňuje, takže fotografovani-svatba je pro něj relevatní k "fotografování svateb"... Ale google nemění slovní druhy: fotografovani->fotografický je už pro něj něco jiného...</p>'))
			->addCondition(Form::FILLED)->addRule(Form::PATTERN, 'Pro url1 nebo url2 je třeba dodržet toto: Smí se skládat pouze z číslic, malých písmen bez diakritiky nebo pomlček... Navíc nesmí začínat pomlčkou... A alespoň jeden znak musí být písmeno nebo pomlčka (= alespoň jeden znak musí být jiný než číslice)...', '([a-z][-a-z0-9]*|[0-9]+[-a-z]+[-a-z0-9]*)');
		$form->addText('url2', '2. část URL adresy:', 50, 100)
			->addCondition(Form::FILLED)->addRule(Form::PATTERN, 'Pro url1 nebo url2 je třeba dodržet toto: Smí se skládat pouze z číslic, malých písmen bez diakritiky nebo pomlček... Navíc nesmí začínat pomlčkou... A alespoň jeden znak musí být písmeno nebo pomlčka (= alespoň jeden znak musí být jiný než číslice)...', '([a-z][-a-z0-9]*|[0-9]+[-a-z]+[-a-z0-9]*)');
		$form['url2']->addConditionOn($form['url1'], ~Form::FILLED)->addRule(Form::BLANK,'Vždy když používáš 2. část URL adresy, musíš také vyplnit i první část URL adresy... Takže buď vyplň pouze první část a druhé políčko nech prázdné... Nebo vyplň obě zároveň...');
		$form->addText('titulek', 'Titulek:', 70, 100)->setOption('description', html::el('small')->setHtml('<p><strong>Do titulku nevyplňuj: | urbanatelier.cz (to se tam doplní automaticky).</strong></p><p>Titulek se zobrazuje na záložce prohlížečového okna. Lidi to tam nevidí. Ale je to také <strong>modrý odkazový nadpis ve výsledcích googlu</strong>.<br>(Zobrazí se tam asi 70 znaků.) Tam to má obrovský psychologický význam, když lidi projíždí bleskově očima všechny výsledky odshora dolů. Vyplatí se tam dát něco, co skutečně hledají a na co kliknou... Samotný robot googlu slovům v titulku přikládá velkou váhu...<p>'));
		$form->addText('shrnuti_vyhledavace', 'Shrnutí pro vyhledávače:',150, 200)->setOption('description', html::el('small')->setHtml('<p>Stručně shrň aktuální obsah dané url adresy (článku). Google může (a dělá to rád) tento Tvůj popisek zobrazit jako text výsledku hledání - zobrazuje tam okolo 145 znaků.</p>'));
		$form->addCheckbox('smazano', 'Znepřístupnit článek pro uživatele bez administrátorských práv? (Ukáže se jim "stránka nenalezena", navíc položka zmizí z menu včetně podpoložek...)');
		$form->addSubmit('preview', 'Nezávazný náhled')->onClick[] = array($this, 'submittedPreviewEditArticleForm');
		$form->addSubmit('save', 'Uložit')->onClick[] = array($this, 'submittedSaveEditArticleForm');
		return $form;
	}
	
	public function submittedPreviewEditArticleForm(Nette\Forms\Controls\SubmitButton $submit)
	{
		$form = $submit->getForm();
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($form->submitted->name);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}
	
	public function submittedSaveEditArticleForm(Nette\Forms\Controls\SubmitButton $submit)
	{
		$form = $submit->getForm();
		$values = $form->getValues(TRUE);
		\Tracy\Debugger::FireLog($form->submitted->name);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}

}
