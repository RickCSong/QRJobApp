<?php 
Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
Router::connect('/manage', array('controller' => 'pages', 'action' => 'manage'));
Router::connect('/manage/setup', array('controller' => 'pages', 'action' => 'setup'));
