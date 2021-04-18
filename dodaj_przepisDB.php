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

$przepis->setNazwa($nazwa);
$przepis->setStopienTrudnosci($trudnosc);
$przepis->setCzasPrzygotowania($czas_przygotowania);
$przepis->setDlaIluOsob($ile_osob);
$przepis->setOpis($opis);
$przepis->setDataDodania($data);
$przepis->setStatus($status);
$przepis->setZdjecieOgolne(".\$nazwa_zdjecie");//dodawanie obrazka ogolnego////////////////
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
  }//mam tablice tab2 o elementach z tablicy $_POST['etap'] czyli opis etapu
  //np. dla 3 etapow tablica ma 4 elementy

$tab3=[];
$j=0;
foreach($_POST['etap'] as $val_zdj)
{
  $tab3[$j]=$val_zdj;
  $j++;
}

  if($num==2)
  {
    $etap = new Etap();
    $etap->setNrEtapu($nr_etap);
    $etap->setOpis($tab2[0]);
    $etap->setZdjecie(".\$tab3[0]");
    $etap->setPrzepis($przepis);
    $etap->save();

  }

  $n=2;
  if($num>2)
  {
    $etap = new Etap();
    $etap->setNrEtapu($nr_etap);
    $etap->setOpis($tab2[0]);
    $etap->setZdjecie(".\$tab3[0]");
    $etap->setPrzepis($przepis);
    $etap->save();

    $nr_etap++;
    for($m=2; $m<$num; $m++)
    {
      $etap = new Etap();
      $etap->setNrEtapu($nr_etap);
      $etap->setOpis($tab2[$n]);
      $etap->setZdjecie(".\$tab3[$n]");
      $etap->setPrzepis($przepis);
      $etap->save();
      $n++;
      $nr_etap++;
    }
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
