<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje liczace ilosc stron do paginacji (gdy ustawione sa kategorie) - 'sortowanie po nazwie'

function ileStronKategoria_sortNazwa()
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->orderBy('Przepis.Nazwa')
             ->where('Przepis.Status = ?', 1)
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
    }

  $ileStron = ceil($x / 10);
  return $ileStron;
 }
 else
 {
   $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          ->orderBy('Przepis.Nazwa')
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

          $x=0;
          foreach($kat as $k)
          {
            $x++;
          }

   $ileStron = ceil($x / 10);
   return $ileStron;
 }

}

/////////////////////////////////////////////////ILE STRON  KATEGORIA+CZAS + sort nazwa/////////////////////////////////////////

function ileStronKategoriaCzas_sortNazwa()
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
    }

  $ileStron = ceil($x / 10);
  return $ileStron;
 }
 else
 {
   $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          ->orderBy('Przepis.Nazwa')
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

          $x=0;
          foreach($kat as $k)
          {
            $x++;
          }

   $ileStron = ceil($x / 10);
   return $ileStron;
 }

}




// //////////////////////////////////////////////////ILE STRON KATEGORIA + NAZWA + sort nazwa//////////////////////////////////////////////////

function ileStronKategoriaNazwa_sortNazwa()
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
    }

  $ileStron = ceil($x / 10);
  return $ileStron;
 }
 else
 {
   $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          ->orderBy('Przepis.Nazwa')
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

          $x=0;
          foreach($kat as $k)
          {
            $x++;
          }

   $ileStron = ceil($x / 10);
   return $ileStron;
 }

}









// //////////////////////////////////////////////////ILE STRON KATEGORIA + CZAS + NAZWA + sort nazwa//////////////////////////////////////////////////

function ileStronKategoriaCzasNazwa_sortNazwa()
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

             $x=0;
             foreach($kat as $k)
             {
               $x++;
             }
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->where('Przepis.Status = ?', 1)
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'));

           $x=0;
           foreach($kat as $k)
           {
             $x++;
           }
    }

  $ileStron = ceil($x / 10);
  return $ileStron;
 }
 else
 {
   $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
          ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->where('Przepis.Status = ?', 1)
          ->orderBy('Przepis.Nazwa')
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

          $x=0;
          foreach($kat as $k)
          {
            $x++;
          }

   $ileStron = ceil($x / 10);
   return $ileStron;
 }

}


?>
