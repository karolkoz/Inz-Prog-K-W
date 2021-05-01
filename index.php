 <?php
 if (isset($_COOKIE['sortowanie'])) {
  setcookie("sortowanie", null);
  }

  if (isset($_COOKIE['czas'])) {
   setcookie("czas", null);
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
                foreach($kategorie as $kat) {
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

      </div>

<?php
echo ' </br> Witaj na stronie Pyszniutkie.pl !!! </br>';
echo ' </br> Tysiące pomysłów na dania, każdy znajdzie coś dla siebie! </br>';
?>





      <!-- <?php
      //id, nazwa, ile lajków, czas, osoby, trudnosc, obrazek(taki sam sposób jak był do etapów podawany)
      require_once __DIR__.'/vendor/autoload.php';
      require_once __DIR__.'/generated-conf/config.php';

      $pID = PrzepisQuery::create()
        ->select(array('IdPrzepis'))
        ->find();

      $ileID = count($pID); //ilosc wszystkich przepisow w bazie
      $rowsPerPage = 5; //ilosc przepisow wyswietlanych na jednej stronie
      $totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron



    echo '</div>
    <div class="content__search-counter" id="search-counter">';
      $num=1;
      for($num; $num<=$totalPages; $num++)
      {
        echo '<div class="content__search-counter__element"><a href="searchDB.php?currentPage='.$num.'">'.$num.'</a></div>';
      }
    echo '</div>
    <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>';


////////////////////////////////////////////////////////////////////////////////////////////////////
//////----------OD TEGO MIEJSCA WYSWIETLANIE WSZSYTKICH PRZEPISOW Z BAZY DANYCH-----------------////
////////////////////////////////////////////////////////////////////////////////////////////////////

      $przepisyID = PrzepisQuery::create()
              ->select(array('IdPrzepis'))
              ->paginate($page = 1, $rowsPerPage = 5);


      foreach($przepisyID as $ID)
      {
        $pDane = PrzepisQuery::create()->findPk($ID);
        $zdj = $pDane->getZdjecieOgolne();
        if ($zdj !== null) {
          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
        }
        else{
          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
        }
      }




      ?> -->
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
