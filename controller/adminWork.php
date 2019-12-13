<?php
require_once '../Models/Model.php';

$request_m = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');

switch($request_m){

    case 'POST':
      $banco = new Banco();

      $id = $_POST['id'];
      $value = $_POST['value'];
      $banco->update_desocupacao($id,$value);
      break;
}
