<?php
/**
 * SettingModel of the SiteconfigPlugin
 *
 * @package SiteConfig
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *	
 */
class Setting extends SiteconfigAppController {
	/**
	 *
	 * name
	 * 
	 */
	public $name = "Setting";
	
	/**
	 *
	 * use table
	 */
	public $useTable = false;
	
	/**
	 * custom find method
	 */
	public function find(){		
		return Configure::read('SiteSettings');
	}
	
	/**
	 * custom save function
	 */
	public function save($data = array(),$isArray = false) {
		$configDir = APP.'Plugin'.DS.'Siteconfig'.DS.'Config'.DS.'Site';
		//$data = array('Siteroutes' => array());
		$configFileString = '<?php'."\n\r".'$config = ' . var_export($data,true).";";
		if(file_put_contents($configDir.DS.'site.php', $configFileString)) {
			return true;
		}
		
		return false;
	}
}