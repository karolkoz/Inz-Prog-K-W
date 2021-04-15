<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$nazwa = $_POST['nazwa'];
$trudnosc = $_POST['trudnosc'];
$czas_przygotowania = $_POST['czas_przygotowania'];
$ile_osob = $_POST['ile_osob'];
$opis = $_POST['opis'];
////ponizsze sie wstawiaja, tych wyzej jeszcze nie - do naprawy
$data=date("Y-m-d");
$status = 1;
$UZYTKOWNIK_login = "dummy123";



$przepis = new Przepis();


$przepis->setNazwa($nazwa);
$przepis->setStopienTrudnosci($trudnosc);
$przepis->setCzasPrzygotowania($czas_przygotowania);
$przepis->setDataDodania($data);
$przepis->setStatus($status);
$przepis->setUzytkownikLogin($UZYTKOWNIK_login);

// $przepis->setNazwa('nalesniki');
// $przepis->setStopienTrudnosci(2);
// $przepis->setCzasPrzygotowania(15);
// $przepis->setDataDodania($data);
// $przepis->setStatus(1);
// $przepis->setUzytkownikLogin('dummy123');



if($przepis->save())
{
    echo 'Dodano przepis o id: '.$przepis->getIdPrzepis();
}

?>
