<?php
if (isset($_POST['sort'])) {
    setcookie("sortowanie", $_POST['sort']);
    header("Refresh:0");
} else {
  if(empty($_COOKIE['sortowanie'])) {
    setcookie("sortowanie", null);
  }
}


if (isset($_POST['czas'])) {
    setcookie("czas", $_POST['czas']);
    header("Refresh:0");
} else {
  if(empty($_COOKIE['czas'])) {
    setcookie("czas", null);
  }
}

if (isset($_POST['przepis'])) {
    setcookie("przepis", $_POST['przepis']);
    header("Refresh:0");
} else {
  if(empty($_COOKIE['przepis'])) {
    setcookie("przepis", null);
  }
}



///////////kategorie//////////

// if (isset($_POST['categories'])) {
//   foreach ($_POST['categories'] as $name_categories)
//   {
//     setcookie("kategoria", $name_categories);
//   }
//     //setcookie("kategoria", $_POST['czas']);
//     header("Refresh:0");
// } else {
//   if(empty($_COOKIE['categories'])) {
//     setcookie("kategoria", null);
//   }
// }


?>
<html>

<head>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous"> -->
  <link rel="Stylesheet" type="text/css" href="style/css/style.css" />
  <meta charset="utf-8" />
  <title>Pyszniutkie.pl</title>
</head>

<body>
  <main>
    <?php include 'nav.php' ?>

    <section class="search-section">
      <form class="search__form" action="searchDB.php?currentPage=1" method="post">
        <div class="search__form__searchbar">
          <input type="text" name="przepis" placeholder="Szukaj przepisu...">
          <input type="submit" value="">
        </div>
        <script type="text/javascript" src="script - Categories.js"></script>
        <div class="search__form__categories" id="categories">
          <div class="search__form__select" id="category_1">
            <select name="categories[]">
              <option value=""disabled selected>Kategoria</option>
              <option value="Dowolne">Dowolna Kategoria</option>

              <?php
              require_once __DIR__.'/vendor/autoload.php';
              require_once __DIR__.'/generated-conf/config.php';

              $kategorie = KategoriaQuery::create()->find();
                foreach ($kategorie as $kat) {
                    echo '<option value="'.$kat->getNazwa().'">'.$kat->getNazwa().'</option>';
                }

              ?>
            </select>
          </div>
          <div id="categoryButtonDiv" class="content__form__button">
            <button id="categoryButton" type="button" onClick="addCategory()" > <img src="img/plus icon.png" /> Dodaj kolejną kategorię do wyszukania</button>
          </div>
        </div>
        <div class="search__form__select">
          <select id="czas" name="czas">
            <option value="" disabled selected>Czas przygotowania</option>
            <option value="Dowolne">Dowolny czas</option>
            <option value="15">15 min</option>
            <option value="20">20 min</option>
            <option value="30">30 min</option>
            <option value="45">45 min</option>
            <option value="50">50 min</option>
          </select>
        </div>
        <div class="search__form__select">
          <select id="sort" name="sort">
            <option value="" disabled selected>Sortuj po...</option>
            <option value="Dowolne">Dowolne sortowanie</option>
            <option value="nazwa">nazwa</option>
            <option value="oceny">oceny</option>
            <option value="czas">czas</option>
            <option value="poziom">poziom trudnosci</option>
          </select>
        </div>
      </form>
    </section>


    <section class="content">
      <div class="content__elements" id="search-results">




        <?php
        require_once __DIR__.'/vendor/autoload.php';
        require_once __DIR__.'/generated-conf/config.php';


        $pageNumber = $_GET['currentPage'];



        $pID = PrzepisQuery::create()
          ->select(array('IdPrzepis'))
          ->find();

        $ileID = count($pID); //ilosc wszystkich przepisow w bazie
        $rowsPerPage = 5; //ilosc przepisow wyswietlanych na jednej stronie
        $totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron



        function numeryStron($iloscStron) //wyswietlanie numeracji na dole strony
        {
          echo '</div>
          <div class="content__search-counter" id="search-counter">';
            $num=1;
            for ($num; $num<=$iloscStron; $num++)
            {
                echo '<div class="content__search-counter__element"><a href="searchDB.php?currentPage='.$num.'">'.$num.'</a></div>';
            }
          echo '</div>
          <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>';
        }



        function ileStronCzas()  //funkcja ktora sprawdza ile stron bedzie 'wykorzystanych' do wyswietlania przepisow w zaleznosci od ilosci wynikow dla wybrnegogo czasu
        {
          $przepisyID_0 = PrzepisQuery::create()
                          ->select(array('IdPrzepis'))
                          ->filterByCzasPrzygotowania($_COOKIE["czas"])
                          ->find();
          $num = count($przepisyID_0);
          $ileStron = ceil($num / 5);

          return $ileStron;
        }


        function ileStronNazwa()  //funkcja analogiczna dla ileStronCzas
        {
          $przepisyID_1 = PrzepisQuery::create()
                          ->select(array('IdPrzepis'))
                          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                          ->find();
          $num = count($przepisyID_1);
          $ileStron = ceil($num / 5);

          return $ileStron;
        }


        function ileStronNazwaCzas()  //liczy ile stron przy kombinacji nazwa+czas
        {
          $przepisyID_2 = PrzepisQuery::create()
                          ->select(array('IdPrzepis'))
                          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                          ->filterByCzasPrzygotowania($_COOKIE["czas"])
                          ->find();
          $num = count($przepisyID_2);
          $ileStron = ceil($num / 5);

          return $ileStron;
        }




        function dopasujNazwe() //znajduje przepisy zawierajace podane slowo/nazwe/czesc nazwy
        {
          $przepisyID_1 = PrzepisQuery::create()
                          ->select(array('IdPrzepis'))
                          ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                          ->find();
          // foreach($przepisyID_1 as $wynik)
          // {
          //   echo '</br> przepis o nazwie: '.$wynik.'</br>';
          // }

        }

        dopasujNazwe();





