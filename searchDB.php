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
      <form class="search__form" action="searchDB.php" method="post">
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
            <option value="45">45 min</option>
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
        <!-- <div class="content__element">
          <div class="content__element__left">
            <img src="img/placeholder icon.png" />
          </div>
          <div class="content__element__right">
            <a href="wyswietl_przepis.php?przepisID=14" class="content__element__right__title">Dzika Kaczka po kaszubsku w panierce ziołowej z kartoflami</a>
            <div class="content__element__right__data">
              <div class="content__element__right__data__part">
                <img src="img/like green.png" /> 325
              </div>
              <div class="content__element__right__data__part">
                <img src="img/clock icon.png" /> 50 min.
              </div>
            </div>
            <div class="content__element__right__data">
              <div class="content__element__right__data__part">
                <img src="img/people icon.png" /> 4
              </div>
              <div class="content__element__right__data__part">
                <img src="img/difficulty icon.png" /> Trudne
              </div>
            </div>
          </div>
        </div> -->

      </div>
      <div class="content__search-counter">
        <div class="content__search-counter__element">
          <a href="searchDB.php?currentPage=1">1</a>
        </div>
        <div class="content__search-counter__element">
          <a href="searchDB.php?currentPage=2">2</a>
        </div>
        <div class="content__search-counter__element">
          <a href="searchDB.php?currentPage=3">3</a>
        </div>
        <div class="content__search-counter__element">
          <a href="searchDB.php?currentPage=4">4</a>
        </div>
      </div>
      <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>
      <?php
      //id, nazwa, ile lajków, czas, osoby, trudnosc, obrazek(taki sam sposób jak był do etapów podawany)
      require_once __DIR__.'/vendor/autoload.php';
      require_once __DIR__.'/generated-conf/config.php';


////////////////////////////////////////////////////////////////////////////////////////////////////
//////-------OD TEGO MIEJSCA WYSWIETLANIE (stronnicowane) PRZEPISOW Z BAZY DANYCH---------------////
////////////////////////////////////////////////////////////////////////////////////////////////////


$pageNumber = $_GET['currentPage'];

$pID = PrzepisQuery::create()
        ->select(array('IdPrzepis'))
        ->find();

$ileID = count($pID); //ilosc wszystkich przepisow w bazie
$rowsPerPage = 5; //ilosc przepisow wyswietlanych na jednej stronie
$totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron

///test wyswietlania ilosci przepisow na stronie///
$y=1;
for($y; $y<=$totalPages; $y++)
{
if($pageNumber==$y)
{
  $przepisyID = PrzepisQuery::create()
          ->select(array('IdPrzepis'))
          ->paginate($page = $y, $rowsPerPage = 5);
          //->find();

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
