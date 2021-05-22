<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje do przekazywania numerow id przy danym filtrowaniu - 'sortowanie po nazwie'

/////////////////////////////////////////////KATEGORIA TAK + CZAS NIE + NAZWA NIE + sort po nazwie///////////////////////////////////////////

function przepisy_ID_Kategoria_sortNazwa($y)
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
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

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
           ->orderBy('Przepis.Nazwa')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 6);

    return $kat;
  }

}








///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA NIE + sort nazwa////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaCzas_sortCzas($y)
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
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

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
           ->orderBy('Przepis.Nazwa')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 6);

    return $kat;
  }

}



// ///////////////////////////////////////KATEGORIA TAK + CZAS nie + NAZWA tak////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaNazwa_sortNazwa($y)
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
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

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
           ->orderBy('Przepis.Nazwa')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 6);

    return $kat;
  }

}




// ///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA TAK + sort nazwa////////////////////////////////////

function przepisy_ID_KategoriaCzasNazwa_sortNazwa($y)
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
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.Nazwa')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

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
           ->orderBy('Przepis.Nazwa')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 6);

    return $kat;
  }

}





?>
