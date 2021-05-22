<?php
include 'session.php';
if(!isset($_SESSION['login']) || $_SESSION['level'] != 2) {
  header("Location: login.php");
}
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$przepisID = $_POST['id'];
$przepisStatus = $_POST['status'];

$przepis = PrzepisQuery::create()->findPk($przepisID);

$przepis->setStatus($przepisStatus);

if($przepis->save())
{
  echo json_encode(array("statusCode"=>200));
}
else
{
  echo json_encode(array("statusCode"=>201));
}




  //echo json_encode(array("statusCode"=>200));
  //echo json_encode(array("statusCode"=>201));
 ?>
