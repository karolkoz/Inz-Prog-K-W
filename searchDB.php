<?php
include 'session.php';
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



$i=0;
if (isset($_POST['categories'])) {
  //tu usuwanie ciastek
  if(!(empty($_COOKIE['kategoria'])))//jesli juz jest ustawione jakies ciastko to je usun
  {
    $z=0;
    foreach ($_COOKIE['kategoria'] as $name_categories)
    {
      setcookie("kategoria[$z]", null);
      //echo 'jesli juz jest ustawione jakies ciastko to je usun ';
      $z++;
    }
  }
  foreach ($_POST['categories'] as $name_categories) //i dopiero ustawiaj nowe
  {
    setcookie("kategoria[$i]", $name_categories);
    $i++;
  }
  header("Refresh:0");
}
else
{
  if(empty($_COOKIE['kategoria'])) {
        setcookie("kategoria", null);
  }
}


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

    <script type="text/javascript" src="script - Categories.js"></script>
    <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>
    <section class="search-section">
      <form class="search__form" action="searchDB.php?currentPage=1" method="post" id="form">
        <div class="search__form__searchbar">
          <input type="text" name="przepis" id="przepis" placeholder="Szukaj przepisu...">
          <input type="submit" value="">
        </div>
        <div class="search__form__categories" id="categories">
          <div class="search__form__select" id="category_1">
            <select name="categories[]" onchange="category_validation()">
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
        <?php
        $i=1;
        if(!(empty($_COOKIE['kategoria']))) {
          foreach ($_COOKIE['kategoria'] as $name_categories) {
            if($i > 1) {
              echo '<script type="text/javascript">addCategory()</script>';
            }
            echo '<script type="text/javascript">CategorySelect('.$i.', "'.$name_categories.'")</script>';
            $i++;
          }
        }
        if(!empty($_COOKIE['czas'])) {
          echo '<script type="text/javascript">timeSelect('.$_COOKIE['czas'].')</script>';
        }
        if(!empty($_COOKIE['przepis'])) {
            echo '<script type="text/javascript">nameSelect("'.$_COOKIE['przepis'].'")</script>';
        }
        if(!(empty($_COOKIE['sortowanie']))) {
          echo '<script type="text/javascript">sortSelect("'.$_COOKIE['sortowanie'].'")</script>';
        }
        ?>
      </form>
    </section>


    <section class="content">
      <div class="content__elements" id="search-results">




        <?php
        require_once __DIR__.'/vendor/autoload.php';
        require_once __DIR__.'/generated-conf/config.php';
        include("funkcje.php");
        include("funkcje_brak_sortowania.php");
        include("fun_ileStronKat_brakSortowania.php");
        include("funkcje_sortowanie_czas.php");
        include("fun_ileStronKat_sortowanieCzas.php");
        include("funkcje_sortowanie_nazwa.php");
        include("fun_ileStronKat_sortowanieNazwa.php");
        include("funkcje_sortowanie_poziom.php");
        include("fun_ileStronKat_sortowaniePoziom.php");
        include("funkcje_sortowanie_oceny.php");
        include("fun_ileStronKat_sortowanieOceny.php");

        $pageNumber = $_GET['currentPage'];


        $pID = PrzepisQuery::create()
          ->select(array('IdPrzepis'))
          ->where('Przepis.Status = ?', 1)
          ->find();

        $ileID = count($pID); //ilosc wszystkich przepisow w bazie
        $rowsPerPage = 10; //ilosc przepisow wyswietlanych na jednej stronie
        $totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron







