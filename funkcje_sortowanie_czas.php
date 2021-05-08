<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje do przekazywania numerow id przy danym filtrowaniu - 'sortowanie po czasie'

/////////////////////////////////////////////KATEGORIA TAK + CZAS NIE + NAZWA NIE///////////////////////////////////////////

function przepisy_ID_Kategoria_sortCzas($y)
{
  $tab=[];
  $xy=0;
  if (isset($_COOKIE['kategoria'])) {
      foreach ($_COOKIE['kategoria'] as $name => $value) {
          $name = htmlspecialchars($name);
          $value = htmlspecialchars($value);
          $tab[$xy] = $value;
          $xy++;
      }
  }

  $ileKat = count($tab);  //liczymy ile kategorii jest przekazanych


  if($ileKat == 1){
    //echo '</br>ileKat==1</br>';
  $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
         ->join('Przepis')
         ->join('Kategoria')
         ->where('Kategoria.Nazwa = ?', $tab[0])
         ->orderBy('Przepis.CzasPrzygotowania')
         ->select(array('Przepis.IdPrzepis'))
         ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 2){
  // echo '</br>ileKat==2</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 3){
   //echo '</br>ileKat==3</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 4){
   //echo '</br>ileKat=4</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 5){
   //echo '</br>ileKat=5</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 6){
   //echo '</br>ileKat=6</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 7){
   //echo '</br>ileKat==7</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 8){
   //echo '</br>ileKat==8</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 9){
   //echo '</br>ileKat==9</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 10){
   //echo '</br>ileKat==10</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 11){
   //echo '</br>ileKat==11</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 12){
  // echo '</br>ileKat==12</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10],$tab[11]))
        ->orderBy('Przepis.CzasPrzygotowania')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
}




// ///////////////////////////////////////KATEGORIA TAK + CZAS nie + NAZWA tak////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaNazwa_sortCzas($y)
{
  $tab=[];
  $xy=0;
  if (isset($_COOKIE['kategoria'])) {
      foreach ($_COOKIE['kategoria'] as $name => $value) {
          $name = htmlspecialchars($name);
          $value = htmlspecialchars($value);
          $tab[$xy] = $value;
          $xy++;
      }
  }

  $ileKat = count($tab);  //liczymy ile kategorii jest przekazanych


  if($ileKat == 1){
    //echo '</br>ileKat==1</br>';
  $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
         ->join('Przepis')
         ->join('Kategoria')
         ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
         ->where('Kategoria.Nazwa = ?', $tab[0])
         ->orderBy('Przepis.CzasPrzygotowania' )
         ->select(array('Przepis.IdPrzepis'))
         ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 2){
  // echo '</br>ileKat==2</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 3){
   //echo '</br>ileKat==3</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 4){
   //echo '</br>ileKat=4</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 5){
   //echo '</br>ileKat=5</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 6){
   //echo '</br>ileKat=6</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 7){
   //echo '</br>ileKat==7</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 8){
   //echo '</br>ileKat==8</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 9){
   //echo '</br>ileKat==9</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 10){
   //echo '</br>ileKat==10</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 11){
   //echo '</br>ileKat==11</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
 else if($ileKat == 12){
  // echo '</br>ileKat==12</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10],$tab[11]))
        ->orderBy('Przepis.CzasPrzygotowania' )
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
        ->paginate($page = $y, $rowsPerPage = 5);

 return $kat;
 }
}

?>
