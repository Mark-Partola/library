<?

class Ctrl_librarian extends Ctrl_base {

public function profile() {

		$this->model = new Model_librarian();

		if(!$_SESSION['user']['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
			exit();
		}

		$myActions = $this->model->getActionsById($_SESSION['user']['id']);

		//print_arr($myActions);

		echo $this->getTemplate('users/librarian', array('myActions' => $myActions), 'Авторизация');
	}
}