//dzialanie//

if (empty($_COOKIE['sortowanie'])) //brak ustawionego sortowania
{
  if(!(empty($_COOKIE['przepis']))) //wyszukiwanie po nazwie ustawione
  {
    if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas jest wybrany jakis konkretny
    {
        numeryStron(ileStronNazwaCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

        $y=1;
        for ($y; $y<=ileStronNazwaCzas(); $y++)
        {
            if ($pageNumber==$y)
            {
                echo '</br>Strona: ';
                echo $pageNumber;
                echo '</br>Brak ustawionego sortowania';
                echo '</br> brak sortowania + ustawiony czas + ustawiona nazwa</br>';
                $przepisyID = PrzepisQuery::create()
                              ->select(array('IdPrzepis'))
                              ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                              ->filterByCzasPrzygotowania($_COOKIE["czas"])
                              ->paginate($page = $y, $rowsPerPage = 5);

                foreach($przepisyID as $ID)
                {
                    $pDane = PrzepisQuery::create()->findPk($ID);
                    $zdj = $pDane->getZdjecieOgolne();
                    if ($zdj !== null)
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                    }
                    else
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                    }
                }
            }
        }
    }
    else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub nie ustawiony
    {

        numeryStron(ileStronNazwa());

        $y=1;
        for ($y; $y<=ileStronNazwa(); $y++)
        {
            if ($pageNumber==$y)
            {
                echo '</br>Strona: ';
                echo $pageNumber;
                echo '</br>Brak ustawionego sortowania';
                echo '</br> brak sortowania + brak czasu + ustawiona nazwa </br>';
                $przepisyID = PrzepisQuery::create()
                              ->select(array('IdPrzepis'))
                              ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                              ->paginate($page = $y, $rowsPerPage = 5);

                foreach($przepisyID as $ID)
                {
                    $pDane = PrzepisQuery::create()->findPk($ID);
                    $zdj = $pDane->getZdjecieOgolne();
                    if($zdj !== null)
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                    }
                    else
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                    }
                }
            }
        }
    }
  }
  else
  {
    if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas jest wybrany jakis konkretny
    {
        // $przepisyID_0 = PrzepisQuery::create()
        //                 ->select(array('IdPrzepis'))
        //                 ->filterByCzasPrzygotowania($_COOKIE["czas"])
        //                 ->find();
        // $num = count($przepisyID_0);
        // $ileStron = ceil($num / 5);

        numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

        $y=1;
        for ($y; $y<=ileStronCzas(); $y++)
        {
            if ($pageNumber==$y)
            {
                echo '</br>Strona: ';
                echo $pageNumber;
                echo '</br>Brak ustawionego sortowania';
                echo '</br> dziala1 </br>';
                echo '</br> brak sortowania + czas ustawiony + brak nazwy </br>';
                $przepisyID = PrzepisQuery::create()
                              ->select(array('IdPrzepis'))
                              ->filterByCzasPrzygotowania($_COOKIE["czas"])
                              ->paginate($page = $y, $rowsPerPage = 5);

                foreach($przepisyID as $ID)
                {
                    $pDane = PrzepisQuery::create()->findPk($ID);
                    $zdj = $pDane->getZdjecieOgolne();
                    if ($zdj !== null)
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                    }
                    else
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                    }
                }
            }
        }
    }
    else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub nie ustawiony
    {

        numeryStron($totalPages);

        $y=1;
        for ($y; $y<=$totalPages; $y++)
        {
            if ($pageNumber==$y)
            {
                echo '</br>Strona: ';
                echo $pageNumber;
                echo '</br>Brak ustawionego sortowania';
                echo '</br> dziala2 </br>';
                echo '</br> brak sortowania + czas nieustawiony + brak nazwy </br>';
                $przepisyID = PrzepisQuery::create()
                              ->select(array('IdPrzepis'))
                              ->paginate($page = $y, $rowsPerPage = 5);

                foreach($przepisyID as $ID)
                {
                    $pDane = PrzepisQuery::create()->findPk($ID);
                    $zdj = $pDane->getZdjecieOgolne();
                    if($zdj !== null)
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                    }
                    else
                    {
                        echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                    }
                }
            }
        }
    }
  }
}
else //sortowanie bedzie ustawione
{
    if ($_COOKIE["sortowanie"]=="czas")
    {
        if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny np 10min
        {
            // $przepisyID_0 = PrzepisQuery::create()
            //                 ->select(array('IdPrzepis'))
            //                 ->filterByCzasPrzygotowania($_COOKIE["czas"])
            //                 ->find();
            // $num = count($przepisyID_0);
            // $ileStron = ceil($num / 5);

            numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

            $y=1;
            for ($y; $y<=ileStronCzas(); $y++)
            {
                if ($pageNumber==$y)
                {

                    echo '</br>Strona: ';
                    echo $pageNumber;
                    echo '</br>Sortowanie po: ';
                    echo $_COOKIE["sortowanie"];
                    echo '</br> dziala3 </br>';

                    $przepisyID1 = PrzepisQuery::create()
                                   ->select(array('IdPrzepis'))
                                   ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                   ->paginate($page = $y, $rowsPerPage = 5);

                    foreach($przepisyID1 as $ID)
                    {
                        $pDane = PrzepisQuery::create()->findPk($ID);
                        $zdj = $pDane->getZdjecieOgolne();
                        if ($zdj !== null)
                        {
                            echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                        }
                        else
                        {
                            echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                        }
                    }
                }
            }
        }
        else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
        {
            numeryStron($totalPages); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

            $y=1;
            for ($y; $y<=$totalPages; $y++)
            {
                if ($pageNumber==$y)
                {
                    echo '</br>Strona: ';
                    echo $pageNumber;
                    echo '</br>Sortowanie po: ';
                    echo $_COOKIE["sortowanie"];
                    echo '</br> dziala4 </br>';
                    $przepisyID1 = PrzepisQuery::create()
                                   ->select(array('IdPrzepis'))
                                   ->orderByCzasPrzygotowania()
                                   ->paginate($page = $y, $rowsPerPage = 5);

                    foreach($przepisyID1 as $ID)
                    {
                        $pDane = PrzepisQuery::create()->findPk($ID);
                        $zdj = $pDane->getZdjecieOgolne();
                        if ($zdj !== null)
                        {
                            echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                        }
                        else
                        {
                            echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                        }
                    }
                }
            }
        }
    }
    elseif ($_COOKIE["sortowanie"]=="nazwa")
    {
      if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
      {
          // $przepisyID_0 = PrzepisQuery::create()
          //                 ->select(array('IdPrzepis'))
          //                 ->filterByCzasPrzygotowania($_COOKIE["czas"])
          //                 ->find();
          // $num = count($przepisyID_0);
          // $ileStron = ceil($num / 5);

          numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

          $y=1;
          for ($y; $y<=ileStronCzas(); $y++)
          {
              if ($pageNumber==$y)
              {

                  echo '</br>Strona: ';
                  echo $pageNumber;
                  echo '</br>Sortowanie po: ';
                  echo $_COOKIE["sortowanie"];
                  echo '</br> dziala5 </br>';

                  $przepisyID2 = PrzepisQuery::create()
                                 ->select(array('IdPrzepis'))
                                 ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                 ->orderByNazwa()
                                 ->paginate($page = $y, $rowsPerPage = 5);

                  foreach($przepisyID2 as $ID)
                  {
                      $pDane = PrzepisQuery::create()->findPk($ID);
                      $zdj = $pDane->getZdjecieOgolne();
                      if ($zdj !== null)
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                      }
                      else
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                      }
                  }
              }
          }
      }
      else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
      {
          numeryStron($totalPages); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

          $y=1;
          for ($y; $y<=$totalPages; $y++)
          {
              if ($pageNumber==$y)
              {
                  echo '</br>Strona: ';
                  echo $pageNumber;
                  echo '</br>Sortowanie po: ';
                  echo $_COOKIE["sortowanie"];
                  echo '</br> dziala6 </br>';
                  $przepisyID2 = PrzepisQuery::create()
                                 ->select(array('IdPrzepis'))
                                 ->orderByNazwa()
                                 ->paginate($page = $y, $rowsPerPage = 5);

                  foreach($przepisyID2 as $ID)
                  {
                      $pDane = PrzepisQuery::create()->findPk($ID);
                      $zdj = $pDane->getZdjecieOgolne();
                      if ($zdj !== null)
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                      }
                      else
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                      }
                  }
              }
          }
      }
    }
    elseif ($_COOKIE["sortowanie"]=="poziom")
    {
      if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
      {
          // $przepisyID_0 = PrzepisQuery::create()
          //                 ->select(array('IdPrzepis'))
          //                 ->filterByCzasPrzygotowania($_COOKIE["czas"])
          //                 ->find();
          // $num = count($przepisyID_0);
          // $ileStron = ceil($num / 5);

          numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

          $y=1;
          for ($y; $y<=ileStronCzas(); $y++)
          {
              if ($pageNumber==$y)
              {

                  echo '</br>Strona: ';
                  echo $pageNumber;
                  echo '</br>Sortowanie po: ';
                  echo $_COOKIE["sortowanie"];
                  echo '</br> dziala7 </br>';

                  $przepisyID3 = PrzepisQuery::create()
                        ->select(array('IdPrzepis'))
                        ->filterByCzasPrzygotowania($_COOKIE["czas"])
                        ->orderByStopienTrudnosci()
                        ->paginate($page = $y, $rowsPerPage = 5);

                  foreach($przepisyID3 as $ID)
                  {
                      $pDane = PrzepisQuery::create()->findPk($ID);
                      $zdj = $pDane->getZdjecieOgolne();
                      if ($zdj !== null)
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                      }
                      else
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                      }
                  }
              }
          }
      }
      else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
      {
          numeryStron($totalPages); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

          $y=1;
          for ($y; $y<=$totalPages; $y++)
          {
              if ($pageNumber==$y)
              {
                  echo '</br>Strona: ';
                  echo $pageNumber;
                  echo '</br>Sortowanie po: ';
                  echo $_COOKIE["sortowanie"];
                  echo '</br> dziala8 </br>';
                  $przepisyID3 = PrzepisQuery::create()
                        ->select(array('IdPrzepis'))
                        ->orderByStopienTrudnosci()
                        ->paginate($page = $y, $rowsPerPage = 5);

                  foreach($przepisyID3 as $ID)
                  {
                      $pDane = PrzepisQuery::create()->findPk($ID);
                      $zdj = $pDane->getZdjecieOgolne();
                      if ($zdj !== null)
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                      }
                      else
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                      }
                  }
              }
          }
      }
    }
    elseif ($_COOKIE["sortowanie"]=="oceny")
    {
        $y=1;
        for ($y; $y<=$totalPages; $y++)
        {
            if ($pageNumber==$y)
            {
                echo '</br> Sortowanie po ocenach jeszcze niedostępne!</br></br></br>';
                echo '</br>Strona: ';
                echo $pageNumber;
                echo '</br>Sortowanie po: ';
                echo $_COOKIE["sortowanie"];
            }
        }
    }
    elseif ($_COOKIE["sortowanie"]=="Dowolne")
    {
      if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
      {
          // $przepisyID_0 = PrzepisQuery::create()
          //                 ->select(array('IdPrzepis'))
          //                 ->filterByCzasPrzygotowania($_COOKIE["czas"])
          //                 ->find();
          // $num = count($przepisyID_0);
          // $ileStron = ceil($num / 5);

          numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

          $y=1;
          for ($y; $y<=ileStronCzas(); $y++)
          {
              if ($pageNumber==$y)
              {

                  echo '</br>Strona: ';
                  echo $pageNumber;
                  echo '</br>Sortowanie po: ';
                  echo $_COOKIE["sortowanie"];
                  echo '</br> dziala9 </br>';

                  $przepisyID4 = PrzepisQuery::create()
                        ->select(array('IdPrzepis'))
                        ->filterByCzasPrzygotowania($_COOKIE["czas"])
                        ->paginate($page = $y, $rowsPerPage = 5);

                  foreach($przepisyID4 as $ID)
                  {
                      $pDane = PrzepisQuery::create()->findPk($ID);
                      $zdj = $pDane->getZdjecieOgolne();
                      if ($zdj !== null)
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                      }
                      else
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                      }
                  }
              }
          }
      }
      else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
      {
          numeryStron($totalPages); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

          $y=1;
          for ($y; $y<=$totalPages; $y++)
          {
              if ($pageNumber==$y)
              {
                  echo '</br>Strona: ';
                  echo $pageNumber;
                  echo '</br>Sortowanie po: ';
                  echo $_COOKIE["sortowanie"];
                  echo '</br> dziala10 </br>';
                  $przepisyID4 = PrzepisQuery::create()
                          ->select(array('IdPrzepis'))
                          ->paginate($page = $y, $rowsPerPage = 5);

                  foreach($przepisyID4 as $ID)
                  {
                      $pDane = PrzepisQuery::create()->findPk($ID);
                      $zdj = $pDane->getZdjecieOgolne();
                      if ($zdj !== null)
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                      }
                      else
                      {
                          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
                      }
                  }
              }
          }
      }
    }
}









      ?>
    </section>

    <?php include 'footer.php' ?>
  </main>






  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script> -->
</body>

</html>
