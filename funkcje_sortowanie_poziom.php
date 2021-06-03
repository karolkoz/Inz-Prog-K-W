<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje do przekazywania numerow id przy danym filtrowaniu - 'sortowanie po poziomie'

/////////////////////////////////////////////KATEGORIA TAK + CZAS NIE + NAZWA NIE +sort poziom///////////////////////////////////////////

function przepisy_ID_Kategoria_sortPoziom($y)
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
  }
  else
  {
    $kat = NalezyQuery::create()
           ->join('Przepis')
           ->join('Kategoria')
           ->select(array('Przepis.IdPrzepis'))
           ->where('Kategoria.Nazwa IN ?', $tab)
           ->orderBy('Przepis.StopienTrudnosci')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 10);

    return $kat;
  }

}








///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA NIE + sort poziom////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaCzas_sortPoziom($y)
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
  }
  else
  {
    $kat = NalezyQuery::create()
           ->join('Przepis')
           ->join('Kategoria')
           ->select(array('Przepis.IdPrzepis'))
           ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
           ->where('Kategoria.Nazwa IN ?', $tab)
           ->orderBy('Przepis.StopienTrudnosci')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 10);

    return $kat;
  }

}



// ///////////////////////////////////////KATEGORIA TAK + CZAS nie + NAZWA tak + sort poziom////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaNazwa_sortPoziom($y)
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
  }
  else
  {
    $kat = NalezyQuery::create()
           ->join('Przepis')
           ->join('Kategoria')
           ->select(array('Przepis.IdPrzepis'))
           ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
           ->where('Kategoria.Nazwa IN ?', $tab)
           ->orderBy('Przepis.StopienTrudnosci')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 10);

    return $kat;
  }

}




// ///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA TAK +sort poziom////////////////////////////////////

function przepisy_ID_KategoriaCzasNazwa_sortPoziom($y)
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

  $ileKat = count($tab);


  if($ileKat == 1){
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create()
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.StopienTrudnosci')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 10);

      return $kat;
    }
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
           ->orderBy('Przepis.StopienTrudnosci')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 10);

    return $kat;
  }

}





?>
