<?

class Ctrl_librarian extends Ctrl_base {

public function profile() {


		$this->model = new Model_librarian();

		$user = $this->model->getUserProfile($_SESSION['user']['id']);

		if(!$_SESSION['user']['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
			exit();
		}

		$myActions = $this->model->getActionsById($_SESSION['user']['id']);

		//print_arr($myActions);


		$header = $this->generateTemplate('header', array('title' => 'Моя страница'));
		$footer = $this->generateTemplate('footer');

		$this->template = $this->generateTemplate('users/librarian', array('header' => $header, 'footer' => $footer, 'myActions' => $myActions, 'user' => $user));

		echo $this->template;
	}
}