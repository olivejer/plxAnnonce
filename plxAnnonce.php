<?php
/**
 * Plugin plxAnnonce
 *
 * @author	Jérôme OLIVE
 **/

class plxAnnonce extends plxPlugin {
	
	public function __construct($default_lang) {
	# appel du constructeur de la classe plxPlugin (obligatoire)
	parent::__construct($default_lang);
	$this->setConfigProfil(PROFIL_ADMIN);
	# déclaration du hook
	$this->addHook('ThemeEndHead', 'ThemeEndHead');
	$this->addHook('ThemeEndHead', 'Annonce');
	
	}
	public function ThemeEndHead() {
	echo '<link href="'.PLX_PLUGINS.'plxAnnonce/css/plxAnnonce.css" rel="stylesheet" type="text/css" />';
	
	}
	public function Annonce()
	{
		if($this->getParam('debug') || !isset($_SESSION['annonce']))
		{
		$_SESSION['annonce']=true;
		echo '<div id="annonceblackbg"></div>
		<div id="cadreannonce">';
		if(!$this->getParam('debug'))
			echo '<a id="close" href="/"><img  src="'.PLX_PLUGINS.'plxAnnonce/img/close.png"/></a>';
		echo $this->getParam('edit').'
		
		</div>';
		}
	}
}

?>