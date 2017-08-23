<?php

class Model {
	public $text;

	public function __construct() {
		$this->text = 'Hello world!';
	}
}

class View {
	private $model;

	public function __construct(Model $model) {
		$this->model = $model;
	}

	public function output() {
		return '<a href="index.php?action=textclicked">' . $this->model->text . '</a>';
	}

}

class Controller {
	private $model;

	public function __construct(Model $model) {
		$this->model = $model;
	}

	public function textClicked() {
		$this->model->text = 'Text Updated';
	}
}


$model = new Model();
//It is important that the controller and the view share the model
$controller = new Controller($model);
$view = new View($model);
if (isset($_GET['action'])) $controller->{$_GET['action']}();
echo $view->output();



$params = array(PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

$db = new PDO('mysql:host=localhost;dbname=service-highscore;charset=utf8mb4', 'root', 'root', $params);

foreach($db->query('SELECT * FROM test') as $row) {
	echo $row['field1'].' '.$row['field2']; //etc...
}




$stmt = $db->prepare('SELECT * FROM test WHERE id = :id');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); // <-- filter your data first (see [Data Filtering](#data_filtering)), especially important for INSERT, UPDATE, etc.
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
$stmt->execute();