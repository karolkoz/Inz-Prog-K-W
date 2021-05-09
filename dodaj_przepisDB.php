<?php
include 'session.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';
// use Propel\Runtime\ActiveQuery\Criteria;

$nazwa = $_POST['nazwa'];
$trudnosc = $_POST['trudnosc'];
$czas_przygotowania = $_POST['czas_przygotowania'];
$ile_osob = $_POST['ile_osob'];
$opis = $_POST['opis'];
$data=date("Y-m-d");
$status = 1;
//$UZYTKOWNIK_login = $_SESSION['name'];
//$UZYTKOWNIK_login = "dummy123";


/////////////////dodawanie do tabeli przepis/////////////////////////////
$przepis = new Przepis();


$image = $_FILES['image']['tmp_name'];
$image_length = strlen($image);
// $img = file_get_contents($image);

$przepis->setNazwa($nazwa);
$przepis->setStopienTrudnosci($trudnosc);
$przepis->setCzasPrzygotowania($czas_przygotowania);
$przepis->setDlaIluOsob($ile_osob);
$przepis->setOpis($opis);
$przepis->setDataDodania($data);
$przepis->setStatus($status);

// $przepis->setZdjecieOgolne($img);

if ($image_length!==0){
  $img = file_get_contents($image);
  $przepis->setZdjecieOgolne($img);
}
else{
  $przepis->setZdjecieOgolne(null);
}

$UZYTKOWNIK_login = $_SESSION['login'];
//echo ' login: '.$UZYTKOWNIK_login.' ';

$przepis->setUzytkownikLogin("$UZYTKOWNIK_login");


if($przepis->save())
{
    echo ' Dodano przepis o id: '.$przepis->getIdPrzepis().'</br>';
    $idPrzepisu=$przepis->getIdPrzepis();
}
// $fp= $przepis->getZdjecieOgolne();
// echo ' przeslane zdjecie to: </br>';
// echo '<img class="content__recipe__image" src="data:image/jpg;charset=utf8;base64,'.base64_encode(stream_get_contents($fp)).'" />';


/////////////////////dodawanie do tabeli skladniki i zawiera ////////////////////////////
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
  // echo " Wstawiono do tabaeli zawiera! ";
}



  ///////////////////////////////////////dodawanie etapów


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
  }//mam tablice tab2 o elementach z tablicy $_POST['etap'] czyli opis etapu
  //np. dla 3 etapow tablica ma 4 elementy




$tab4=[];
$p=0;
// if (isset($_FILES['etap']))

foreach($_FILES['etap']['tmp_name'] as $key)
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



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $m=0;
  for($m=0; $m<$num; $m++)
  {
    $etap = new Etap();
    $etap->setNrEtapu($nr_etap);
    $etap->setOpis($tab2[$m]);
    $etap->setZdjecie($tab4[$m]);


    $etap->setPrzepis($przepis);
    if($etap->save()){
      echo ' Dodano etap ';
      echo $etap->getOpis().'</br>';
      echo ' ZDJECIE do etapu nr: '.$etap->getNrEtapu($nr_etap).'</br>';
      // $fp2 = $etap->getZdjecie();
      // echo '<img class="content__recipe__image" src="data:image/jpg;charset=utf8;base64,'.base64_encode(stream_get_contents($fp2)).'" />';
    }

    $nr_etap++;
  }


  //////////////////////////////////////////dodawanie kategorii

  foreach ($_POST['categories'] as $name_categories)
  {
    $nalez = new Nalezy();
    $nalez->setPrzepis($przepis);
    $nalez->setKategoriaNazwa($name_categories);
    $nalez->save();
    // echo "  dodano kategorię ";
  }

  echo '<script type="text/javascript">
    window.location = "wyswietl_przepis.php?przepisID='.$idPrzepisu.'";
</script>'

?>