if (empty($_COOKIE['sortowanie'])) //brak ustawionego sortowania
{
  if(!(empty($_COOKIE['kategoria'])))
   {
     if(!(empty($_COOKIE['przepis']))) //wyszukiwanie po nazwie ustawione
     {
         if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas jest wybrany jakis konkretny
         {
             numeryStron(ileStronKategoriaCzasNazwa()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

             $y=1;
             for ($y; $y<=ileStronKategoriaCzasNazwa(); $y++)
             {
                 if ($pageNumber==$y)
                 {
                     //echo '</br> brak sortowania + ustawiony czas + ustawiona nazwa + ustawiona kategoria</br>';

                     wypiszPrzepis(przepisy_ID_KategoriaCzasNazwa($y));
                 }
             }
         }
         else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub nie ustawiony
         {

             numeryStron(ileStronKategoriaNazwa());

             $y=1;
             for ($y; $y<=ileStronKategoriaNazwa(); $y++)
             {
                 if ($pageNumber==$y)
                 {
                     //echo '</br> brak sortowania + brak czasu + ustawiona nazwa + ustawiona kategoria</br>';

                     wypiszPrzepis(przepisy_ID_KategoriaNazwa($y));
                 }
             }
         }
     }
     else  ///nazwa nie ustawiona, kategoria ustawiona
     {
         if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas jest wybrany jakis konkretny
         {
             numeryStron(ileStronKategoriaCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

             $y=1;
             for ($y; $y<=ileStronKategoriaCzas(); $y++)
             {
                 if ($pageNumber==$y)
                 {
                     //echo '</br> brak sortowania + czas ustawiony + brak nazwy + kategoria ustawiona</br>';

                     wypiszPrzepis(przepisy_ID_KategoriaCzas($y));
                 }
             }
         }
         else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub nie ustawiony
         {
             numeryStron(ileStronKategoria());

             $y=1;
             for ($y; $y<=ileStronKategoria(); $y++)
             {
                 if ($pageNumber==$y)
                 {
                     //echo '</br> brak sortowania + czas nieustawiony + brak nazwy + kategoria ustawiona</br>';

                     wypiszPrzepis(przepisy_ID_Kategoria($y));
                 }
             }
         }
     }
   }
   else//////////////////////////////////////////////KATEGORIA NIE USTAWIONA////////////////////////////////////////////////////////////////////////////
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
                    //echo '</br>Brak ustawionego sortowania';
                    //echo '</br> brak sortowania + ustawiony czas + ustawiona nazwa</br>';
                    $przepisyID = PrzepisQuery::create()
                                  ->select(array('IdPrzepis'))
                                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                  ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                  ->paginate($page = $y, $rowsPerPage = 10);

                    wypiszPrzepis($przepisyID);
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
                //    echo '</br>Brak ustawionego sortowania';
                  //  echo '</br> brak sortowania + brak czasu + ustawiona nazwa </br>';
                    $przepisyID = PrzepisQuery::create()
                                  ->select(array('IdPrzepis'))
                                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                  ->paginate($page = $y, $rowsPerPage = 10);

                    wypiszPrzepis($przepisyID);
                }
            }
        }
    }
    else
    {
        if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas jest wybrany jakis konkretny
        {
            numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

            $y=1;
            for ($y; $y<=ileStronCzas(); $y++)
            {
                if ($pageNumber==$y)
                {
                    //echo '</br> dziala1 </br>';
                    //echo '</br> brak sortowania + czas ustawiony + brak nazwy </br>';
                    $przepisyID = PrzepisQuery::create()
                                  ->select(array('IdPrzepis'))
                                  ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                  ->paginate($page = $y, $rowsPerPage = 10);

                    wypiszPrzepis($przepisyID);
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
                    //echo '</br> dziala2 </br>';
                    // brak sortowania + czas nieustawiony + brak nazwy </br>';
                    $przepisyID = PrzepisQuery::create()
                                  ->select(array('IdPrzepis'))
                                  ->paginate($page = $y, $rowsPerPage = 10);

                    wypiszPrzepis($przepisyID);
                }
            }
        }
    }
  }
}
////////////////////////////////////////////////////////SORTOWANIE JEST USTAWIONE (CZAS/NAZWA/OCENYPOZIOM/DOWOLNE)/////////////////////////////////////////////////////////////////////
else
{
    if ($_COOKIE["sortowanie"]=="czas")
    {
      if(!(empty($_COOKIE['kategoria'])))
       {
         if(!(empty($_COOKIE['przepis']))) //sortowanie po czasie + wyszukiwanie po nazwie ustawione
         {
             if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny np 10min
             {
               //funkcje takie same jak przy braku sortowania bo do tego samego sie sprowadza w tym przypadku
                 numeryStron(ileStronKategoriaCzasNazwa()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                 $y=1;
                 for ($y; $y<=ileStronKategoriaCzasNazwa(); $y++)
                 {
                     if ($pageNumber==$y)
                     {
                         //echo '</br> sorowanie po czasie + czas ustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                         wypiszPrzepis(przepisy_ID_KategoriaCzasNazwa($y));
                     }
                 }
             }
             else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
             {
                 numeryStron(ileStronKategoriaNazwa_sortCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                 $y=1;
                 for ($y; $y<=ileStronKategoriaNazwa_sortCzas(); $y++)
                 {
                     if ($pageNumber==$y)
                     {
                         //echo '</br> sorowanie po czasie + czas nieustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                         wypiszPrzepis(przepisy_ID_KategoriaNazwa_sortCzas($y));
                     }
                 }
             }
         }
         else //sortowanie po czasie ale bez ustawionej nazwy
         {
             if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny np 10min
             {
               //funkcje takie same jak przy braku sortowania bo do tego samego sie sprowadza w tym przypadku
                 numeryStron(ileStronKategoriaCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                 $y=1;
                 for ($y; $y<=ileStronKategoriaCzas(); $y++)
                 {
                     if ($pageNumber==$y)
                     {
                         //echo '</br> sorowanie po czasie + czas ustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                         wypiszPrzepis(przepisy_ID_KategoriaCzas($y));
                     }
                 }
             }
             else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
             {
                 numeryStron(ileStronKategoria_sortCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                 $y=1;
                 for ($y; $y<=ileStronKategoria_sortCzas(); $y++)
                 {
                     if ($pageNumber==$y)
                     {
                         //echo '</br> sorowanie po czasie + czas nieustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                         wypiszPrzepis(przepisy_ID_Kategoria_sortCzas($y));
                     }
                 }
             }
         }
       }
       else////////////////////////////////////brak kategorii
       {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po czasie + wyszukiwanie po nazwie ustawione
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny np 10min
            {
                numeryStron(ileStronNazwaCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwaCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sorowanie po czasie + czas ustawiony + nazwa ustawiona + kat nieustawiona</br>';
                        $przepisyID1 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID1);
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronNazwa()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sorowanie po czasie + czas nieustawiony + nazwa ustawiona + kat nieustawiona</br>';
                        $przepisyID1 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->orderByCzasPrzygotowania()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID1);
                    }
                }
            }
        }
        else //sortowanie po czasie ale bez ustawionej nazwy
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny np 10min
            {
                numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sorowanie po czasie + czas ustawiony + nazwa nieustawiona + kat nieustawiona</br>';
                        $przepisyID1 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID1);
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
                        //echo '</br> sorowanie po czasie + czas nieustawiony + nazwa nieustawiona + kat nieustawiona</br>';
                        $przepisyID1 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->orderByCzasPrzygotowania()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID1);
                    }
                }
            }
        }
      }
    }


