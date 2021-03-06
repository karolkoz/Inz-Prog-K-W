<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$nazwa = $_POST['nazwa'];
$trudnosc = $_POST['trudnosc'];
$czas_przygotowania = $_POST['czas_przygotowania'];
$ile_osob = $_POST['ile_osob'];
$opis = $_POST['opis'];
$data=date("Y-m-d");


$id_przepis = $_GET['przepisID'];
$przepis = PrzepisQuery::create()->findPk($id_przepis);

$przepis->setNazwa($nazwa);
$przepis->setStopienTrudnosci($trudnosc);
$przepis->setCzasPrzygotowania($czas_przygotowania);
$przepis->setDlaIluOsob($ile_osob);
$przepis->setOpis($opis);
$przepis->setDataDodania($data);
$przepis->setStatus(2);


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
    $img = file_get_contents($image);
    $przepis->setZdjecieOgolne($img);
    break;
}
$przepis->save();


if($przepis->save())
{
    echo ' </br>Zaktualizowano przepis o id: '.$przepis->getIdPrzepis().'</br>';
}


///////////////////////////////////////////////edycja skladnikow dla przepisu///////////////////////////

$zawiera = ZawieraQuery::create()
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli ZAWIERA dla przepisu o ID: '.$przepis->getIdPrzepis().'</br>';


$tab=[];
$i=0;
foreach($_POST['skladnik_ilosc'] as $val)
{
  $tab[$i]=$val;
  $i++;
}


//warunkowe wstawianie do tabeli 'SKLADNIKI':
$j=0;
foreach ($_POST['skladnik_nazwa'] as $value)
{
  $skladniki = SkladnikiQuery::create()
  ->filterByNazwa($value)
  ->find();

  if (count($skladniki) == 0) {
   $skladnik = new Skladniki();
   $skladnik->setNazwa($value);
   $skladnik->save();
   } elseif (count($skladniki) == 1) {
       $skladnik = $skladniki[0];
    }

  $zawiera = new Zawiera();
  $zawiera->setPrzepis($przepis);
  $zawiera->setSkladniki($skladnik);
  $zawiera->setIlosc($tab[$j]);
  $zawiera->save();

  $j++;
  echo " Zaktualizowano skladnik dla przepisu!</br>";
}

////////////////////////////////////////////////////////////edycja kategorii///////////////////////////////
$nalezy = NalezyQuery::create()
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli NALEZY dla przepisu o ID: '.$przepis->getIdPrzepis().'</br>';

foreach ($_POST['categories'] as $name_categories)
{
  $nalez = new Nalezy();
  $nalez->setPrzepis($przepis);
  $nalez->setKategoriaNazwa($name_categories);
  $nalez->save();
  echo "  zaktualizowano kategorię dla przepisu! </br> ";
}

/////////////////////////////edycja etapow/////////////////////////
$etap = EtapQuery::create()
        ->filterByPrzepisIdPrzepis($id_przepis)
        ->select(array('Zdjecie'))
        ->find();
$etapKopia = [];
$num = count($_POST['etap']);
$i=0;
foreach($etap as $et){
  if($et !== null){
    $e=$etap->get($i);
    $etapKopia[$i] = $e;
  } else {
    $etapKopia[$i] = null;
  }
  $i++;
}
$etap = EtapQuery::create()
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli ETAP dla przepisu o ID: '.$przepis->getIdPrzepis().'</br>';

$num = count($_POST['etap']);
echo ' ILOSC ETAPOW: '.$num.'</br>';

$nr_etap=1;


$tab2=[];
$k=0;
foreach($_POST['etap'] as $val_opis)
{
  $tab2[$k]=$val_opis;
  // echo $val_opis.'</br>';
  $k++;
}


$stageImagesStart=[];
 $i=0;
 foreach($_POST['stageImagesStart'] as $val) {
   echo 'stageImagesStart['.$i.'] = '.$val.'<br />';
  $stageImagesStart[$i]=$val;
  $i++;
}
$i=0;
$stageImagesIfDB=[];
 foreach($_POST['stageImagesIfDB'] as $val) {
   echo 'stageImageIfDB['.$i.'] = '.$val.'<br />';
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



$tab4=[];
$p=0;
foreach($_FILES['etap_image']['tmp_name'] as $key) {
  switch($stageImagesIfDB[$p]) {
    case 0:
      $tab4[$p]=null;
      $p++;
      break;
    case 1:
      $tab4[$p]=$etapKopia[$stageImagesStart[$p]-1];
      $p++;
    break;
    case 2:
      $tab4[$p]=file_get_contents($key);
      $p++;
      break;
  }
}



$m=0;
for($m=0; $m<$num; $m++)
{
  $nr_etap = $m+1;
  $etap = new Etap();
  $etap->setNrEtapu($nr_etap);
  $etap->setOpis($tab2[$m]);

  $etap->setZdjecie($tab4[$m]);

  $etap->setPrzepis($przepis);
  if($etap->save()){
    echo ' Dodano etap nr'.$etap->getNrEtapu($nr_etap).'</br>';
    echo $etap->getOpis().'</br>';
    echo ' ZDJECIE do etapu nr: '.$etap->getNrEtapu($nr_etap).'</br>';
  }
  $nr_etap++;
}

echo '<script type="text/javascript">
  window.location = "wyswietl_przepis.php?przepisID='.$id_przepis.'";
</script>'


 ?>
