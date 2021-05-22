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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->orderBy('Przepis.CzasPrzygotowania')
             ->select(array('Przepis.IdPrzepis'))
             ->paginate($page = $y, $rowsPerPage = 6);

      return $kat;
    }
    else{
      $kat = NalezyQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->orderBy('Przepis.CzasPrzygotowania')
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
           ->orderBy('Przepis.CzasPrzygotowania')
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 6);

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
    if($tab[0]=='Dowolne')
    {
      $kat = PrzepisQuery::create() //pobierane jest ID przepisu który nalezy do zadanej kategorii
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->orderBy('Przepis.CzasPrzygotowania' )
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
             ->orderBy('Przepis.CzasPrzygotowania' )
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
           ->orderBy('Przepis.CzasPrzygotowania' )
           ->groupBy(array('Przepis.IdPrzepis'))
           ->having("count(Przepis.IdPrzepis) = ?", $ileKat)
           ->paginate($page = $y, $rowsPerPage = 6);

    return $kat;
  }

}

?>
