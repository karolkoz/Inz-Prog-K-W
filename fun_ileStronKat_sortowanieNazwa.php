<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje liczace ilosc stron do paginacji (gdy ustawione sa kategorie) - 'sortowanie po nazwie'

function ileStronKategoria_sortNazwa()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + sortowaniu po 'nazwa'
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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

/////////////////////////////////////////////////ILE STRON  KATEGORIA+CZAS + sort nazwa/////////////////////////////////////////

function ileStronKategoriaCzas_sortNazwa()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + czas + sort nazwa
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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




// //////////////////////////////////////////////////ILE STRON KATEGORIA + NAZWA + sort nazwa//////////////////////////////////////////////////

function ileStronKategoriaNazwa_sortNazwa()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + nazwy + sortowaniu po nazwie
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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









// //////////////////////////////////////////////////ILE STRON KATEGORIA + CZAS + NAZWA + sort nazwa//////////////////////////////////////////////////

function ileStronKategoriaCzasNazwa_sortNazwa()  //liczy ile stron bedzie po paginacji dla ustawionej kategori+czasu+nazwy+sort nazwa
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
        ->orderBy('Przepis.Nazwa')
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
