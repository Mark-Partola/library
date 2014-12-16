<?

class Ctrl_librarians extends Ctrl_base {

public function profile() {

		if(!$_SESSION['user']['auth']) {
			header('Location: '.ROUTE_ROOT.'/login');
			exit();
		}

		echo 'Библиотекарь';

	}
}