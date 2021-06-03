<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//funkcje do przekazywania numerow id przy danym filtrowaniu - 'sortowanie po ocenach'

/////////////////////////////////////////////KATEGORIA TAK + CZAS NIE + NAZWA NIE + sort po ocenach///////////////////////////////////////////

function przepisy_ID_Kategoria_sortOceny($y)
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
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

                    $num=0;
                    $tab1=[];

                    foreach($kat as $ID2)
                    {
                      $IDprzepisu = $ID2->getIdPrzepis();
                      $tab1[$num]=$IDprzepisu;
                      $num++;
                    }

      return $tab1;
    }
    else{

      $przepisyID2 = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc');

      $num=0;
      $tab1=[];

      foreach($przepisyID2 as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tab1[$num]=$IDprzepisu;
        $num++;
      }

      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'));

             $num2=0;
             $tab2=[];

             foreach($kat as $k)
             {
               $tab2[$num2]=$k;
               $num2++;
             }

      $ileTab2=count($tab2);

      $tabWynik=[];
      $numWynik=0;
      foreach($tab1 as $t)
      {
        for($i=0; $i<$ileTab2; $i++)
        {
          if($t==$tab2[$i])
          {
            $tabWynik[$numWynik]=$t;
            $numWynik++;
          }
        }
      }


      $wyniki = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

      $numW=0;
      $tabW=[];

      foreach($wyniki as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tabW[$numW]=$IDprzepisu;
        $numW++;
      }


      return $tabW;
    }
  }
  else
  {
          $przepisyID2 = PrzepisQuery::create()
                        ->leftJoinLubie_to('Lubie_to')
                        ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                        ->groupByIdPrzepis()
                        ->orderBy('nb', 'desc');

          $num=0;
          $tab1=[];

          foreach($przepisyID2 as $ID2)
          {
            $IDprzepisu = $ID2->getIdPrzepis();
            $tab1[$num]=$IDprzepisu;
            $num++;
          }

          $kat = NalezyQuery::create()
                ->join('Przepis')
                ->join('Kategoria')
                ->select(array('Przepis.IdPrzepis'))
                ->where('Kategoria.Nazwa IN ?', $tab)
                ->groupBy(array('Przepis.IdPrzepis'))
                ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

                 $num2=0;
                 $tab2=[];

                 foreach($kat as $k)
                 {
                   $tab2[$num2]=$k;
                   $num2++;
                 }

          $ileTab2=count($tab2);

          $tabWynik=[];
          $numWynik=0;
          foreach($tab1 as $t)
          {
            for($i=0; $i<$ileTab2; $i++)
            {
              if($t==$tab2[$i])
              {
                $tabWynik[$numWynik]=$t;
                $numWynik++;
              }
            }
          }


          $wyniki = PrzepisQuery::create()
                        ->leftJoinLubie_to('Lubie_to')
                        ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                        ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                        ->groupByIdPrzepis()
                        ->orderBy('nb', 'desc')
                        ->paginate($page = $y, $rowsPerPage = 10);

          $numW=0;
          $tabW=[];

          foreach($wyniki as $ID2)
          {
            $IDprzepisu = $ID2->getIdPrzepis();
            $tabW[$numW]=$IDprzepisu;
            $numW++;
          }


          return $tabW;
  }

}








///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA NIE + sort oceny////////////////////////////////////////////////////////////////