//////////////////////////////////////////////////////////////////SORTOWANIE - NAZWA//////////////////////////////////////////////////////////////////


    elseif ($_COOKIE["sortowanie"]=="nazwa")
    {
      if(!(empty($_COOKIE['kategoria'])))
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po nazwie alfabetycznie + wyszukiwanie po nazwie ustawione + kat
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronKategoriaCzasNazwa_sortNazwa());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzasNazwa_sortNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sortowanie alfabetyczne + czas ustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzasNazwa_sortNazwa($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronKategoriaNazwa_sortNazwa());

                $y=1;
                for ($y; $y<=ileStronKategoriaNazwa_sortNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sortowanie alfabetyczne + czas nieustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaNazwa_sortNazwa($y));
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronKategoriaCzas_sortNazwa());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzas_sortNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sortowanie alfabetyczne + czas ustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzas_sortCzas($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronKategoria_sortNazwa());

                $y=1;
                for ($y; $y<=ileStronKategoria_sortNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        //echo '</br> sortowanie alfabetyczne + czas nieustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_Kategoria_sortNazwa($y));
                    }
                }
            }
        }
      }
      else///////////////////////////////////////brak ustawionej kategorii
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po nazwie alfabetycznie + wyszukiwanie po nazwie ustawione
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronNazwaCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwaCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie alfabetyczne + czas ustawiony + nazwa ustawiona + kategoria nie ustawiona</br>';
                        $przepisyID2 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->orderByNazwa()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID2);
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronNazwa()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie alfabetyczne + czas nieustawiony + nazwa ustawiona  + kategoria nie ustawiona</br>';
                        $przepisyID2 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->orderByNazwa()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID2);
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie alfabetyczne + czas ustawiony + nazwa nieustawiona  + kategoria nie ustawiona</br>';
                        $przepisyID2 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->orderByNazwa()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID2);
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
                        // sortowanie alfabetyczne + czas nieustawiony + nazwa nieustawiona  + kategoria nie ustawiona</br>';
                        $przepisyID2 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->orderByNazwa()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID2);
                    }
                }
            }
        }
      }
    }


