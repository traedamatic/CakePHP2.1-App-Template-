<?php
/**
 * SiteConfig Plugin Routes
 * 
 * @package SiteConfig
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *	
 */

/**
 *
 * Dynamic Routes
 * 
 */
Configure::load('Siteconfig.Site/dynroutes');
$siteRoutes = Configure::read('Siteroutes');
foreach($siteRoutes as $newRoute) {
	Router::connect($newRoute['route'],$newRoute['url']);
}
 
Router::parseExtensions('json');
 
/** Static Plugin Routes **/

/** Routes Routes */
Router::connect('/manager/site/routes', array('plugin' => "siteconfig",'controller' => 'routes', 'action' => 'index', "manager" => true));
Router::connect('/manager/site/routes/:action/*', array('plugin' => "siteconfig",'controller' => 'routes', "manager" => true));

/** Settings Routes */
Router::connect('/manager/site/settings', array('plugin' => "siteconfig",'controller' => 'settings', 'action' => 'index', "manager" => true));
Router::connect('/manager/site/settings/:action/*', array('plugin' => "siteconfig",'controller' => 'settings', "manager" => true,));

