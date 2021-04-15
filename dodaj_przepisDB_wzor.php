<?php
require_once "connect.php";

$nazwa = $_POST['nazwa'];
$trudnosc = $_POST['trudnosc'];
$czas_przygotowania = $_POST['czas_przygotowania'];
$ile_osob = $_POST['ile_osob'];
$opis = $_POST['opis'];
$data=date("Y-m-d");
$status = 1;
$UZYTKOWNIK_login = "dummy123";
// 1 - zaakceptowany przepis

// $skladniki_nazwa = $_POST['skladnik_nazwa'];
// $zawiera_ilosc = $_POST['skladnik_ilosc'];

$numFieldsNazwa = count($_POST['skladnik_nazwa']); //ilosc dodanych nazw skladnikow
// $numFieldsIlosc = count($_POST['skladnik_ilosc']); //ilosc dodanych ilosci do skladnikow (?)




$link = new mysqli($host, $db_user, $db_password, $db_name);
$link->query("SET NAMES 'utf8'");

if($link->connect_errno!=0)
{
   echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
}
else
{
#$login = $_POST['login'];
#$haslo = $_POST['haslo'];

 echo "Połączono z bazą!";

// dodajemy rekord do bazy

    // $photo = $_FILES['image']['tmp_name'];

    $ins = @mysqli_query($link, "INSERT INTO przepis SET nazwa='$nazwa', stopien_trudnosci='$trudnosc', czas_przygotowania='$czas_przygotowania', dla_ilu_osob='$ile_osob', opis='$opis', data_dodania='$data', status='$status', UZYTKOWNIK_login='$UZYTKOWNIK_login'");

    if($ins) echo " Rekord został dodany poprawnie do tabeli przepisy, jego id to: ".mysqli_insert_id($link);
    else echo " Błąd nie udało się dodać nowego rekordu";

    $last_przepis_id = mysqli_insert_id($link); //id przepisu dodanego wyzej


///////////////////////dodawanie skladnikow do tabeli skladniki oraz wypelnianie tabeli 'zawiera'

$tab=[];
$i=0;
foreach($_POST['skladnik_ilosc'] as $val)
{
  $tab[$i]=$val;
  $i++;
} //mam tablice tab o elementach z tablicy $_POST['skladnik_ilosc']


  $j=0;
  foreach ($_POST['skladnik_nazwa'] as $value)
  {
    $insSkladnik = @mysqli_query($link, "INSERT INTO skladniki SET nazwa='$value'");
    $last_skladnik_id = mysqli_insert_id($link); //id skladnika dodanego powyzej
    $insZawiera = @mysqli_query($link, "INSERT INTO zawiera SET PRZEPIS_id_przepis='$last_przepis_id',  SKLADNIKI_id_skladnik='$last_skladnik_id', ilosc='$tab[$j]'");
    $j++;
    echo "Udało się wstawić skladnik! ";
  }

///////////////////////////////////////dodawanie etapów
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


if($num==2)
{
  $insEtap = @mysqli_query($link, "INSERT INTO etap SET nr_etapu='$nr_etap', opis='$tab2[0]', PRZEPIS_id_przepis='$last_przepis_id'");
}

$n=2;
if($num>2)
{
  $insEtap = @mysqli_query($link, "INSERT INTO etap SET nr_etapu='$nr_etap', opis='$tab2[0]', PRZEPIS_id_przepis='$last_przepis_id'");
  $nr_etap++;
  for($m=2; $m<$num; $m++)
  {
    $insEtap = @mysqli_query($link, "INSERT INTO etap SET nr_etapu='$nr_etap', opis='$tab2[$n]', PRZEPIS_id_przepis='$last_przepis_id'");
    $n++;
    $nr_etap++;
  }
}


//////////////////////////////////////////dodawanie kategorii

foreach ($_POST['categories'] as $name_categories)
{
  $insNalezy = @mysqli_query($link, "INSERT INTO nalezy SET PRZEPIS_id_przepis='$last_przepis_id', KATEGORIA_nazwa='$name_categories'");
  echo "  dodano kategorię ";
}



}

 $link->close();


?>
