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

    <section class="content">
      <form class="content__form" id="form" onsubmit="return form_validation()" action="edytuj_przepisDB.php?przepisID=<?php echo $_GET['przepisID'] ?>" method="post" enctype="multipart/form-data">
        <div id="formImagesInfo">

        </div>
        <h1>Formularz edytowania przepisu</h1>
        <div class="content__form__input">
          <?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';
          $id_przepis = $_GET['przepisID'];
          $przepis = PrzepisQuery::create()->findPk($id_przepis);

          echo '<input type="text" id="nazwa" name="nazwa" placeholder="Nazwa" value="'.$przepis->getNazwa().'" onchange="name_validation()" required />'

          // $nazwa = "Jakas nazwa";
          // echo '<input type="text" id="nazwa" name="nazwa" placeholder="Nazwa" value="'.$nazwa.'" />'
          ?>
        </div>
        <div class="content__form__input">
          <img src="img/difficulty icon.png" />
          <div class="content__form__rating">
            <!--Wyświetl te inputy i labele za pomocą php
            w takiej kolejności jak tutaj jest (tzn od 10 do 1)
            Przy opcji, która jest wybrana w przepisie dodaj
            słowo "checked"
            np.: <input type="radio" id="trudnosc7" name="trudnosc" value="7" checked />
            -->
            <?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $przepis = PrzepisQuery::create()->findPk($id_przepis);
            //echo $przepis->getStopienTrudnosci();

            if($przepis->getStopienTrudnosci()==1){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2" />
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" checked  />
              <label for="trudnosc1"></label>';
            }

            if($przepis->getStopienTrudnosci()==2){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2" checked />
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }



            if($przepis->getStopienTrudnosci()==3){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3"  checked />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }

            if($przepis->getStopienTrudnosci()==4){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" checked />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }

            if($przepis->getStopienTrudnosci()==5){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" checked />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }

            if($przepis->getStopienTrudnosci()==6){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6" checked  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }

            if($przepis->getStopienTrudnosci()==7){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" checked />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }

            if($przepis->getStopienTrudnosci()==8){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" checked />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }


            if($przepis->getStopienTrudnosci()==9){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" checked />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }


            if($przepis->getStopienTrudnosci()==10){
              echo '<input type="radio" id="trudnosc10" name="trudnosc" value="10" checked />
              <label for="trudnosc10"></label>
              <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
              <label for="trudnosc9"></label>
              <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
              <label for="trudnosc8"></label>
              <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
              <label for="trudnosc7"></label>
              <input type="radio" id="trudnosc6" name="trudnosc" value="6"  />
              <label for="trudnosc6"></label>
              <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
              <label for="trudnosc5"></label>
              <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
              <label for="trudnosc4"></label>
              <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
              <label for="trudnosc3"></label>
              <input type="radio" id="trudnosc2" name="trudnosc" value="2"/>
              <label for="trudnosc2"></label>
              <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
              <label for="trudnosc1"></label>';
            }

            ?>
          </div>
        </div>
        <div class="content__form__input">
          <img src="img/people icon.png" />
          <?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';
          // $id_przepis = 11;
          $przepis = PrzepisQuery::create()->findPk($id_przepis);

          echo '<input type="number" id="ile_osob" name="ile_osob" placeholder="Dla ilu osób" value="'.$przepis->getDlaIluOsob().'" required />'

          ?>

        </div>
        <div class="content__form__input">
          <img src="img/clock icon.png" /><?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';
          $przepis = PrzepisQuery::create()->findPk($id_przepis);

          echo '<input type="number" id="czas_przygotowania" name="czas_przygotowania" placeholder="Czas przygotowania w minutach" value="'.$przepis->getCzasPrzygotowania().'" required />'
          ?>
        </div>
        <div class="content__form__input">
          <?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';
          // echo '<textarea name="opis" id="opis" placeholder="Opis przepisu"></textarea>';

          $przepis = PrzepisQuery::create()->findPk($id_przepis);

          echo '<textarea name="opis" id="opis" placeholder="Opis przepisu" required >'.$przepis->getOpis().'</textarea>';
          ?>
        </div>

        <div class="content__form__inputImage">
          <img class="content__form__uploadedMainImage" id="uploadedMainImage" src="img/placeholder icon.png"/>
          <button id="removeMainImage" type="button" class="content__form__removeButton" onClick="deleteMainImage()">
            <img src="img/x icon.png">
          </button>
        </div>

        <div class="content__form__input">
          <label class="form__label__forImage" for="image">
            <img src="img/image icon.png" />
            Dodaj obrazek do przepisu!
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" onchange="loadMainImage(event)" />
          </label>
        </div>

        <div class="content__form__dynamicInputs" id="categories">
          <h2>Kategorie</h2>
          <script type="text/javascript" src="script - Categories.js"></script>
          <div class="content__form__category" id="category_1">
            <select name="categories[]" onchange="category_validation()" required>
              <option value=""disabled selected>Kategoria</option>

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
          <!--Tutaj masz przykład użycia tych funkcji.
          Po prostu je wywołuj w pętli dodając nowe Kategorie i zaznaczaj odpowiednie opcje/

          Pierwszą kategorię zawsze powinnaś robić "ręcznie" jak wyżej, ale pozostałe
          już musisz dodawać funkcją tak jak poniżej. Wybieranie również powinnaś funkcjami robić -->
          <?php
          //echo '<script type="text/javascript">addCategory()</script>';
          //Pierwszy parametr to numer kategorii na stronie, drugi to numer opcji do zaznaczenia
          //na liście. Numeruj zgodnie z kolejnościa wyświetlania na liście czyli Fit=0, Kolacja=1 itd.
          //echo '<script type="text/javascript">CategorySelect(2, "Fit")</script>';
          ?>


          <?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';

          $nalezyNazwa = NalezyQuery::create()
                  ->join('Przepis')
                  ->join('Kategoria')
                  ->where('Przepis.IdPrzepis = ?', $id_przepis)
                  ->select(array('Kategoria.Nazwa'))
                  ->find();
          $num = count($nalezyNazwa);
          //echo 'Przepis te nalezy do '.$num.' kategorii.';

          // echo '<script type="text/javascript">addCategory()</script>';
          $i;
          $j=1;

          echo '<script type="text/javascript" charset="utf-8">CategorySelect('.$j.', "'.$nalezyNazwa->get(0).'")</script>';
          for($i=1; $i<$num; $i++){
            $poz = $i+1;
          echo '<script type="text/javascript">addCategory()</script>';
          echo '<script type="text/javascript">CategorySelect('.$poz.', "'.$nalezyNazwa->get($i).'")</script>';
          //echo ' dodano '.$nalezyNazwa->get($i);
          $j++;
          }
          ?>




          <div id="categoryButtonDiv" class="content__form__button">
            <button id="categoryButton" type="button" onClick="addCategory()" > <img src="img/plus icon.png" /> Dodaj nową kategorię</button>
          </div>
        </div>

        <div class="content__form__dynamicInputs" id="ingredients">
          <h2>Lista Składników</h2>
          <div id="ingredientButtonDiv" class="content__form__button">
            <button id="ingredientButton" type="button" onClick="addIngredient()" > <img src="img/plus icon.png" /> Dodaj nowy składnik</button>
          </div>
        </div>

        <div class="content__form__dynamicInputs" id="stages">
          <div id="buttonDiv" class="content__form__button">
            <button id="button" type="button" onClick="addStage()" > <img src="img/plus icon.png" /> Dodaj nowy etap</button>
          </div>
        </div>
        <div class="content__form__button content__form__button--submit">
          <button type="submit" onmouseover="checkImages()"> Zmień przepis</button>
        </div>
        <script type="text/javascript" src="script-EdytowaniePrzepisu.js"></script>
        <!-- PHP musi wywoływać funkcje po wcześniejszym
        załączeniu tego mojego skryptu JS, bo inaczej
        nie będzie ich widzieć.

        Wszystkie etapy można dodać funkcją z javascripta, więc etapu 1 nie musisz robić ręcznie.
        Składniki tak samo.
        -->
        <?php
        require_once __DIR__.'/vendor/autoload.php';
        require_once __DIR__.'/generated-conf/config.php';

        $przepis = PrzepisQuery::create()->findPk($id_przepis);
        $fp = $przepis->getZdjecieOgolne();
        if ($fp !== null) {
          echo '<script type="text/javascript">loadMainImageDB("'.base64_encode(stream_get_contents($fp)).'");</script>';
        }



        ///////////////////////////////////////////////////////////////wyswietlaja sie odpowiednie etapy (z bazy dla danego przepisu)
        $etapyOpis = EtapQuery::create()
                ->join('Przepis')
                ->where('Przepis.IdPrzepis = ?', $id_przepis)
                ->select(array('Opis'))
                ->find();

        $num4 = count($etapyOpis);

        $etap = EtapQuery::create()
                ->filterByPrzepisIdPrzepis($id_przepis)
                ->select(array('Zdjecie'))
                ->find();

                $x=0;

                  foreach($etap as $et){
                  if($et !== null){
                    $e=$etap->get($x);
                    echo '<script type="text/javascript">addStage("'.$etapyOpis->get($x).'", "'.base64_encode($e).'");</script>';
                  }
                  else{
                    echo '<script type="text/javascript">addStage("'.$etapyOpis->get($x).'", "'.null.'");</script>';
                  }
                  $x++;
                }



        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $etap = EtapQuery::create()
        //         ->filterByPrzepisIdPrzepis(2)
        //         ->select(array('Zdjecie'))
        //         ->find();
        // $e=$etap->get(2);
        // $tresc = 'Etap z obrazkiem';
        // echo '<script type="text/javascript">addStage("'.$tresc.'", "'.base64_encode($e).'");</script>';
        // $tresc = 'Etap bez obrazka';
        // echo '<script type="text/javascript">addStage("'.$tresc.'", "'.null.'");</script>';
        // $tresc = 'Etap z obrazkiem';
        // echo '<script type="text/javascript">addStage("'.$tresc.'", "'.base64_encode($e).'");</script>';
        // $tresc = 'Etap z obrazkiem';
        // echo '<script type="text/javascript">addStage("'.$tresc.'", "'.base64_encode($e).'");</script>';

        ///////////////////////////////////////////////wyswietlaja sie odpowiednie skladniki z iloscia (z bazy dla danego przepisu)
        $zawieraNazwa = ZawieraQuery::create()
                ->join('Przepis')
                ->join('Skladniki')
                ->where('Przepis.IdPrzepis = ?', $id_przepis)
                ->select(array('Skladniki.Nazwa'))
                ->find();

        $num3 = count($zawieraNazwa);  //zlicza ilosc skladnikow dla przepisu o zadanym id w warunku where

        $zawieraIlosc = ZawieraQuery::create()
                ->join('Przepis')
                ->join('Skladniki')
                ->where('Przepis.IdPrzepis = ?', $id_przepis)
                ->select(array('Ilosc'))
                ->find();

                $ii;
                for($ii=0; $ii<$num3; $ii++){
                  echo '<script type="text/javascript">addIngredient("'.$zawieraNazwa->get($ii).'", "'.$zawieraIlosc->get($ii).'");</script>';
                // echo '<tr><td>'.$zawieraNazwa->get($ii).'</td><td>'.$zawieraIlosc->get($ii).'</td></tr>';
                }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // $skladnik = 'skladnik';
        // $ilosc = 'ile';
        // echo '<script type="text/javascript">addIngredient("'.$skladnik.'", "'.$ilosc.'");</script>';

        ?>
      </form>
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