//////////////////////////////////////////////////////////////////SORTOWANIE - POZIOM//////////////////////////////////////////////////////////////////




    elseif ($_COOKIE["sortowanie"]=="poziom")
    {
      if(!(empty($_COOKIE['kategoria'])))
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po poziomie + wyszukiwanie po nazwie ustawione +kat
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronKategoriaCzasNazwa_sortPoziom());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzasNazwa_sortPoziom(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas ustawiony + nazwa ustawiona + kategoria ustwaiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzasNazwa_sortPoziom($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronKategoriaNazwa_sortPoziom());

                $y=1;
                for ($y; $y<=ileStronKategoriaNazwa_sortPoziom(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas nieustawiony + nazwa ustawiona + kategoria ustwaiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaNazwa_sortPoziom($y));
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronKategoriaCzas_sortPoziom());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzas_sortPoziom(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas ustawiony + nazwa nieustawiona + kategoria ustwaiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzas_sortPoziom($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronKategoria_sortPoziom());

                $y=1;
                for ($y; $y<=ileStronKategoria_sortPoziom(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas nieustawiony + nazwa nieustawiona + kategoria ustwaiona</br>';

                        wypiszPrzepis(przepisy_ID_Kategoria_sortPoziom($y));
                    }
                }
            }
        }
      }
      else
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po poziomie + wyszukiwanie po nazwie ustawione
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronNazwaCzas());

                $y=1;
                for ($y; $y<=ileStronNazwaCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas ustawiony + nazwa ustawiona + kategoria nieustwaiona</br>';
                        $przepisyID3 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->orderByStopienTrudnosci()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID3);
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronNazwa()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas nieustawiony + nazwa ustawiona + kategoria nieustwaiona</br>';
                        $przepisyID3 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->orderByStopienTrudnosci()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID3);
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po poziomie + czas ustawiony + nazwa nieustawiona + kategoria nieustwaiona</br>';
                        $przepisyID3 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->orderByStopienTrudnosci()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID3);
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
                        // sortowanie po poziomie + czas nieustawiony + nazwa nieustawiona + kategoria nieustwaiona</br>';
                        $przepisyID3 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->orderByStopienTrudnosci()
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID3);
                    }
                }
            }
        }
      }
    }



//////////////////////////////////////////////////////////////////SORTOWANIE - OCENY//////////////////////////////////////////////////////////////////

