<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

	Router::parseExtensions('json');
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	// MAIN routes
	Router::connect('/', array('controller' => 'main', 'action' => 'index'));
	Router::connect('/jobs', array('controller' => 'main', 'action' => 'jobs'));
	Router::connect('/applications', array('controller' => 'main', 'action' => 'applications'));
	Router::connect('/download', array('controller' => 'main', 'action' => 'download'));
	Router::connect('/createjob', array('controller' => 'main', 'action' => 'createJob'));

	// PHONE routes
	Router::connect('/apply', array('controller' => 'phone', 'action' => 'apply'));
	Router::connect('/jobinfo', array('controller' => 'phone', 'action' => 'jobInfo'));

	// DATA routes
	Router::connect('/data/applicants', array('controller' => 'data', 'action' => 'applicants'));	
	Router::connect('/data/applications', array('controller' => 'data', 'action' => 'applications'));	
	Router::connect('/data/jobs', array('controller' => 'data', 'action' => 'jobs'));

	// TEST routes
	Router::connect('/test', array('controller' => 'main', 'action' => 'test'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
