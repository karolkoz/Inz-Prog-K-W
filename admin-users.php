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
          <tr>
            <td>
              <a href="przepisy_uzytkownika.php">111111567805436685434111111567805436685434</a>
            </td>
            <td>
              ile przepisów
            </td>
            <td>
              <a href="#" class="content__form__removeButton"><img src="img/x icon.png"></a>
            </td>
          </tr>
          <tr>
            <td>
              <a href="przepisy_uzytkownika.php">Nazwa Uzytkownika</a>
            </td>
            <td>
              ile przepisów
            </td>
            <td>
              <a href="#" class="content__form__removeButton"><img src="img/x icon.png"></a>
            </td>
          </tr>
        </table>
      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>
