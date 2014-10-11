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
	/** @var Model\MojeTexy @inject */
	public $mojeTexy;


	protected function createComponentEditArticleForm()
	{
		$pole = $this->adminNakladak->dejCiVyrobSeznamPresenteru($this->adminPrispevek);
		//\Tracy\Debugger::FireLog($pole);		
		$form = new Nette\Application\UI\Form;
		$form->addGroup('URL adresa');
		$form->addSelect('presenter_id', 'Subdoména:', $pole)
			->setPrompt('Vyber jednu z veřejných subdomén')
			->setDefaultValue(1)
			->setRequired('Musíš si vybrat konkrétní subdoménu');
		$form->addText('url1', '1. část URL adresy:', 50, 100)
			->setOption('description', html::el('small')->setHtml('Ve výsledcích googlu se malým písmem zobrazuje i adresa. Zkušení uživatelé se podle ní mohou rozhodnout o kliknutí/nekliknutí na výsledek...<p>Jinak: google v pohodě skloňuje, takže fotografovani-svatba je pro něj relevatní k "fotografování svateb"... Ale google nemění slovní druhy: fotografovani->fotografický je už pro něj něco jiného...</p>'))
			->addCondition(Form::FILLED)->addRule(Form::PATTERN, 'Pro url adresy (první i druhé části) je třeba dodržet toto: Smí se skládat pouze z číslic, malých písmen bez diakritiky nebo pomlček - přičemž první znak nesmí být pomlčka... A navíc se nesmí skládat jen ze samých číslic, to znamená, že alespoň jeden znak musí být písmeno nebo pomlčka...', '([a-z][-a-z0-9]*|[0-9]+[-a-z]+[-a-z0-9]*)');
		$form->addText('url2', '2. část URL adresy:', 50, 100)
			->addCondition(Form::FILLED)->addRule(Form::PATTERN, 'Pro url adresy (první i druhé části) je třeba dodržet toto: Smí se skládat pouze z číslic, malých písmen bez diakritiky nebo pomlček - přičemž první znak nesmí být pomlčka... A navíc se nesmí skládat jen ze samých číslic, to znamená, že alespoň jeden znak musí být písmeno nebo pomlčka...', '([a-z][-a-z0-9]*|[0-9]+[-a-z]+[-a-z0-9]*)');
		$form['url2']->addConditionOn($form['url1'], ~Form::FILLED)->addRule(Form::BLANK,'Vždy když používáš 2. část URL adresy, musíš také vyplnit i první část URL adresy... Takže buď vyplň pouze první část a druhé políčko nech prázdné... Nebo vyplň obě zároveň...');
		$form->addGroup('Náležitosti')->setOption('embedNext', 1);
		$form->addText('titulek', 'Titulek:', 70, 100)->setOption('description', html::el('small')->setHtml('<strong>Do titulku nevyplňuj: | urbanatelier.cz (to se tam doplní automaticky).</strong><p>Titulek se zobrazuje na záložce prohlížečového okna. Lidi si to tam moc nevšímají. Ale je to také <strong>modrý odkazový nadpis ve výsledcích googlu</strong>.<br>(Zobrazí se tam asi 70 znaků.) Tam to má obrovský psychologický význam, když lidi projíždí bleskově očima všechny výsledky odshora dolů. Vyplatí se tam dát něco, co skutečně hledají a na co kliknou... Samotný robot googlu slovům v titulku přikládá velkou váhu...<p>'));
		$form->addText('shrnuti_vyhledavace', 'Shrnutí pro vyhledávače:',130, 200)->setOption('description', html::el('small')->setHtml('Stručně shrň aktuální obsah dané url adresy (článku). Google může (a dělá to rád) tento Tvůj popisek zobrazit jako text výsledku hledání - zobrazuje tam okolo 145 znaků.'));
		$form->addGroup('Popisky odkazu');
		$form->addText('napis_menu', 'Text odkazu v menu:', 50, 100)->setRequired('Vyplň povinně text pro odkazy v menu.');
		$form->addText('bublina_odkazu', 'Vyskakovací bublina odkazu:', 70, 156)->setOption('description', html::el('small')->setHtml('To je takový ten drobný rámeček s dovysvětlením, který vyskočí, když člověk chvíli počká s myší na odkazu... Pro uživatele s dotykovým displayem (bez myši) je to asi nedostupné. Vyhledávače na to neberou zřetel. Nadužívání by možná i penalizovaly. Někdy se hodí k stručnému odkazu poskytnout v této bublině další informace.'));
		$form->addGroup('Hlavní text stránky (editor Texy2)');
		$form->addTextArea('texy', 'Text (nápovědu k formátování nalezneš dole):', 100, 20);
		$form->addGroup('Volby odeslání');
		$form->addCheckbox('smazano', 'Znepřístupnit článek pro uživatele bez administrátorských práv?')->setOption('description', html::el('small')->setHtml('(Ukáže se jim "stránka nenalezena", navíc položka zmizí z menu včetně podpoložek...)'));
		$form->addSubmit('preview', 'Nezávazný náhled editovaného článku')->onClick[] = array($this, 'submittedPreviewEditArticleForm');
		$form->addSubmit('save', 'Uložit')->onClick[] = array($this, 'submittedSaveEditArticleForm');

		/*$pole2 = array(
			'a' => 'Odstavce a odřádkování',
			'b' => 'Tučné písmo, kurzíva, ...',
			'c' => 'Nadpisy, podnadpisy, ...',
			'd' => 'Jsi v koncích?'
			);*/
		$pole3 = $this->adminNakladak->dejCiVyrobSeznamUrl($this->adminPrispevek);
		$form->addGroup('Nápověda k formátovacímu editoru Texy2')
			->setOption('embedNext',1);
		/*$form->addSelect('help1', 'Jaké formátování by se Ti mohlo hodit v článku (odstavce, nadpisy, tučné písmo, aktivní odkazy, ...):', $pole2)
			->setPrompt('Zvol, co Tě zajímá...')
			->setOmitted();
		$form['help1']->setOption('description', html::el('div')
			->add(html::el('p')->id('ah2-a')
				->setHtml(
				'blablabla  aaaaaa'
				)
			)
			->add(html::el('p')->id('ah2-b')
				->setHtml(
				'blablabla   bbbbbb'
				)
			)
			->add(html::el('p')->id('ah2-c')
				->setHtml(
				'blablabla   ccccccc'
				)
			)
			->add(html::el('p')->id('ah2-d')
				->setHtml(
				'blablabla ddddd'
				)
			)
		);*/
		
		$form->addRadioList('url_napoveda2', 'Zajímá Tě, jak vyrobit odkaz na cizí stránky?', array(1=>'ano', 0=>'ne'))
			->addCondition(form::EQUAL, 1)->toggle('ah2-x');
		$form['url_napoveda2']->setOption('description', html::el('div')->id('ah2-x')->setHtml('<p><strong>Odkazy mimo Tvůj web:</strong><p><p>Nalezneš zajímavou stránku kdekoliv na webu, z horního adresního řádku prohlížeče zkopíruješ přesnou adresu dané stránky a vložíš ji do textu do hranatých závorek. A před hranaté závorky nalepíš bez mezer dvojtečku a před tu dvojtečku bez mezery uvozovky a do uvozovek aktivní text, kterým se Ti hodí odkazovat</p><p>Příklad:</p><p>Včera jsem surfoval na internetu a na stránkách pana Petra Hranateho jsem objevil geniální článek o <strong>"velkých kulatých rybách v Amazonii":[http://www.hranaty.com/vylety/kulate-ryby/index.php?n=12]</strong>. Na stránce pana Hranatého naleznete i mnoho dalších zajímavých příběhů a informací.</p><p>Použitý tvar odkazu:<br><strong>"velkých kulatých rybách v Amazonii":[http://www.hranaty.com/vylety/kulate-ryby/index.php?n=12]</strong></p>'))
			->setOmitted();
		$form->addGroup('Generátor aktivních odkazů na jiné části Tvého webu');
		$form->addText('klikaci_slova', 'Slova, kterými odkazuješ:',70)
			->setAttribute('class','ah1')
			->setDefaultValue('Klikací slova')
			->setOmitted();
		$form->addSelect('url_napoveda', 'Cíl odkazu (jiná stránka na Tvém webu):', $pole3)
			->setPrompt('Vyber článek pro vygenerování formátovací zkratky, kterou vložíš, kam potřebuješ')
			->setAttribute('class','nahled ah1')
			->setOption('description', html::el('strong')->setClass('ah1')->setHtml('<span></span><span class="ah1">'))
			->setOmitted();
		$form->addButton('preview2', 'Ukázat odkazovaný článek v novém okně')
			->setAttribute('class','nahled')
			->setOmitted();
		$form->addButton('generurl','Generovat odkaz')
			->setAttribute('class','ah1')
			->setOption('description', html::el('div')->setClass('ah1'))
			->setOmitted();
		
		
		/*$form['help1']->addCondition(form::EQUAL, 'a')->toggle('ah2-a');
		$form['help1']->addCondition(form::EQUAL, 'b')->toggle('ah2-b');
		$form['help1']->addCondition(form::EQUAL, 'c')->toggle('ah2-c');
		$form['help1']->addCondition(form::EQUAL, 'd')->toggle('ah2-d');*/
		
		
		
		
		$this->setCustomFormRendering($form);
		return $form;
	}
	
	public function submittedPreviewEditArticleForm(Nette\Forms\Controls\SubmitButton $submit)
	{
		$form = $submit->getForm();
		$values = $form->getValues();
		$isSame = $this->adminPrispevek->dodejDatabazi()->table('prispevek')
			->where('presenter_id = ?', $values['presenter_id'])
			->where('url1 = ?', $values['url1'])
			->where('url2 = ?', $values['url2'])
			->count();
		if ($isSame > 0) {
			$this->flashMessage('Zadaná kombinace url adres 1. a 2. části a subdomény již v databázi uložených článků existuje. Pro zdárné uložení tohoto článku budete tedy potřebovat buď změnit některou z částí url adresy právě nahlíženého rozpracovaného článku, nebo budete muset změnit některou část url adresy u <a href="' . $this->link($this->adminPrispevek->dodejDatabazi()->table('presenter')->get($values['presenter_id'])->jmeno . ':' . 'zobraz', array('url1' => $values['url1'], 'url2' => $values['url2'])) . '" target="_blank">již dříve uloženého článku</a>.', 'flash-red');
		}
		$this->mojeTexy->filtrujReference($values['texy'], FALSE);
		$values['html'] = $this->mojeTexy->dodejTexy()->process("\r\n" . $values['texy']);
		$this->adminPrispevek->ulozNahled($values);
		$this->redirect('this');
	}
	
	public function submittedSaveEditArticleForm(Nette\Forms\Controls\SubmitButton $submit)
	{
		$form = $submit->getForm();
		$values = $form->getValues();
		\Tracy\Debugger::FireLog($form->submitted->name);
		\Tracy\Debugger::FireLog($values);
		$this->redirect('this');
	}

}
