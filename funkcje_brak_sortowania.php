<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje do przekazywania numerow id przy danym filtrowaniu - 'brak sortowania'

/////////////////////////////////////////////KATEGORIA TAK + CZAS NIE + NAZWA NIE///////////////////////////////////////////

function przepisy_ID_Kategoria($y)
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
    if($tab[0]=='Dowolne')
    {
       $kat = PrzepisQuery::create()
              ->select(array('Przepis.IdPrzepis'))
              ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
    else{
       $kat = NalezyQuery::create()
              ->join('Przepis')
              ->join('Kategoria')
              //->where('Kategoria.Nazwa = ?', $tab[0])
              ->where('Kategoria.Nazwa IN ?', $tab)
              ->select(array('Przepis.IdPrzepis'))
              ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
  }
  else
  {
    $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
           ->join('Przepis')
           ->join('Kategoria')
           ->select(array('Przepis.IdPrzepis'))
           ->where('Kategoria.Nazwa IN ?', $tab)
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 5);

    return $kat;
  }

}








///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA NIE////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaCzas($y)
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
  }
  else
  {
    $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
           ->join('Przepis')
           ->join('Kategoria')
           ->select(array('Przepis.IdPrzepis'))
           ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
           ->where('Kategoria.Nazwa IN ?', $tab)
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 5);

    return $kat;
  }

}



///////////////////////////////////////KATEGORIA TAK + CZAS nie + NAZWA tak////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaNazwa($y)
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
  }
  else
  {
    $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
           ->join('Przepis')
           ->join('Kategoria')
           ->select(array('Przepis.IdPrzepis'))
           ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
           ->where('Kategoria.Nazwa IN ?', $tab)
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 5);

    return $kat;
  }

}




///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA TAK////////////////////////////////////

function przepisy_ID_KategoriaCzasNazwa($y)
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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 5);

      return $kat;
    }
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
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 5);

    return $kat;
  }

}





?>
