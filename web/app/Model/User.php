<?php

class User extends AppModel {
    public $name = 'User';
    public $validate = array(
    	'username' => array(
    		'required' => array(
    			'rule' => array('notEmpty'),
    			'message' => 'A username is required'
    		)
    	)
    );
    public $useTable = "users";
    public $primaryKey = 'user_id';
    public $hasMany = 'UserPassword';
    
    public function beforeSave($options = array()) {
        // TODO: Verify that there exists a user password before a save.
        return true;        
    }

}

?>