<?php
include 'session.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$przepisID = $_POST['id'];
$userLogin = $_POST['login'];

$lubieTo = Lubie_toQuery::create()
            ->where('Lubie_to.PrzepisIdPrzepis = ?', $przepisID)
            ->where('Lubie_to.UzytkownikLogin = ?', $userLogin)
            ->find();

if(count($lubieTo)==0)
{
  $like = new Lubie_to();
  $like->setPrzepisIdPrzepis($przepisID);
  $like->setUzytkownikLogin($userLogin);

  if($like->save())
  {
    echo json_encode(array("statusCode"=>200));
  }
  else
  {
    echo json_encode(array("statusCode"=>201));
  }
}
else
{
    if($lubieTo->delete()==false)
    {
          echo json_encode(array("statusCode"=>200));
    }
    else
    {
      echo json_encode(array("statusCode"=>201));
    }
}

?>
