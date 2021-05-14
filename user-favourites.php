<?php include 'session.php';
if(!isset($_SESSION['login'])) {
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
      <h1>Twoje ulubione przepisy</h1>
      <div class="content__elements" id="search-results">

      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>
