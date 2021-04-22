<?php

$stageImagesStart=[];
$i=0;
foreach($_POST['stageImagesStart'] as $val) {
  $stageImagesStart[$i]=$val;
  $i++;
}
$i=0;
$stageImagesIfDB=[];
foreach($_POST['stageImagesIfDB'] as $val) {
  $stageImagesIfDB[$i]=$val;
  $i++;
}
$ileEtapow=$i;
$i=0;
for($i=0; $i<$ileEtapow; $i++) {
  $pozycjaEtapu = $i + 1;
  switch($stageImagesIfDB[$i]) {
    case 0:
      echo 'Etap '.$pozycjaEtapu.' nie ma obrazka</br>';
      break;
    case 1:
      echo 'Etap '.$pozycjaEtapu.' ma obrazek, który w przepisie był przy etapie '.$stageImagesStart[$i].' </br>';
      break;
    case 2:
      echo 'Etap '.$pozycjaEtapu.' ma obrazek w inpucie </br>';
      break;
  }
}

switch($_POST['mainImageStatus']) {
  case 0:
    echo 'Brak Obrazka Głównego</br>';
    break;
  case 1:
    echo 'Obrazek Główny pochodzi z bazy</br>';
    break;
  case 2:
    echo 'Obrazek Główny jest w inpucie </br>';
    break;
}

 ?>