///do edycji

    elseif ($_COOKIE["sortowanie"]=="oceny")
    {
      if(!(empty($_COOKIE['kategoria'])))
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po nazwie alfabetycznie + wyszukiwanie po nazwie ustawione + kat
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronKategoriaCzasNazwa_sortOceny());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzasNazwa_sortOceny(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas ustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzasNazwa_sortOceny($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronKategoriaNazwa_sortOceny());

                $y=1;
                for ($y; $y<=ileStronKategoriaNazwa_sortOceny(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas nieustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaNazwa_sortOceny($y));
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronKategoriaCzas_sortOceny());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzas_sortOceny(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas ustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzas_sortOceny($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronKategoria_sortOceny());

                $y=1;
                for ($y; $y<=ileStronKategoria_sortOceny(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas nieustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_Kategoria_sortOceny($y));

                    }
                }
            }
        }
      }
      else///////////////////////////////////////brak ustawionej kategorii
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po nazwie alfabetycznie + wyszukiwanie po nazwie ustawione
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronNazwaCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwaCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas ustawiony + nazwa ustawiona + kategoria nie ustawiona</br>';

                        $przepisyID2 = PrzepisQuery::create()
                                      ->leftJoinLubie_to('Lubie_to')
                                      ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                                      ->groupByIdPrzepis()
                                      ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                      ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                      ->orderBy('nb', 'desc')
                                      ->paginate($page = $y, $rowsPerPage = 10);

                                      $num=0;
                                      $tab1=[];

                                      foreach($przepisyID2 as $ID2)
                                      {
                                        $IDprzepisu = $ID2->getIdPrzepis();
                                        $tab1[$num]=$IDprzepisu;
                                        $num++;
                                        //wypiszPrzepisOceny($IDprzepisu);
                                      }

                                      wypiszPrzepis($tab1);
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronNazwa()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas nieustawiony + nazwa ustawiona  + kategoria nie ustawiona</br>';

                        $przepisyID2 = PrzepisQuery::create()
                                      ->leftJoinLubie_to('Lubie_to')
                                      ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                                      ->groupByIdPrzepis()
                                      ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                      ->orderBy('nb', 'desc')
                                      ->paginate($page = $y, $rowsPerPage = 10);

                                      $num=0;
                                      $tab2=[];

                                      foreach($przepisyID2 as $ID2)
                                      {
                                        $IDprzepisu = $ID2->getIdPrzepis();
                                        $tab2[$num]=$IDprzepisu;
                                        $num++;
                                        //wypiszPrzepisOceny($IDprzepisu);
                                      }

                                      wypiszPrzepis($tab2);
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronCzas()); //wysweitlanie odpowiedniej ilosci numerow stron w zaleznosci od ilosci oczekiwanych wynikow (ilosci przepisow)

                $y=1;
                for ($y; $y<=ileStronCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po ocenach + czas ustawiony + nazwa nieustawiona  + kategoria nie ustawiona</br>';

                        $przepisyID2 = PrzepisQuery::create()
                                      ->leftJoinLubie_to('Lubie_to')
                                      ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                                      ->groupByIdPrzepis()
                                      ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                      ->orderBy('nb', 'desc')
                                      ->paginate($page = $y, $rowsPerPage = 10);

                                      $num=0;
                                      $tab3=[];

                                      foreach($przepisyID2 as $ID2)
                                      {
                                        $IDprzepisu = $ID2->getIdPrzepis();
                                        $tab3[$num]=$IDprzepisu;
                                        $num++;
                                        //wypiszPrzepisOceny($IDprzepisu);
                                      }

                                      wypiszPrzepis($tab3);
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
                        // sortowanie po ocenach + czas nieustawiony + nazwa nieustawiona  + kategoria nie ustawiona</br>';

                        $przepisyID2 = PrzepisQuery::create()
                                      ->leftJoinLubie_to('Lubie_to')
                                      ->withColumn('COUNT(Lubie_to.PrzepisIdPrzepis)', 'nb')
                                      ->groupByIdPrzepis()
                                      ->orderBy('nb', 'desc')
                                      ->paginate($page = $y, $rowsPerPage = 10);

                                      $num=0;
                                      $tab4=[];

                                      foreach($przepisyID2 as $ID2)
                                      {
                                        $IDprzepisu = $ID2->getIdPrzepis();
                                        $tab4[$num]=$IDprzepisu;
                                        $num++;
                                        //wypiszPrzepisOceny($IDprzepisu);
                                      }

                                      wypiszPrzepis($tab4);

                    }
                }
            }
        }
      }
    }



