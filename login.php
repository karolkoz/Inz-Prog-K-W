<?php
 if (isset($_COOKIE['sortowanie'])) {
     setcookie("sortowanie", null);
 }

 if (isset($_COOKIE['czas'])) {
     setcookie("czas", null);
 }

 if (isset($_COOKIE['przepis'])) {
     setcookie("przepis", null);
 }

///////////////kategorie///////////

 if (isset($_COOKIE['categories'])) {
     // foreach ($_COOKIE['categories'] as $name_categories)
     // {
     //   setcookie("kategoria", null);
     // }
     setcookie("kategoria", null);
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
     <form class="content__form content__form--login" id="login_form" method="post" action="login.php">
       <h1>Formularz logowania</h1>
       <div class="content__form__input">
         <input type="text" id="login" name="login" placeholder="login" required />
       </div>
       <div class="content__form__input">
         <input type="password" id="password" name="password" placeholder="haslo" onchange="password_validation('password')" required />
       </div>
       <div class="content__form__button content__form__button--login">
         <button type="submit"> Zaloguj</button>
       </div>
       <div class="content__form__link">
         <a href="register.php">Nie masz konta? Zarejestruj się</a>
       </div>
       <script src="script-Haslo.js"></script>
     </form>

   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
