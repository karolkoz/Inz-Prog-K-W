<html>

<head>
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

          echo '<input type="text" id="nazwa" name="nazwa" placeholder="Nazwa" value="'.$przepis->getNazwa().'" onchange="name_validation()" maxlength="40" required />'

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
            for($i=10; $i>=1; $i--) {
              if($przepis->getStopienTrudnosci()==$i) {
                echo '<input type="radio" id="trudnosc'.$i.'" name="trudnosc" value="'.$i.'" checked />
                <label for="trudnosc'.$i.'"></label>';
              } else {
                echo '<input type="radio" id="trudnosc'.$i.'" name="trudnosc" value="'.$i.'" />
                <label for="trudnosc'.$i.'"></label>';
              }
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

</body>

</html>
