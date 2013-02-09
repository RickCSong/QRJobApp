<?php

App::uses('FormAuthenticate', 'Controller/Component/Auth');

class UserAuthenticate extends FormAuthenticate {
	public $settings = array(
		'fields' => array(
			'user_id' => 'user_id',
			'username' => 'username',
			'password' => 'password'
		),
		'userModel' => 'User',
		'passwordModel' => 'UserPassword',
		'scope' => array(),
		'recursive' => 0
	);

	/**
	 * Find a user record using the standard options.
	 *
	 * @param string $username The username/identifier.
	 * @param string $password The unhashed password.
	 * @return Mixed Either false on failure, or an array of user data.
	 */
	protected function _findUser($username, $password) {
		$userModel = $this->settings['userModel'];
		$passwordModel = $this->settings['passwordModel'];

		$fields = $this->settings['fields'];

		$conditions = array(
			$userModel . '.' . $fields['username'] => $username,
		);

		if (!empty($this->settings['scope'])) {
			$conditions = array_merge($conditions, $this->settings['scope']);
		}

		//$model . '.' . $fields['password'] => $this->_password($password),
		$result = ClassRegistry::init($userModel)->find('first', array(
			'conditions' => $conditions,
			'recursive' => (int)$this->settings['recursive']
		));

		if (empty($result) || empty($result[$userModel])) {
			return false;
		}

		$passwordConditions = array(
			$passwordModel . '.' . $fields['user_id'] => $result[$userModel][$fields['user_id']],
		);

		$passwordResult = ClassRegistry::init($passwordModel)->find('first', array(
			'conditions' => $passwordConditions,
			'order' => $passwordModel . '.password_date DESC',
			'recursive' => -1,
		));

		if (empty($passwordResult) || empty($passwordResult[$passwordModel])) {
			return false;
		}

		if ($this->_password($password) != $passwordResult[$passwordModel][$fields['password']]) {
			return false;
		}

		return $result[$userModel];
	}
}