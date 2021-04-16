<html>

<head>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous"> -->
  <link rel="Stylesheet" type="text/css" href="style/css/style.css" />
  <meta charset="utf-8" />
</head>

<body>
  <main>
    <nav>
      <div class="nav__name">
        <a href="index.php"> Pyszniutkie.pl</a>
      </div>
      <div class="nav__menu">
        <div class="nav__list">
          <a href="dodaj_przepis.php" class="nav__list__button nav__list__button--plus"></a>
          <a href="#" class="nav__list__button nav__list__button--fav"></a>
          <a href="#" class="nav__list__button nav__list__button--user"></a>
        </div>
      </div>
    </nav>

    <section class="content">
      <div class="content__recipe">
        <div class="content__recipe__row">
          <form class="content__recipe__element content__recipe__form" method="post" action="usun_przepis.php">
              <button class="content__recipe__button content__recipe__button--remove" type="submit" name="przepis" value="10"><img src="img/x icon.png" />Usuń przepis</button>
          </form>
            <form class="content__recipe__element content__recipe__form" method="post" action="edytuj_przepis.php">
                <button class="content__recipe__button" type="submit" name="przepis" value="10"><img src="img/edit icon.png" />Edycja przepisu</button>
            </form>
        </div>
        <div class="content__recipe__row">
          <div class="content__recipe__element">

            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $przepis = PrzepisQuery::create()->findPk(1);
            echo '<h1 class="content__recipe__title">'.$przepis->getNazwa().'</h1>'; //wyswietla nazwe przepisu o id=24
            echo '<h2 class="content__recipe__author">Autor przepisu: <i>'.$przepis->getUzytkownikLogin().'</i></h2>'; //wyswietla login autora przepisu o id=24

            ?>

          </div>
        </div>

        <div class="content__recipe__row">
          <div class="content__recipe__element">
            <img class="content__recipe__image" src="img/placeholder icon.png" />
            <div class="content__recipe__buttons">
              <button class="content__recipe__button--favourite"><span>Ulubione </span> <img src="img/star black icon.png" /></button>
              <button class="content__recipe__button--like"><span>Lubię to!</span><img src="img/like white.png" /></button>
            </div>
          </div>
          <div class="content__recipe__element">

            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $przepis = PrzepisQuery::create()->findPk(1);
            echo '<p class="content__recipe__element__desc">'.$przepis->getOpis().'</p>'; //wyswietla opis przepisu o id=24

            ?>

            <div class="content__recipe__stats">
              <div class="content__recipe__stats__element">
                <img src="img/people icon.png" />

                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $przepis = PrzepisQuery::create()->findPk(1);
                echo '<span>'.$przepis->getDlaIluOsob().'</span>';

                ?>

              </div>
              <div class="content__recipe__stats__element">
                <img src="img/clock icon.png" />

                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $przepis = PrzepisQuery::create()->findPk(1);
                echo '<span>'.$przepis->getCzasPrzygotowania().' min.'.'</span>';

                ?>

              </div>
              <div class="content__recipe__stats__element">
                <img src="img/difficulty icon.png" />

                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $przepis = PrzepisQuery::create()->findPk(1);

                if ($przepis->getStopienTrudnosci()>0 && $przepis->getStopienTrudnosci()<4) {
                    echo '<span>'.'łatwy'.'</span>';
                }
                if ($przepis->getStopienTrudnosci()>=4 && $przepis->getStopienTrudnosci()<8) {
                    echo '<span>'.'średni'.'</span>';
                }
                if ($przepis->getStopienTrudnosci()>=8 && $przepis->getStopienTrudnosci()<=10) {
                    echo '<span>'.'trudny'.'</span>';
                }

                ?>

              </div>
              <div class="content__recipe__stats__element">
                <img src="img/like green.png" />
                <span>325</span>
              </div>
            </div>
          </div>
        </div>
        <div class="content__recipe__row">
          <div class="content__recipe__element">
            <h2 class="content__recipe__h2">Lista Składników</h2>
            <table class="content__recipe__ingredientsTable">
<!-- //////////////////////////////////////////////////////////////////////////////wyswietlanie skladnikow i ilosci//////////////////////////////// -->
              <?php
              require_once __DIR__.'/vendor/autoload.php';
              require_once __DIR__.'/generated-conf/config.php';

              $zawieraNazwa = ZawieraQuery::create()
                      ->join('Przepis')
                      ->join('Skladniki')
                      ->where('Przepis.IdPrzepis = ?', 1)
                      ->select(array('Skladniki.Nazwa'))
                      ->find();

              $num = count($zawieraNazwa);  //zlicza ilosc skladnikow dla przepisu o zadanym id w warunku where

              $zawieraIlosc = ZawieraQuery::create()
                      ->join('Przepis')
                      ->join('Skladniki')
                      ->where('Przepis.IdPrzepis = ?', 1)
                      ->select(array('Ilosc'))
                      ->find();
///sprawdzic ile jest skladnikow dla danego przepisu i stworzyc zmienna ktora bedzie przechowywac ta ilosc
//utworzyc petle for zaczynajac od 0 do wartosci tej zmiennej powyzej i podstawiac odpowiednio pod ->get(numer z petli for)
//get indeksuje od 0 (get(0)-pierwszy skladnik)

              $i;
              for($i=0; $i<$num; $i++){
              echo '<tr><td>'.$zawieraNazwa->get($i).'</td><td>'.$zawieraIlosc->get($i).'</td></tr>';
              }

              ?>

            </table>

          </div>
          <div class="content__recipe__element">
            <h2 class="content__recipe__h2">Przygotowanie</h2>

            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $etapyNr = EtapQuery::create()
                    ->join('Przepis')
                    ->where('Przepis.IdPrzepis = ?', 1)
                    ->select(array('NrEtapu'))
                    ->find();

            $num2 = count($etapyNr);  //zlicza ilosc etapow dla przepisu o zadanym id w warunku where

            $etapyOpis = EtapQuery::create()
                    ->join('Przepis')
                    ->where('Przepis.IdPrzepis = ?', 1)
                    ->select(array('Opis'))
                    ->find();

            $j;
            for($j=0; $j<$num2; $j++){
              echo '<div class="content__recipe__stage">';
              echo '<h2>Etap '.$etapyNr->get($j).'</h2>';
              echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="img/placeholder icon.png" /></div>';
              echo '</div>';
            }

            ?>

          </div>
        </div>
      </div>
    </section>


    <footer>
      footer
    </footer>

  </main>






  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script> -->
</body>

</html>
