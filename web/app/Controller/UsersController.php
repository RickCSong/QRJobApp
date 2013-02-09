<?php
	class UsersController extends AppController {
		public $name = 'Users';
		public $uses = array('User', 'UserPassword');
		public $components = array(
			'Auth' => array(
				'loginRedirect' => array('controller' => 'users', 'action' => 'profile'),
				// Add a logout message in future
				'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
				'authenticate' => array(
					'User' => array(
						'userModel' => 'User',
						'passwordModel' => 'UserPassword'
					)
				)
			)
		);

		// Remove in future.  Use for 
		public function index() {
			$this->autoRender = false;
			// Require that the join table is ALWAYS present.
			/*
			$data = array(
				'User' => array(
					'username' => 'StanSYang',
					'name' => 'Stanley Yang',
					'email' => 'StanSYang@yahoo.com'
				),
				'UserPassword' => array(
					array('password' => 'Pi314159')
				)
			);
			*/
			
			$data = array(
				'User' => array(
					'username' => 'RickCSong',
					'name' => 'Rick Song',
					'address' => '3409 Westfield Dr.',
					'email' => 'RickCSong@gmail.com'
				),
				'UserPassword' => array(
					array('password' => 'Pi314159')
				)
			);
			

			/*
			$data = array(
				'UserPassword' => array(
					'user_id' => 1,
					'password' => 'Pi314159'
				)
			);
			*/
			$this->User->saveAssociated($data);
			//$this->UserPassword->save($data);
		}

		public function login() {
			if ($this->Auth->user()) {
				// Redirect the user if he's already logged in.
				return $this->redirect(array('controller' => 'users', 'action' => 'profile'));		
			} 

			if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		            return $this->redirect($this->Auth->redirect());
		        } else {
					$this->set('error', 'Invalid e-mail or password');
		        }
		    }
			
			$this->render('/Pages/Login/index');
		}

		public function logout() {
			$this->Auth->logout();
		    return $this->redirect($this->Auth->redirect());
		}

		public function profile() {
			$this->render('/Pages/Profile/index');
		}

		public function register() {
			if ($this->Auth->user()) {
				// Redirect the user if he's already logged in.
				return $this->redirect(array('controller' => 'users', 'action' => 'profile'));		
			} 

			if ($this->request->is('post')) {
				// TODO: Create account
				// TODO: Redirect him to login page
				return $this->redirect(array('controller' => 'users', 'action' => 'login'));		
			}

			$this->render('/Pages/Register/index');		
			
		}

		public function update() {
			$this->autoRender = false;

			$data = array(
				'User' => array(
					'user_id' => 2,
					'username' => 'RickCSong',
					'name' => 'Rick Song',
					'address' => '3409 Westfield Dr.',
					'email' => 'RickCSong@gmail.com'
				)
			);

			$this->User->save($data);
			// TODO: REFRESH AUTHCOMPONENT
		}

		public function updatePassword() {
			$this->autoRender = false;	

			$user = $this->Auth->user();

			$data = array(
				'UserPassword' => array(
					'user_id' => $user['user_id'],
					'password' => 'Pi314159'
				)
			);
			$this->UserPassword->save($data);
			
		}

		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('index', 'register'); // Maybe place in AppController
		}
	}
?>