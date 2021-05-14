<?php
include 'session.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$przepisID = $_POST['id'];
$userLogin = $_POST['login'];

$ulubione = UlubioneQuery::create()
            ->where('Ulubione.PrzepisIdPrzepis = ?', $przepisID)
            ->where('Ulubione.UzytkownikLogin = ?', $userLogin)
            ->find();

if(count($ulubione)==0) //nie bylo dodane do ulubionych - dodaje
{
  $ulub = new Ulubione();
  $ulub->setPrzepisIdPrzepis($przepisID);
  $ulub->setUzytkownikLogin($userLogin);

  if($ulub->save())
  {
    echo json_encode(array("statusCode"=>200));
  }
  else
  {
    echo json_encode(array("statusCode"=>201));
  }
}
else //jest juz w ulubionych - usuwam
{
    if($ulubione->delete()==false)
    {
          echo json_encode(array("statusCode"=>200));
    }
    else
    {
      echo json_encode(array("statusCode"=>201));
    }
}

//Jeśli się uda to zwróć 200
//echo json_encode(array("statusCode"=>200));

//Jeśli się nie uda to zwróć 201
//echo json_encode(array("statusCode"=>201));

?>
