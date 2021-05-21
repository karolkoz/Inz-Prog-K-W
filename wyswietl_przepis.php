<?php include 'session.php'; ?>
<html>

<head>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous"> -->
  <link rel="Stylesheet" type="text/css" href="style/css/style.css" />
  <meta charset="utf-8" />
  <title>Pyszniutkie.pl</title>
  <script src="jquery.min.js"></script>
  <script src="script-AJAX.js"></script>
</head>

<body>
  <main>
    <?php include 'nav.php' ?>

    <section class="content">
      <div class="content__recipe">
        <div class="content__recipe__row">
          <form class="content__recipe__element content__recipe__form" method="post" action="usun_przepis.php?przepisID=<?php echo $_GET['przepisID'] ?>">
            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $przepis = PrzepisQuery::create()->findPk($_GET['przepisID']);
            $wlascicielPrzepisu = $przepis->getUzytkownikLogin();

            if(isset($_SESSION['login']) && $wlascicielPrzepisu == $_SESSION['login'] || isset($_SESSION['login']) && $_SESSION['level']==2) {
                  echo '<button class="content__recipe__button content__recipe__button--remove" type="submit" name="przepis" value="10"><img src="img/x icon.png" />Usuń przepis</button>';
            }
            ?>
          </form>

          <form class="content__recipe__element content__recipe__form" method="post" action="edytuj_przepis.php?przepisID=<?php echo $_GET['przepisID'] ?>">
          <?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';

          $przepis = PrzepisQuery::create()->findPk($_GET['przepisID']);
          $wlascicielPrzepisu = $przepis->getUzytkownikLogin();

          if(isset($_SESSION['login']) && $wlascicielPrzepisu == $_SESSION['login']) {
                echo '<button class="content__recipe__button" type="submit" name="przepis" value="10"><img src="img/edit icon.png" />Edycja przepisu</button>';
          }
          ?>
          </form>

          <form class="content__recipe__element content__recipe__form">
          <div class="content__recipe__status">
            <?php
            $przepis = PrzepisQuery::create()->findPk($_GET['przepisID']);
            $wlascicielPrzepisu = $przepis->getUzytkownikLogin();

            if(isset($_SESSION['login']) && $_SESSION['level']==2) {
              if($przepis->getStatus() == 2) {
                echo '<button id="statusListButton" class="content__recipe__button" type="button"><img src="img/menu icon.png" />Status: Oczekujący</button>';
              }
              if($przepis->getStatus() == 1) {
                echo '<button id="statusListButton" class="content__recipe__button content__recipe__button--green" type="button"><img src="img/menu icon.png" />Status: Zatwierdzony</button>';
              }
              if($przepis->getStatus() == 0) {
                echo '<button id="statusListButton" class="content__recipe__button" type="button"><img src="img/menu icon.png" />Status: Do poprawy</button>';
              }
            }
            ?>
            <script src="script-ListaStatusow.js"></script>
            <div class="content__recipe__status__dropdown">
              <div class="content__recipe__status__list" id="list">
                <button id="1" onclick="changeStatus(this.id, <?php echo $przepis->getIdPrzepis(); ?>)" class="content__recipe__button content__recipe__button--green" type="button">
                  <img src="img/edit icon.png" />Zatwierdź
                </button>
                <button id="2" onclick="changeStatus(this.id, <?php echo $przepis->getIdPrzepis(); ?>)" class="content__recipe__button" type="button">
                  <img src="img/edit icon.png" />Oczekujący
                </button>
                <button id="0" onclick="changeStatus(this.id, <?php echo $przepis->getIdPrzepis(); ?>)" class="content__recipe__button" type="button">
                  <img src="img/edit icon.png" />Do poprawy
                </button>
              </div>
            </div>

          </div>
          </form>
        </div>
        <div class="content__recipe__row">
          <div class="content__recipe__element">

            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $id_przepis = $_GET['przepisID'];

            $przepis = PrzepisQuery::create()->findPk($id_przepis);
            echo '<h1 class="content__recipe__title">'.$przepis->getNazwa().'</h1>'; //wyswietla nazwe przepisu o id=24

            $userLogin = $przepis->getUzytkownikLogin();

            $userName = UzytkownikQuery::create()
                          ->filterByLogin($userLogin)
                          ->select(array('Uzytkownik.Nazwa'))
                          ->findOne();

            echo '<h2 class="content__recipe__author">Autor przepisu: <i>'.$userName.'</i></h2>'; //wyswietlanie nazwy uzytkownika (wyfiltrowanej po jego loginie (PK))
            // echo '<h2 class="content__recipe__author">Autor przepisu: <i>'.$przepis->getUzytkownikLogin().'</i></h2>'; //wyswietla login autora przepisu o id=24

            ?>

          </div>
        </div>

        <div class="content__recipe__row">
          <div class="content__recipe__element">
            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $przepis = PrzepisQuery::create()->findPk($id_przepis);
            $fp = $przepis->getZdjecieOgolne();
            if ($fp !== null) {
              // echo '<img class="content__recipe__image" src="'.stream_get_contents($fp).'" />';
              echo '<img class="content__recipe__image" src="data:image/jpg;charset=utf8;base64,'.base64_encode(stream_get_contents($fp)).'" />';
            }
            else{
              echo '<img class="content__recipe__image" src="img/placeholder icon.png" />';
            }

            ?>
            <div class="content__recipe__buttons">
              <?php
              require_once __DIR__.'/vendor/autoload.php';
              require_once __DIR__.'/generated-conf/config.php';

              if(isset($_SESSION['login'])) {
                $userLogin = $_SESSION['login'];
                $ulubione = UlubioneQuery::create()
                            ->where('Ulubione.PrzepisIdPrzepis = ?', $id_przepis)
                            ->where('Ulubione.UzytkownikLogin = ?', $userLogin)
                            ->find();

                if(count($ulubione)==0)
                {
                echo '<button id="favourite" onclick="addFavourite('.$id_przepis.', &#039'.$_SESSION['login'].'&#039)" class="content__recipe__button--favourite">
                  <span>Ulubione</span><img id="favouriteImg" src="img/star black icon.png" />
                </button>';
                }
                else
                {
                echo '<button id="favourite" onclick="addFavourite('.$id_przepis.', &#039'.$_SESSION['login'].'&#039)" class="content__recipe__button--favourite--active">
                  <span>Ulubione</span><img id="favouriteImg" src="img/confirm icon.png" />
                </button>';
                }

              } else {
                echo '<a href="login.php" id="favourite" class="content__recipe__button--favourite">
                  <span>Ulubione</span><img id="favouriteImg" src="img/star black icon.png" />
                </a>';
              }

              if(isset($_SESSION['login'])) {
                $userLogin = $_SESSION['login'];
                $lubieTo = Lubie_toQuery::create()
                            ->where('Lubie_to.PrzepisIdPrzepis = ?', $id_przepis)
                            ->where('Lubie_to.UzytkownikLogin = ?', $userLogin)
                            ->find();

                if(count($lubieTo)==0)
                {
                echo '<button id="like" onclick="addLike('.$id_przepis.', &#039'.$_SESSION['login'].'&#039)" class="content__recipe__button--like">
                  <span id="likeText">Lubię to!</span><img src="img/like white.png" />
                </button>';
                }
                else
                {
                  echo '<button id="like" onclick="addLike('.$id_przepis.', &#039'.$_SESSION['login'].'&#039)" class="content__recipe__button--like--active">
                    <span id="likeText">Lubisz to!</span><img src="img/like white.png" />
                  </button>';
                }

              } else {
                echo '<a href="login.php" id="like" class="content__recipe__button--like">
                  <span>Lubię to!</span><img src="img/like white.png" />
                </a>';
              }
              ?>

            </div>
          </div>

          <div class="content__recipe__element">

            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $przepis = PrzepisQuery::create()->findPk($id_przepis);
            echo '<p class="content__recipe__element__desc">'.$przepis->getOpis().'</p>'; //wyswietla opis przepisu o id=24

            ?>

            <div class="content__recipe__stats">
              <div class="content__recipe__stats__element">
                <img src="img/people icon.png" />

                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $przepis = PrzepisQuery::create()->findPk($id_przepis);
                echo '<span>'.$przepis->getDlaIluOsob().'</span>';

                ?>

              </div>
              <div class="content__recipe__stats__element">
                <img src="img/clock icon.png" />

                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $przepis = PrzepisQuery::create()->findPk($id_przepis);
                echo '<span>'.$przepis->getCzasPrzygotowania().' min.'.'</span>';

                ?>

              </div>
              <div class="content__recipe__stats__element">
                <img src="img/difficulty icon.png" />

                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $przepis = PrzepisQuery::create()->findPk($id_przepis);

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
                <?php
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/generated-conf/config.php';

                $lubieTo = Lubie_toQuery::create()
                            ->filterByPrzepisIdPrzepis($id_przepis)
                            ->find();
                $ileLike=0;
                foreach($lubieTo as $l)
                {
                  $ileLike++;
                }

                echo '<span id="likeNum">'.$ileLike.'</span>';
                ?>
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
                      ->where('Przepis.IdPrzepis = ?', $id_przepis)
                      ->select(array('Skladniki.Nazwa'))
                      ->find();

              $num = count($zawieraNazwa);  //zlicza ilosc skladnikow dla przepisu o zadanym id w warunku where

              $zawieraIlosc = ZawieraQuery::create()
                      ->join('Przepis')
                      ->join('Skladniki')
                      ->where('Przepis.IdPrzepis = ?', $id_przepis)
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
                                ->where('Przepis.IdPrzepis = ?', $id_przepis)
                                ->select(array('NrEtapu'))
                                ->find();

                        $num2 = count($etapyNr);  //zlicza ilosc etapow dla przepisu o zadanym id w warunku where

                        $etapyOpis = EtapQuery::create()
                                ->join('Przepis')
                                ->where('Przepis.IdPrzepis = ?', $id_przepis)
                                ->select(array('Opis'))
                                ->find();

                        $etap = EtapQuery::create()
                                ->filterByPrzepisIdPrzepis($id_przepis)
                                ->select(array('Zdjecie'))
                                ->find();

                        $x=0;

                          foreach($etap as $et){
                          if($et !== null){
                            $e=$etap->get($x);
                            echo '<div class="content__recipe__stage">';
                            echo '<h2>Etap '.$etapyNr->get($x).'</h2>';
                          // echo '<img class="content__recipe__image" src="data:image/jpg;charset=utf8;base64,'.base64_encode(stream_get_contents($e)).'" />';
                          // echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($x).'</p><img src="'.$e.'" /></div>';
                          echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($x).'</p><img src="data:image/jpg;charset=utf8;base64,'.base64_encode($e).'" /></div>';



                          echo '</div>';
                          }
                          else{
                            echo '<div class="content__recipe__stage">';
                            echo '<h2>Etap '.$etapyNr->get($x).'</h2>';
                            echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($x).'</p><img src="img/placeholder icon.png" /></div>';
                            echo '</div>';
                          }
                          $x++;
                        }

                        ?>

          </div>
        </div>
      </div>
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
