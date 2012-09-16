<?php
/**
 * RouteModel of the SiteconfigPlugin
 *
 * @package SiteConfig
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *	
 */
class Route extends SiteconfigAppController {
	/**
	 *
	 * name
	 * @var string the name
	 */
	public $name = "Route";
	
	/**
	 *
	 * use table
	 * @var boolean if the model uses a table or not
	 */
	public $useTable = false;
	
	/**
	 * custom find function
	 * @access public
	 */
	public function find($type, $params = array()){
		Configure::restore('Siteconfig.Site/dynroutes');
		return Configure::read('Siteroutes');
	}
	
	/**
	 * custom save function
	 *
	 * this save function saves the Routes in the Config/Site/routes.php
	 * CakePHP Config file.
	 * 
	 * @access public
	 */
	public function save($newData = array(),$isArray = false) {
		$configDir = APP.'Plugin'.DS.'Siteconfig'.DS.'Config'.DS.'Site';
		$data = array('Siteroutes' => array());
		
		if($isArray === false) {
			foreach($newData as $route) {				
				if(empty($route['url']) ||
						empty($route['route'])) continue;
				
				if(is_array($route['url'])) {
					$data['Siteroutes'][] = $route;
					continue;
				}
				
				$urlArray = explode(':',$route['url']);
			
				if(!isset($urlArray[0]) || !isset($urlArray[1])) continue;
				
				$url = array(
								'controller' => $urlArray[0],
								'action' => $urlArray[1]
								);
				
				if(isset($urlArray[2])) $url[] = $urlArray[2];
				
				$data['Siteroutes'][] = array(
									'route' => $route['route'],
									'url' => $url
							);
			}
		} else {
			$data['Siteroutes'] = $newData;
		}
		
		$configFileString = '<?php'."\n\r".'$config = ' . var_export($data,true).";";
		if(file_put_contents($configDir.DS.'dynroutes.php', $configFileString)) {
			return true;
		}
		
		return false;
	}
}