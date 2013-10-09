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
		$ip = getRealIpAddr();
		$IPDetail=countryCityFromIP($ip);

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

// fonction qui retourne le pays en fonction de l'ip
function countryCityFromIP($ipAddr){
ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
$ipDetail=array(); //initialize a blank array

//get the XML result from hostip.info
$xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);



//get the city name inside the node <gml:name> and </gml:name>
preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);

//assing the city name to the array
$ipDetail['city']=$match[2]; 

//get the country name inside the node <countryName> and </countryName>
preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);

//assign the country name to the $ipDetail array
$ipDetail['country']=$matches[1];

//get the country name inside the node <countryName> and </countryName>
preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
$ipDetail['country_code']=$cc_match[1]; //assing the country code to array

//return the array containing city, country and country code
return $ipDetail;
}
// fonction qui retourne la véritable IP de l'utilisateur
function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {

      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {

      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {

      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>