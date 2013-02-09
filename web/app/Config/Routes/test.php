<?php
Router::connect('/test', array('controller' => 'test', 'action' => 'index'));	
Router::connect('/test/process', array('controller' => 'test', 'action' => 'process'));	
Router::connect('/test/info', array('controller' => 'test', 'action' => 'info'));	
Router::connect('/test/cake', array('controller' => 'test', 'action' => 'cake'));	