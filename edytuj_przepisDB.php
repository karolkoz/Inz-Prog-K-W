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


$id_przepis = 14;
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
} //mam tablice tab o elementach z tablicy $_POST['skladnik_ilosc']


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
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli ETAP dla przepisu o ID: '.$przepis->getIdPrzepis().'</br>';



$num = count($_POST['etap']); //ilosc dodanych opisow etapow
echo ' ILOSC ETAPOW: '.$num.'</br>';

$nr_etap=1; //zaczynamy od etapu nr 1, bedziemy zwiekszac $nr_etap++ przy dodawaniu kolejnych etapow


$tab2=[];
$k=0;
foreach($_POST['etap'] as $val_opis)
{
  $tab2[$k]=$val_opis;
  // echo $val_opis.'</br>';
  $k++;
}




$tab4=[];
$p=0;
foreach($_FILES['etap_image']['tmp_name'] as $key)
{
$key_length=strlen($key); //dlugosc nazwy pliku zdjecia

//jesli przekazywany plik ma nazwe > 0 (czyli istnieje) to dodajemy do bazy ten plik
//gdy dl nazwy == 0 to znak, ze pliku brak, wiec do bazy wstawiamy null

if ($key_length!==0){
  $tab4[$p]=file_get_contents($key);
  // $p++;
}
else{
    $tab4[$p]=null;
}
$p++;
}



$m=0;
for($m=0; $m<$num; $m++)
{
  $etap = new Etap();
  $etap->setNrEtapu($nr_etap);
  $etap->setOpis($tab2[$m]);
  $etap->setZdjecie($tab4[$m]);


  $etap->setPrzepis($przepis);
  if($etap->save()){
    echo ' Dodano etap nr'.$etap->getNrEtapu($nr_etap).'</br>';
    echo $etap->getOpis().'</br>';
    echo ' ZDJECIE do etapu nr: '.$etap->getNrEtapu($nr_etap).'</br>';

    // echo ' Dodano etap ';
    // echo $etap->getOpis().'</br>';
    // echo ' ZDJECIE do etapu nr: '.$etap->getNrEtapu($nr_etap).'</br>';
    // $fp2 = $etap->getZdjecie();
    // echo '<img class="content__recipe__image" src="data:image/jpg;charset=utf8;base64,'.base64_encode(stream_get_contents($fp2)).'" />';
  }
  $nr_etap++;
}






// $num = count($_POST['etap']); //ilosc dodanych opisow etapow
// echo ' ILOSC ETAPOW: '.$num.'</br>';
//
// $nr_etap=1; //zaczynamy od etapu nr 1, bedziemy zwiekszac $nr_etap++ przy dodawaniu kolejnych etapow
//
//
// $tab2=[];
// $k=0;
// foreach($_POST['etap'] as $val_opis)
// {
//   $tab2[$k]=$val_opis;
//   echo '</br>wstawiam do tab2: '.$tab2[$k].' pod indeks: '.$k.'</br>';
//   $k++;
// }//mam tablice tab2 o elementach z tablicy $_POST['etap'] czyli opis etapu
// //np. dla 3 etapow tablica ma 4 elementy
//
//
//
//
// $tab4=[];
// $p=0;
// // if (isset($_FILES['etap']))
//
//
//
// foreach($_FILES['etap_image']['tmp_name'] as $key)
// {
// $key_length=strlen($key); //dlugosc nazwy pliku zdjecia
//
// //jesli przekazywany plik ma nazwe > 0 (czyli istnieje) to dodajemy do bazy ten plik
// //gdy dl nazwy == 0 to znak, ze pliku brak, wiec do bazy wstawiamy null
//
// if ($key_length!==0){
//   $tab4[$p]=file_get_contents($key);
//   // $p++;
// }
// else{
//     $tab4[$p]=null;
// }
// $p++;
// }
//
// // //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
// // $m=0;
// // while($m<$num)
// // {
// //   $etap = new Etap();
// //   $etap->setNrEtapu($nr_etap);
// //   $etap->setOpis($tab2[$m]);
// //   //$etap->setZdjecie($tab4[$m]);
// //
// //
// //   $etap->setPrzepis($przepis);
// //   if($etap->save()){
// //     echo ' Dodano etap nr'.$etap->getNrEtapu($nr_etap).'</br>';
// //     echo $etap->getOpis().'</br>';
// //     echo ' ZDJECIE do etapu nr: '.$etap->getNrEtapu($nr_etap).'</br>';
// //     // $fp2 = $etap->getZdjecie();
// //     // echo '<img class="content__recipe__image" src="data:image/jpg;charset=utf8;base64,'.base64_encode(stream_get_contents($fp2)).'" />';
// //   }
// //   $m++;
// //   $m++;
// //   $nr_etap++;
// // }

 ?>
