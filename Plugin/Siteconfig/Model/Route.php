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
				
				if(!isset($route['url']['slug'])) {
					$data['Siteroutes'][] = $route;
					continue;
				}
				
				$urlArray = $route['url'];
				
				//cake url array
				$url = array();
				
				//no action no cotroller set skip
				if(empty($urlArray['controller']) || empty($urlArray['action'])) continue;
							
				$url['controller'] = $urlArray['controller'];
				$url['action'] = $urlArray['action'];
				
				//set plugin if  it is not empty 
				if(!empty($urlArray['plugin'])) $url['plugin'] = $urlArray['plugin'];
				
				//set slug if it is not empty
				
				if(!empty($urlArray['slug'])) $url[] = $urlArray['slug'];
								
				
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