function przepisy_ID_KategoriaCzas_sortOceny($y)
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
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

                    $num=0;
                    $tab1=[];

                    foreach($kat as $ID2)
                    {
                      $IDprzepisu = $ID2->getIdPrzepis();
                      $tab1[$num]=$IDprzepisu;
                      $num++;
                    }

      return $tab1;
    }
    else{
      $przepisyID2 = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc');

      $num=0;
      $tab1=[];

      foreach($przepisyID2 as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tab1[$num]=$IDprzepisu;
        $num++;
      }

      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'));

             $num2=0;
             $tab2=[];

             foreach($kat as $k)
             {
               $tab2[$num2]=$k;
               $num2++;
             }

      $ileTab2=count($tab2);

      $tabWynik=[];
      $numWynik=0;
      foreach($tab1 as $t)
      {
        for($i=0; $i<$ileTab2; $i++)
        {
          if($t==$tab2[$i])
          {
            $tabWynik[$numWynik]=$t;
            $numWynik++;
          }
        }
      }


      $wyniki = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

      $numW=0;
      $tabW=[];

      foreach($wyniki as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tabW[$numW]=$IDprzepisu;
        $numW++;
      }


      return $tabW;
    }
  }
  else
  {
    $przepisyID2 = PrzepisQuery::create()
                  ->leftJoinLubie_to('Lubie_to')
                  ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                  ->groupByIdPrzepis()
                  ->orderBy('nb', 'desc');

    $num=0;
    $tab1=[];

    foreach($przepisyID2 as $ID2)
    {
      $IDprzepisu = $ID2->getIdPrzepis();
      $tab1[$num]=$IDprzepisu;
      $num++;
    }

    $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

           $num2=0;
           $tab2=[];

           foreach($kat as $k)
           {
             $tab2[$num2]=$k;
             $num2++;
           }

    $ileTab2=count($tab2);

    $tabWynik=[];
    $numWynik=0;
    foreach($tab1 as $t)
    {
      for($i=0; $i<$ileTab2; $i++)
      {
        if($t==$tab2[$i])
        {
          $tabWynik[$numWynik]=$t;
          $numWynik++;
        }
      }
    }


    $wyniki = PrzepisQuery::create()
                  ->leftJoinLubie_to('Lubie_to')
                  ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                  ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                  ->groupByIdPrzepis()
                  ->orderBy('nb', 'desc')
                  ->paginate($page = $y, $rowsPerPage = 10);

    $numW=0;
    $tabW=[];

    foreach($wyniki as $ID2)
    {
      $IDprzepisu = $ID2->getIdPrzepis();
      $tabW[$numW]=$IDprzepisu;
      $numW++;
    }


    return $tabW;
  }

}



// ///////////////////////////////////////KATEGORIA TAK + CZAS nie + NAZWA tak////////////////////////////////////////////////////////////////
function przepisy_ID_KategoriaNazwa_sortOceny($y)
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
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

                    $num=0;
                    $tab1=[];

                    foreach($kat as $ID2)
                    {
                      $IDprzepisu = $ID2->getIdPrzepis();
                      $tab1[$num]=$IDprzepisu;
                      $num++;
                    }

      return $tab1;
    }
    else{
      $przepisyID2 = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc');

      $num=0;
      $tab1=[];

      foreach($przepisyID2 as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tab1[$num]=$IDprzepisu;
        $num++;
      }

      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'));

             $num2=0;
             $tab2=[];

             foreach($kat as $k)
             {
               $tab2[$num2]=$k;
               $num2++;
             }

      $ileTab2=count($tab2);

      $tabWynik=[];
      $numWynik=0;
      foreach($tab1 as $t)
      {
        for($i=0; $i<$ileTab2; $i++)
        {
          if($t==$tab2[$i])
          {
            $tabWynik[$numWynik]=$t;
            $numWynik++;
          }
        }
      }


      $wyniki = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

      $numW=0;
      $tabW=[];

      foreach($wyniki as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tabW[$numW]=$IDprzepisu;
        $numW++;
      }


      return $tabW;
    }
  }
  else
  {
    $przepisyID2 = PrzepisQuery::create()
                  ->leftJoinLubie_to('Lubie_to')
                  ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                  ->groupByIdPrzepis()
                  ->orderBy('nb', 'desc');

    $num=0;
    $tab1=[];

    foreach($przepisyID2 as $ID2)
    {
      $IDprzepisu = $ID2->getIdPrzepis();
      $tab1[$num]=$IDprzepisu;
      $num++;
    }

    $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

           $num2=0;
           $tab2=[];

           foreach($kat as $k)
           {
             $tab2[$num2]=$k;
             $num2++;
           }

    $ileTab2=count($tab2);

    $tabWynik=[];
    $numWynik=0;
    foreach($tab1 as $t)
    {
      for($i=0; $i<$ileTab2; $i++)
      {
        if($t==$tab2[$i])
        {
          $tabWynik[$numWynik]=$t;
          $numWynik++;
        }
      }
    }


    $wyniki = PrzepisQuery::create()
                  ->leftJoinLubie_to('Lubie_to')
                  ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                  ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                  ->groupByIdPrzepis()
                  ->orderBy('nb', 'desc')
                  ->paginate($page = $y, $rowsPerPage = 10);

    $numW=0;
    $tabW=[];

    foreach($wyniki as $ID2)
    {
      $IDprzepisu = $ID2->getIdPrzepis();
      $tabW[$numW]=$IDprzepisu;
      $numW++;
    }


    return $tabW;
  }

}




