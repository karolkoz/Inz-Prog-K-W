<?php
 
// test.php
 
// dołączamy autoloader Composera
 
require_once __DIR__.'/vendor/autoload.php';

//require_once 'C:\xampp\htdocs\vendor\autoload.php'; 
 
 
 
// dołączamy plik z konfiguracją
 
require_once __DIR__.'/generated-conf/config.php';

//require_once 'C:\xampp\htdocs\generated-conf/config.php'; 
 
 
 
// tworzymy nowy skladnik
 
$skladniki = new Skladniki();
 
 
 
// ustawiamy nazwe
 
$skladniki->setNazwa('schabowy');

 
 
// zapisujemy
 
if($skladniki->save())
 
{
 
    echo 'Dodano skladnik o id: '.$skladniki->getIdSkladnik();

    echo ' Ten skladnik to: '.$skladniki->getNazwa();
 
}
 
?>