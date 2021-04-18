<?php
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
$UZYTKOWNIK_login = "dummy123";


/////////////////dodawanie do tabeli przepis/////////////////////////////
$przepis = new Przepis();

$nazwa_zdjecie = $_POST['image'];

echo 'NAZWA ZDJ OGOLNE:  '.$nazwa_zdjecie;
print gettype($nazwa_zdjecie);

$przepis->setNazwa($nazwa);
$przepis->setStopienTrudnosci($trudnosc);
$przepis->setCzasPrzygotowania($czas_przygotowania);
$przepis->setDlaIluOsob($ile_osob);
$przepis->setOpis($opis);
$przepis->setDataDodania($data);
$przepis->setStatus($status);
$przepis->setZdjecieOgolne($nazwa_zdjecie);
$przepis->setUzytkownikLogin($UZYTKOWNIK_login);

if($przepis->save())
{
    echo 'Dodano przepis o id: '.$przepis->getIdPrzepis();
    $idPrzepisu=$przepis->getIdPrzepis();
}



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



  ///////////////////////////////////////dodawanie etapów////////////////////////
  $num = count($_POST['etap']); //ilosc dodanych opisow etapow

  $nr_etap=1; //zaczynamy od etapu nr 1, bedziemy zwiekszac $nr_etap++ przy dodawaniu kolejnych etapow


  $tab2=[];
  $k=0;
  foreach($_POST['etap'] as $val_opis)
  {
    $tab2[$k]=$val_opis;
    $k++;
    echo $val_opis.'</br>';
  }//mam tablice tab2 o elementach z tablicy $_POST['etap'] czyli opis etapu
  //np. dla 3 etapow tablica ma 4 elementy

$tab3=[];
$p=0;
foreach($_POST['etap_image'] as $val_zdj)
{
  $tab3[$p]=$val_zdj;
  $p++;
  // echo 'PRZESLANE ZDJECIA ETAPOW: '.$val_zdj.'</br>';
  // print gettype($val_zdj);
}



  $m=0;
  for($m=0; $m<$num; $m++)
  {
    $etap = new Etap();
    $etap->setNrEtapu($nr_etap);
    // echo $etap->getNrEtapu().'</br>';
    $etap->setOpis($tab2[$m]);
    // echo $etap->getOpis().'</br>';
    $etap->setZdjecie($tab3[$m]);
    // echo $etap->getZdjecie().'</br>';
    $etap->setPrzepis($przepis);
    // echo $etap->getPrzepis().'</br>';
    $etap->save();

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

?>
