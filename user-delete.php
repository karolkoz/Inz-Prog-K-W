<?php
include 'session.php';
//Tutaj sprawdzamy czy jest aktywna sesja
//Jeśli jest, to usuwamy konto pobrane z sesji
//Potem zamykamy sesje i przenosimy na strone główną
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';


$userPyszniutkie = UzytkownikQuery::create()
              ->filterByLogin("Pyszniutkie.pl")
              ->select(array('Uzytkownik.Login'))
              ->findOne();

if(!isset($_GET['login'])) {
  $userLogin = $_SESSION['login'];
} else {
  if($_SESSION['level']==2) {
    $userLogin = $_GET['login'];
  }
}


// $currentUser = UzytkownikQuery::create()
//               ->filterByLogin($userLogin)
//               ->findOne();

$przepisyUsera = PrzepisQuery::create()
              ->select(array('IdPrzepis'))
              ->where('Przepis.UzytkownikLogin = ?', $userLogin); //tablica wszystkich id przepisow danego usera

foreach($przepisyUsera as $pID) //dla kazdego z tych id przepisow
{
  $przepis = PrzepisQuery::create()->findPk($pID); //znajdz przepis o tym id
  $przepis->setUzytkownikLogin($userPyszniutkie); //ustaw dla niego nowego autora (Pyszniutkie.pl)
  echo '</> dla przepisu o id: '.$pID.' ustawiam nowego wlasciciela: '.$userPyszniutkie.' </br>';
  $przepis->save();
}

$usersLike = Lubie_toQuery::create()
              ->filterByUzytkownikLogin($userLogin)
              ->delete();

              $usersFav = UlubioneQuery::create()
                            ->filterByUzytkownikLogin($userLogin)
                            ->delete();

$currentUser = UzytkownikQuery::create()
              ->filterByLogin($userLogin)
              ->delete();

if(!isset($_GET['login'])) {
  if(isset($_SESSION['login'])) {
    $_SESSION = array();
    session_destroy();
    echo 'Sesja zniszczona';
  }
} else {
  header("Location: admin-users.php");
}

echo '<script type="text/javascript">
  window.location = "index.php";
</script>'
 ?>
