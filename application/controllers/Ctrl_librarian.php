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

		$forcibly = array();
		if(isset($_GET['have'])) {
			$forcibly['have'] = true;
		} else {
			$forcibly['have'] = false;
		}

		if(isset($_GET['limit'])) {
			$forcibly['limit'] = true;
		} else {
			$forcibly['limit'] = false;
		}

		$res = $this->model->acceptBook($id_exp, $_SESSION['user']['id'], $forcibly);

		$arr = array();

		if($res === true){
			$arr['msg'] = 'Успешно оформлено!';
		} elseif($res === -1 ) {
			$arr['msg'] = 'У этого пользователя уже есть такая книга!';
		} elseif($res === -2 ) {
			$arr['msg'] = 'Лимит исчерпан!';
		} else {
			$arr['msg'] ='Возникла ошибка!';
		}

		echo json_encode($arr);
	}

	public function delBook($book_id){

		if(!isAjax())	return false;

		if(!isset($_SESSION['user']['auth'])) return false;

		$this->model = new Model_librarian();

		$result = $this->model->delBook($book_id);

		if($result === true) echo 'Успешно удалено!';
		elseif($result === 0) echo 'Нет такого заказа!';
		else echo 'Произошла ошибка!';

	}

	public function createUser() {

		if(!isAjax())	return false;
		if(!isset($_SESSION['user']['auth'])) return false;

		$userData = json_decode($_POST['jsonData']);

		$this->model = new Model_librarian();

		if( !empty($userData->fname) &&
			!empty($userData->lname) &&
			!empty($userData->passport) &&
			!empty($userData->email) ) {

			if( !filter_var($userData->email, FILTER_VALIDATE_EMAIL) ) {

				echo 'Не похоже на адрес почты!';

			} else {

				$res = $this->model->createUser(
					$userData->fname,
					$userData->lname,
					$userData->passport,
					$userData->email,
					$userData->patr,
					$userData->limit
				);

				if($res === true) echo 'Пользователь создан';
				else  echo 'Произошла ошибка';

			}

		} else {

			echo 'Заполните все поля!';

		}



	}

}