<?

class Ctrl_librarian extends Ctrl_user{

	private $model;

	public function profile() {


		$this->model = new Model_librarian();

		if(!$_SESSION['user']['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
			exit();
		}

		$user = $this->model->getUserProfile($_SESSION['user']['id']);
		$books = $this->model->getActionsById($_SESSION['user']['id']);
		$expBooks = $this->model->getExpBooks();

		//print_arr($myActions);


		$header = $this->generateTemplate('header', array('title' => 'Моя страница'));
		$footer = $this->generateTemplate('footer');

		$this->template = $this->generateTemplate('users/librarian', array('header' => $header, 'footer' => $footer, 'books' => $books, 'expBooks' => $expBooks, 'user' => $user));

		echo $this->template;
	}

	public function getProfile($id) {

		if($id === $_SESSION['user']['id']) {
			header('Location: '.ROUTE_ROOT.'/profile');
		}

		if(parent::profile($id) === false)
			echo $this->getTemplate('users/404', null, 'Нету :(');
	}

	public function acceptBook($id_exp) {

		if(!isAjax()) {
			return false;
		}

		if(!$_SESSION['user']['auth']) {
			return false;
		}

		$this->model = new Model_librarian();

		if(isset($_GET['forcibly'])) {
			$forcibly = $_GET['forcibly'];
		} else {
			$forcibly = false;
		}

		$res = $this->model->acceptBook($id_exp, $_SESSION['user']['id'], $forcibly);

		$arr = array();

		if($res === true){
			$arr['msg'] = 'Успешно оформлено!!!';
		} elseif($res === -1 ) {
			$arr['msg'] = 'У этого пользователя уже есть такая книга!';
			$arr['confirm'] = true;
		} elseif($res === -2 ) {
			$arr['msg'] = 'Неверное имя!';
			$arr['confirm'] = true;
		} else {
			$arr['msg'] ='Возникла ошибка!';
		}

		echo json_encode($arr);
	}

}