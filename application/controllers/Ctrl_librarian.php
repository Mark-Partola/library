<?

class Ctrl_librarian extends Ctrl_user{

	public function profile() {


		$this->model = new Model_librarian();

		$user = $this->model->getUserProfile($_SESSION['user']['id']);

		if(!$_SESSION['user']['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
			exit();
		}

		$books = $this->model->getActionsById($_SESSION['user']['id']);

		//print_arr($myActions);


		$header = $this->generateTemplate('header', array('title' => 'Моя страница'));
		$footer = $this->generateTemplate('footer');

		$this->template = $this->generateTemplate('users/librarian', array('header' => $header, 'footer' => $footer, 'books' => $books, 'user' => $user));

		echo $this->template;
	}

	public function getProfile($id) {

		if($id === $_SESSION['user']['id']) {
			header('Location: '.ROUTE_ROOT.'/profile');
		}

		if(parent::profile($id) === false)
			echo $this->getTemplate('users/404', null, 'Нету :(');
	}

}