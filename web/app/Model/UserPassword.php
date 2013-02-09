<?php

class UserPassword extends AppModel {
    public $name = 'UserPassword';
    public $useTable = "user_passwords";
    public $belongsTo = "User";
    public $validate = array(
    	'password' => array(
    		'required' => array(
    			'rule' => array('notEmpty'),
    			'message' => 'A password is required'
			)
		)
    );
    
    // PASSWORD HASHING
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;        
    }
}

?>