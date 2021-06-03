<?php include 'session.php';
if(!isset($_SESSION['login']) || $_SESSION['level'] != 2) {
  header("Location: login.php");
}
 ?>
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
      <h1>Lista użytkowników</h1>
      <div class="content__list" id="search-results">
        <table>
          <tr>
            <th>
              Nazwa Użytkownika
            </th>
            <th>
              Liczba Przepisów
            </th>
            <th>
              Usuń
            </th>
          </tr>

          <?php
          require_once __DIR__.'/vendor/autoload.php';
          require_once __DIR__.'/generated-conf/config.php';

          $users = UzytkownikQuery::create()
                    ->select(array('Login'))
                    ->where('Uzytkownik.RodzajKonta = ?', 1)
                    ->where('Uzytkownik.Login NOT IN ?', 'Pyszniutkie.pl');


          foreach($users as $user)
          {
            echo '<tr>';
              echo '<td>';
                echo '<a href="przepisy_uzytkownika.php?userLogin='.$user.'">'.$user.'</a>';
              echo '</td>';

              $przepisy = PrzepisQuery::create()
                      ->select(array('Przepis.IdPrzepis'))
                      ->where('Przepis.UzytkownikLogin = ?', $user);

              $x=0;
              foreach($przepisy as $p)
              {
                $x++;
              }


              echo '<td>';
                echo $x;
              echo '</td>';
              echo '<td>';
                echo '<a href="user-delete.php?login='.$user.'" class="content__form__removeButton"><img src="img/x icon.png"></a>';
              echo '</td>';
            echo '</tr>';
          }
          ?>

        </table>
      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>
