<?php 
Router::connect('/device', array('controller' => 'devices', 'action' => 'process'));
Router::connect('/device/parse', array('controller' => 'devices', 'action' => 'parse'));