<?php

// $stageImagesStart=[];
// $i=0;
// foreach($_POST['stageImagesStart'] as $val) {
//   $stageImagesStart[$i]=$val;
//   $i++;
// }
// $i=0;
// $stageImagesIfDB=[];
// foreach($_POST['stageImagesIfDB'] as $val) {
//   $stageImagesIfDB[$i]=$val;
//   $i++;
// }
// $ileEtapow=$i;
// $i=0;
// for($i=0; $i<$ileEtapow; $i++) {
//   $pozycjaEtapu = $i + 1;
//   switch($stageImagesIfDB[$i]) {
//     case 0:
//       echo 'Etap '.$pozycjaEtapu.' nie ma obrazka</br>';
//       break;
//     case 1:
//       echo 'Etap '.$pozycjaEtapu.' ma obrazek, który w przepisie był przy etapie '.$stageImagesStart[$i].' </br>';
//       break;
//     case 2:
//       echo 'Etap '.$pozycjaEtapu.' ma obrazek w inpucie </br>';
//       break;
//   }
// }
//
// switch($_POST['mainImageStatus']) {
//   case 0:
//     echo 'Brak Obrazka Głównego</br>';
//     break;
//   case 1:
//     echo 'Obrazek Główny pochodzi z bazy</br>';
//     break;
//   case 2:
//     echo 'Obrazek Główny jest w inpucie </br>';
//     break;
// }

// foreach($_POST['categories'] as $val) {
//   echo $val;
// }




////////edycja w tabeli 'przespis'///////
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$nazwa = $_POST['nazwa'];
$trudnosc = $_POST['trudnosc'];
$czas_przygotowania = $_POST['czas_przygotowania'];
$ile_osob = $_POST['ile_osob'];
$opis = $_POST['opis'];
$data=date("Y-m-d");

// $image = $_FILES['image']['tmp_name'];
// $image_length = strlen($image);


$id_przepis = 13;
$przepis = PrzepisQuery::create()->findPk($id_przepis);

$przepis->setNazwa($nazwa);
$przepis->setStopienTrudnosci($trudnosc);
$przepis->setCzasPrzygotowania($czas_przygotowania);
$przepis->setDlaIluOsob($ile_osob);
$przepis->setOpis($opis);
$przepis->setDataDodania($data);
//$przepis->setStatus($status);


switch($_POST['mainImageStatus']) {
  case 0:
    echo 'Brak Obrazka Głównego</br>';
    $przepis->setZdjecieOgolne(null);
    break;
  case 1:
    echo 'Obrazek Główny pochodzi z bazy</br>';
    break;
  case 2:
    echo 'Obrazek Główny jest w inpucie </br>';

    $image = $_FILES['image']['tmp_name'];
//  $image = $_FILES['image'];
    $img = file_get_contents($image);
    $przepis->setZdjecieOgolne($img);


    // if ($image_length!==0){
    //   $img = file_get_contents($image);
    //   $przepis->setZdjecieOgolne($img);
    // }
    // else{
    //   $przepis->setZdjecieOgolne(null);
    // }
    break;
}


// if ($image_length!==0){
//   $img = file_get_contents($image);
//   $przepis->setZdjecieOgolne($img);
// }
// else{
//   $przepis->setZdjecieOgolne(null);
// }


if($przepis->save())
{
    echo ' </br>Zaktualizowano przepis o id: '.$przepis->getIdPrzepis().'</br>';
}


 ?>
