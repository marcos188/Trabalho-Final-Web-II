<?php
require_once 'Models/Model.php';
require_once 'Views/View.php';

class Controller {

	public function index() {
		$myModel = new MyModel();
		$myView = new View();
		$banco = new Banco();
        $myView->render_index($banco->read_fome());
	}

  public function home() {
		$myModel = new MyModel();
		$myView = new View();
        $myView->render_show();
	}
}
