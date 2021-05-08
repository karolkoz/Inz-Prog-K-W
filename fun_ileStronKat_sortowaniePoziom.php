<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje liczace ilosc stron do paginacji (gdy ustawione sa kategorie) - 'portowanie po poziomie'

function ileStronKategoria_sortPoziom()  //liczy ile stron bedzie po paginacji dla ustawionej  kategorii + sortowaniu po poziomie
{
  $tab=[];
  $y=0;
  if (isset($_COOKIE['kategoria'])) {
      foreach ($_COOKIE['kategoria'] as $name => $value) {
          $name = htmlspecialchars($name);
          $value = htmlspecialchars($value);
          $tab[$y] = $value;
          $y++;
      }
  }

  $ileKat = count($tab);  //liczymy ile kategorii jest przekazanych


  if($ileKat == 1){
    //echo '</br> jestem w ileKat==1</br>';
  $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
         ->join('Przepis')
         ->join('Kategoria')
         ->where('Kategoria.Nazwa = ?', $tab[0])
         ->orderBy('Przepis.StopienTrudnosci')
         ->select(array('Przepis.IdPrzepis'));

         $x=0;
         foreach($kat as $k)
         {
           $x++;
         }

  $ileStron = ceil($x / 5);
  return $ileStron;
 }
 else if($ileKat == 2){
   //echo '</br> jestem w ileKat==2</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 3){
   //echo '</br> jestem w ileKat==3</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 4){
   //echo '</br> jestem w ileKat==4</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 5){
   //echo '</br> jestem w ileKat==5</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 6){
   //echo '</br> jestem w ileKat==6</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 7){
   //echo '</br> jestem w ileKat==7</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 8){
   //echo '</br> jestem w ileKat==8</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 9){
   //echo '</br> jestem w ileKat==9</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 10){
   //echo '</br> jestem w ileKat==10</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 11){
   //echo '</br> jestem w ileKat==11</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 12){
   //echo '</br> jestem w ileKat==12</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10],$tab[11]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
}

/////////////////////////////////////////////////ILE STRON  KATEGORIA+CZAS+sort poziom/////////////////////////////////////////

function ileStronKategoriaCzas_sortPoziom()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + czas +sort poziom
{
  $tab=[];
  $y=0;
  if (isset($_COOKIE['kategoria'])) {
      foreach ($_COOKIE['kategoria'] as $name => $value) {
          $name = htmlspecialchars($name);
          $value = htmlspecialchars($value);
          $tab[$y] = $value;
          $y++;
      }
  }

  $ileKat = count($tab);  //liczymy ile kategorii jest przekazanych


  if($ileKat == 1){
    //echo '</br> jestem w ileKat==1</br>';
  $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
         ->join('Przepis')
         ->join('Kategoria')
         ->where('Kategoria.Nazwa = ?', $tab[0])
         ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
         ->orderBy('Przepis.StopienTrudnosci')
         ->select(array('Przepis.IdPrzepis'));

         $x=0;
         foreach($kat as $k)
         {
           $x++;
         }

  $ileStron = ceil($x / 5);
  return $ileStron;
 }
 else if($ileKat == 2){
   //echo '</br> jestem w ileKat==2</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 3){
   //echo '</br> jestem w ileKat==3</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 4){
   //echo '</br> jestem w ileKat==4</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 5){
   //echo '</br> jestem w ileKat==5</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 6){
   //echo '</br> jestem w ileKat==6</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 7){
   //echo '</br> jestem w ileKat==7</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 8){
   //echo '</br> jestem w ileKat==8</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 9){
   //echo '</br> jestem w ileKat==9</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 10){
   //echo '</br> jestem w ileKat==10</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 11){
   //echo '</br> jestem w ileKat==11</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 12){
   //echo '</br> jestem w ileKat==12</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10],$tab[11]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
}




// //////////////////////////////////////////////////ILE STRON KATEGORIA + NAZWA +sort poziom//////////////////////////////////////////////////

function ileStronKategoriaNazwa_sortPoziom()  //liczy ile stron bedzie po paginacji dla ustawionej samej kategorii + sort poziom
{
  $tab=[];
  $y=0;
  if (isset($_COOKIE['kategoria'])) {
      foreach ($_COOKIE['kategoria'] as $name => $value) {
          $name = htmlspecialchars($name);
          $value = htmlspecialchars($value);
          $tab[$y] = $value;
          $y++;
      }
  }

  $ileKat = count($tab);  //liczymy ile kategorii jest przekazanych


  if($ileKat == 1){
    //echo '</br> jestem w ileKat==1</br>';
  $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
         ->join('Przepis')
         ->join('Kategoria')
         ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
         ->where('Kategoria.Nazwa = ?', $tab[0])
         ->orderBy('Przepis.StopienTrudnosci')
         ->select(array('Przepis.IdPrzepis'));

         $x=0;
         foreach($kat as $k)
         {
           $x++;
         }

  $ileStron = ceil($x / 5);
  return $ileStron;
 }
 else if($ileKat == 2){
   //echo '</br> jestem w ileKat==2</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 3){
   //echo '</br> jestem w ileKat==3</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 4){
   //echo '</br> jestem w ileKat==4</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 5){
   //echo '</br> jestem w ileKat==5</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 6){
   //echo '</br> jestem w ileKat==6</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 7){
   //echo '</br> jestem w ileKat==7</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 8){
   //echo '</br> jestem w ileKat==8</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 9){
   //echo '</br> jestem w ileKat==9</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 10){
   //echo '</br> jestem w ileKat==10</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 11){
   //echo '</br> jestem w ileKat==11</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 12){
   //echo '</br> jestem w ileKat==12</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10],$tab[11]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
}









// //////////////////////////////////////////////////ILE STRON KATEGORIA + CZAS + NAZWA + sort poziom//////////////////////////////////////////////////

function ileStronKategoriaCzasNazwa_sortPoziom()
{
  $tab=[];
  $y=0;
  if (isset($_COOKIE['kategoria'])) {
      foreach ($_COOKIE['kategoria'] as $name => $value) {
          $name = htmlspecialchars($name);
          $value = htmlspecialchars($value);
          $tab[$y] = $value;
          $y++;
      }
  }

  $ileKat = count($tab);  //liczymy ile kategorii jest przekazanych


  if($ileKat == 1){
    //echo '</br> jestem w ileKat==1</br>';
  $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
         ->join('Przepis')
         ->join('Kategoria')
         ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
         ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
         ->where('Kategoria.Nazwa = ?', $tab[0])
         ->orderBy('Przepis.StopienTrudnosci')
         ->select(array('Przepis.IdPrzepis'));

         $x=0;
         foreach($kat as $k)
         {
           $x++;
         }

  $ileStron = ceil($x / 5);
  return $ileStron;
 }
 else if($ileKat == 2){
   //echo '</br> jestem w ileKat==2</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 3){
   //echo '</br> jestem w ileKat==3</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 4){
   //echo '</br> jestem w ileKat==4</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 5){
   //echo '</br> jestem w ileKat==5</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 6){
   //echo '</br> jestem w ileKat==6</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 7){
   //echo '</br> jestem w ileKat==7</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 8){
   //echo '</br> jestem w ileKat==8</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 9){
   //echo '</br> jestem w ileKat==9</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 10){
   //echo '</br> jestem w ileKat==10</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 11){
   //echo '</br> jestem w ileKat==11</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
 else if($ileKat == 12){
   //echo '</br> jestem w ileKat==12</br>';
 $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
        ->join('Przepis')
        ->join('Kategoria')
        ->select(array('Przepis.IdPrzepis'))
        ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
        ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
        ->where('Kategoria.Nazwa IN ?', array($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6],$tab[7],$tab[8],$tab[9],$tab[10],$tab[11]))
        ->orderBy('Przepis.StopienTrudnosci')
        ->groupBy(array('Przepis.IdPrzepis'))
        ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

        $x=0;
        foreach($kat as $k)
        {
          $x++;
        }

 $ileStron = ceil($x / 5);
 return $ileStron;
 }
}


?>
