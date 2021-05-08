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
     <form class="content__form content__form--login" id="login_form" method="post" action="register.php">
       <h1>Formularz rejestracji</h1>
       <div class="content__form__input">
         <input type="text" id="login" name="login" placeholder="login" required />
       </div>
       <div class="content__form__input">
         <input type="password" id="password" name="password" placeholder="haslo" onchange="password_validation('password')" required />
       </div>
       <div class="content__form__input">
         <input type="text" id="name" name="name" placeholder="Nazwa użytkownika" required />
       </div>
       <div class="content__form__button content__form__button--login">
         <button type="submit"> Zarejestruj</button>
       </div>
       <script src="script-Haslo.js"></script>
       <?php
          if(isset($_POST['login'])) {
            $login = $_POST['login'];
            echo 'Nowy login = '.$login.'</br>';
          } else {
            echo 'Błąd';
          }
       ?>
     </form>

   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