// ///////////////////////////////////////KATEGORIA TAK + CZAS TAK + NAZWA TAK + sort oceny////////////////////////////////////
function przepisy_ID_KategoriaCzasNazwa_sortOceny($y)
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
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                    ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

                    $num=0;
                    $tab1=[];

                    foreach($kat as $ID2)
                    {
                      $IDprzepisu = $ID2->getIdPrzepis();
                      $tab1[$num]=$IDprzepisu;
                      $num++;
                    }

      return $tab1;
    }
    else{
      $przepisyID2 = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc');

      $num=0;
      $tab1=[];

      foreach($przepisyID2 as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tab1[$num]=$IDprzepisu;
        $num++;
      }

      $kat = NalezyQuery::create()
             ->join('Przepis')
             ->join('Kategoria')
             ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
             ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
             ->where('Kategoria.Nazwa = ?', $tab[0])
             ->select(array('Przepis.IdPrzepis'));

             $num2=0;
             $tab2=[];

             foreach($kat as $k)
             {
               $tab2[$num2]=$k;
               $num2++;
             }

      $ileTab2=count($tab2);

      $tabWynik=[];
      $numWynik=0;
      foreach($tab1 as $t)
      {
        for($i=0; $i<$ileTab2; $i++)
        {
          if($t==$tab2[$i])
          {
            $tabWynik[$numWynik]=$t;
            $numWynik++;
          }
        }
      }


      $wyniki = PrzepisQuery::create()
                    ->leftJoinLubie_to('Lubie_to')
                    ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                    ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                    ->groupByIdPrzepis()
                    ->orderBy('nb', 'desc')
                    ->paginate($page = $y, $rowsPerPage = 10);

      $numW=0;
      $tabW=[];

      foreach($wyniki as $ID2)
      {
        $IDprzepisu = $ID2->getIdPrzepis();
        $tabW[$numW]=$IDprzepisu;
        $numW++;
      }


      return $tabW;
    }
  }
  else
  {
    $przepisyID2 = PrzepisQuery::create()
                  ->leftJoinLubie_to('Lubie_to')
                  ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                  ->groupByIdPrzepis()
                  ->orderBy('nb', 'desc');

    $num=0;
    $tab1=[];

    foreach($przepisyID2 as $ID2)
    {
      $IDprzepisu = $ID2->getIdPrzepis();
      $tab1[$num]=$IDprzepisu;
      $num++;
    }

    $kat = NalezyQuery::create()
          ->join('Przepis')
          ->join('Kategoria')
          ->select(array('Przepis.IdPrzepis'))
          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
          ->where('Przepis.CzasPrzygotowania = ?', $_COOKIE["czas"])
          ->where('Kategoria.Nazwa IN ?', $tab)
          ->groupBy(array('Przepis.IdPrzepis'))
          ->having("count(Przepis.IdPrzepis) = ?", $ileKat);

           $num2=0;
           $tab2=[];

           foreach($kat as $k)
           {
             $tab2[$num2]=$k;
             $num2++;
           }

    $ileTab2=count($tab2);

    $tabWynik=[];
    $numWynik=0;
    foreach($tab1 as $t)
    {
      for($i=0; $i<$ileTab2; $i++)
      {
        if($t==$tab2[$i])
        {
          $tabWynik[$numWynik]=$t;
          $numWynik++;
        }
      }
    }


    $wyniki = PrzepisQuery::create()
                  ->leftJoinLubie_to('Lubie_to')
                  ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                  ->where('Przepis.IdPrzepis IN ?', $tabWynik)
                  ->groupByIdPrzepis()
                  ->orderBy('nb', 'desc')
                  ->paginate($page = $y, $rowsPerPage = 10);

    $numW=0;
    $tabW=[];

    foreach($wyniki as $ID2)
    {
      $IDprzepisu = $ID2->getIdPrzepis();
      $tabW[$numW]=$IDprzepisu;
      $numW++;
    }


    return $tabW;
  }

}


?>
