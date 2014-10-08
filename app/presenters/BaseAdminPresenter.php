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
		$form->addGroup('URL adresa');
		$form->addSelect('presenter_id', 'Subdoména:', $pole)
			->setPrompt('Vyber jednu z veřejných subdomén')
			->setRequired('Musíš si vybrat konkrétní subdoménu');
		$form->addText('url1', '1. část URL adresy:', 50, 100)
			->setOption('description', html::el('small')->setHtml('Ve výsledcích googlu se malým písmem zobrazuje i adresa. Zkušení uživatelé se podle ní mohou rozhodnout o kliknutí/nekliknutí na výsledek...<p>Jinak: google v pohodě skloňuje, takže fotografovani-svatba je pro něj relevatní k "fotografování svateb"... Ale google nemění slovní druhy: fotografovani->fotografický je už pro něj něco jiného...</p>'))
			->addCondition(Form::FILLED)->addRule(Form::PATTERN, 'Pro url adresy (první i druhé části) je třeba dodržet toto: Smí se skládat pouze z číslic, malých písmen bez diakritiky nebo pomlček - přičemž první znak nesmí být pomlčka... A navíc se nesmí skládat jen ze samých číslic, to znamená, že alespoň jeden znak musí být písmeno nebo pomlčka...', '([a-z][-a-z0-9]*|[0-9]+[-a-z]+[-a-z0-9]*)');
		$form->addText('url2', '2. část URL adresy:', 50, 100)
			->addCondition(Form::FILLED)->addRule(Form::PATTERN, 'Pro url adresy (první i druhé části) je třeba dodržet toto: Smí se skládat pouze z číslic, malých písmen bez diakritiky nebo pomlček - přičemž první znak nesmí být pomlčka... A navíc se nesmí skládat jen ze samých číslic, to znamená, že alespoň jeden znak musí být písmeno nebo pomlčka...', '([a-z][-a-z0-9]*|[0-9]+[-a-z]+[-a-z0-9]*)');
		$form['url2']->addConditionOn($form['url1'], ~Form::FILLED)->addRule(Form::BLANK,'Vždy když používáš 2. část URL adresy, musíš také vyplnit i první část URL adresy... Takže buď vyplň pouze první část a druhé políčko nech prázdné... Nebo vyplň obě zároveň...');
		$form->addGroup('Náležitosti')->setOption('embedNext', TRUE);
		$form->addText('titulek', 'Titulek:', 70, 100)->setOption('description', html::el('small')->setHtml('<strong>Do titulku nevyplňuj: | urbanatelier.cz (to se tam doplní automaticky).</strong><p>Titulek se zobrazuje na záložce prohlížečového okna. Lidi si to tam moc nevšímají. Ale je to také <strong>modrý odkazový nadpis ve výsledcích googlu</strong>.<br>(Zobrazí se tam asi 70 znaků.) Tam to má obrovský psychologický význam, když lidi projíždí bleskově očima všechny výsledky odshora dolů. Vyplatí se tam dát něco, co skutečně hledají a na co kliknou... Samotný robot googlu slovům v titulku přikládá velkou váhu...<p>'));
		$form->addText('shrnuti_vyhledavace', 'Shrnutí pro vyhledávače:',130, 200)->setOption('description', html::el('small')->setHtml('Stručně shrň aktuální obsah dané url adresy (článku). Google může (a dělá to rád) tento Tvůj popisek zobrazit jako text výsledku hledání - zobrazuje tam okolo 145 znaků.'));
		$form->addGroup('Popisky odkazu');
		$form->addText('napis_menu', 'Text odkazu v menu:', 50, 100)->setRequired('Vyplň povinně text pro odkazy v menu.');
		$form->addText('bublina_odkazu', 'Vyskakovací bublina odkazu:', 70, 156)->setOption('description', html::el('small')->setHtml('To je takový ten drobný rámeček s dovysvětlením, který vyskočí, když člověk chvíli počká s myší na odkazu... Pro uživatele s dotykovým displayem (bez myši) je to asi nedostupné. Vyhledávače na to neberou zřetel. Nadužívání by možná i penalizovaly. Někdy se hodí k stručnému odkazu poskytnout v této bublině další informace.'));
		$form->addGroup('Hlavní text stránky (editor Texy2)');
		$form->addTextArea('texy', 'Text (nápovědu k formátování nalezneš dole):', 100, 20);
		$form->addGroup('Volby odeslání');
		$form->addCheckbox('smazano', 'Znepřístupnit článek pro uživatele bez administrátorských práv?')->setOption('description', html::el('small')->setHtml('(Ukáže se jim "stránka nenalezena", navíc položka zmizí z menu včetně podpoložek...)'));
		$form->addSubmit('preview', 'Nezávazný náhled')->onClick[] = array($this, 'submittedPreviewEditArticleForm');
		$form->addSubmit('save', 'Uložit')->onClick[] = array($this, 'submittedSaveEditArticleForm');

		$pole2 = array(
			'a' => 'Odstavce a odřádkování',
			'b' => 'Tučné písmo, kurzíva, ...',
			'c' => 'Nadpisy, podnadpisy, ',
			'd' => 'Aktivní odkazy v textu',
			'e' => 'Jsi v koncích?'
			);
		$pole3 = $this->adminNakladak->dejCiVyrobSeznamUrl($this->adminPrispevek);
		$form->addGroup('Nápověda k formátovacímu editoru Texy2');
		$form->addSelect('url_napoveda', 'Generátor aktivních odkazů na jiné články Tvého webu:', $pole3)
			->setPrompt('Vyber článek pro vygenerování formátovací zkratky, kterou vložíš, kam potřebuješ')
			->setAttribute('class','nahled ah1')
			->setOption('description', html::el('strong')->setClass('ah1')->setHtml('<span></span><span class="ah1">'))
			->setOmitted;
		$form->addButton('preview2', 'Ukázat odkazovaný článek v novém okně')
			->setAttribute('class','nahled')
			->setOption('description', html::el('div')->setClass('ah1')->setHtml('<span></span><span class="ah1"></span><span></span>'));
		$form->addSelect('help1', 'Jaké formátování by se Ti mohlo hodit v článku (odstavce, nadpisy, tučné písmo, aktivní odkazy, ...):', $pole2)
			->setPrompt('Zvol, co Tě zajímá...')
			->setOmitted;
		$form['help1']->addCondition(form::EQUAL, 'd')->toggle('ah2');
		
		
		
		
		$this->setCustomFormRendering($form);
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