<?php
require_once '../Models/Model.php';

$request_m = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');

switch($request_m){
    case 'GET':

      $banco = new Banco();
      $ans = $banco->read_pobreza();
      echo json_encode($ans);
      break;

    case 'POST':
        $banco = new Banco();

        $ansT = $_POST['ansT'];
        $val = $_POST['val'];
        $banco->add_answer($ansT,$val);
        break;
}
