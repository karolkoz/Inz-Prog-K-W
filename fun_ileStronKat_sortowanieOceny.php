<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje liczace ilosc stron do paginacji (gdy ustawione sa kategorie) - 'sortowanie po ocenach'

function ileStronKategoria_sortOceny()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + sortowaniu po 'oceny'
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
             //->orderBy('Przepis.Nazwa')
             ->where('Przepis.Status = ?', 1)
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
 else
 {
   $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          //->orderBy('Przepis.Nazwa')
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

/////////////////////////////////////////////////ILE STRON  KATEGORIA+CZAS + sort oceny/////////////////////////////////////////

function ileStronKategoriaCzas_sortOceny()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + czas + sort oceny
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
 else
 {
   $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          //->orderBy('Przepis.Nazwa')
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




// //////////////////////////////////////////////////ILE STRON KATEGORIA + NAZWA + sort oceny//////////////////////////////////////////////////

function ileStronKategoriaNazwa_sortOceny()  //liczy ile stron bedzie po paginacji dla ustawionej kategorii + nazwy + sortowaniu po oceny
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
 else
 {
   $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          //->orderBy('Przepis.Nazwa')
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









// //////////////////////////////////////////////////ILE STRON KATEGORIA + CZAS + NAZWA + sort oceny//////////////////////////////////////////////////

function ileStronKategoriaCzasNazwa_sortOceny()  //liczy ile stron bedzie po paginacji dla ustawionej kategori+czasu+nazwy+sort oceny
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
             ->where('Przepis.Status = ?', 1)
             //->orderBy('Przepis.Nazwa')
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
 else
 {
   $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
          ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          //->orderBy('Przepis.Nazwa')
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