//////////////////////////////////////////////////////////////////SORTOWANIE - DOWOLNE//////////////////////////////////////////////////////////////////



    elseif ($_COOKIE["sortowanie"]=="Dowolne")
    {
      if(!(empty($_COOKIE['kategoria'])))
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po 'Dowolne' + wyszukiwanie po nazwie ustawione
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
              //wykorzystane funkcje takie jak przy braku sortowania
                numeryStron(ileStronKategoriaCzasNazwa());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzasNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas ustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzasNazwa($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
              //wykorzystane funkcje takie jak przy braku sortowania
                numeryStron(ileStronKategoriaNazwa());

                $y=1;
                for ($y; $y<=ileStronKategoriaNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas nieustawiony + nazwa ustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaNazwa($y));
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
              //wykorzystane funkcje takie jak przy braku sortowania
                numeryStron(ileStronKategoriaCzas());

                $y=1;
                for ($y; $y<=ileStronKategoriaCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas ustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_KategoriaCzas($y));
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
              //wykorzystane funkcje takie jak przy braku sortowania
                numeryStron(ileStronKategoria());

                $y=1;
                for ($y; $y<=ileStronKategoria(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas nieustawiony + nazwa nieustawiona + kategoria ustawiona</br>';

                        wypiszPrzepis(przepisy_ID_Kategoria($y));
                    }
                }
            }
        }
      }
      else ////////////////kat nie ustawiona
      {
        if(!(empty($_COOKIE['przepis']))) //sortowanie po 'Dowolne' + wyszukiwanie po nazwie ustawione
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronNazwaCzas());

                $y=1;
                for ($y; $y<=ileStronNazwaCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas ustawiony + nazwa ustawiona + kategoria nieustawiona</br>';
                        $przepisyID4 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID4);
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron(ileStronNazwa());

                $y=1;
                for ($y; $y<=ileStronNazwa(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas nieustawiony + nazwa ustawiona + kategoria nieustawiona</br>';
                        $przepisyID4 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID4);
                    }
                }
            }
        }
        else
        {
            if(isset($_COOKIE["czas"]) && $_COOKIE["czas"]!=="Dowolne") //czas wybrany konkretny no 10min
            {
                numeryStron(ileStronCzas());

                $y=1;
                for ($y; $y<=ileStronCzas(); $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas ustawiony + nazwa nieustawiona + kategoria nieustawiona</br>';
                        $przepisyID4 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->filterByCzasPrzygotowania($_COOKIE["czas"])
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID4);
                    }
                }
            }
            else if((isset($_COOKIE["czas"]) && $_COOKIE["czas"]=="Dowolne") || !(isset($_COOKIE["czas"])) ) //czas dowolny lub wcale nie ustawiony
            {
                numeryStron($totalPages);

                $y=1;
                for ($y; $y<=$totalPages; $y++)
                {
                    if ($pageNumber==$y)
                    {
                        // sortowanie po "Dowolne" + czas nieustawiony + nazwa nieustawiona + kategoria nieustawiona</br>';
                        $przepisyID4 = PrzepisQuery::create()
                                       ->select(array('IdPrzepis'))
                                       ->paginate($page = $y, $rowsPerPage = 10);

                        wypiszPrzepis($przepisyID4);
                    }
                }
            }
        }
      }
    }
}//zamkniecie ifa dla ustawionego sortowania


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
