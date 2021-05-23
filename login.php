<?php
include 'session.php';
if(isset($_SESSION['login'])) {
  header("Location: user.php");
}

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
         <input type="text" id="login" name="login" onchange="login_validation('login')" placeholder="login" required />
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
       <?php
       require_once __DIR__.'/vendor/autoload.php';
       require_once __DIR__.'/generated-conf/config.php';
         if(isset($_POST['login'])) {
           $login = $_POST['login'];
           $checkLogin = UzytkownikQuery::create()
           ->filterByLogin($login)
           ->find();
           if(count($checkLogin) == 1) {
             $user = UzytkownikQuery::create()->findPk($login);
             $userPassword = $user->getHaslo();
             if(isset($_POST['password'])) {
               $passwd = $_POST['password'];
               if(password_verify($passwd, $userPassword)) {
                 $_SESSION['login'] = $login;
                 $_SESSION['name'] = $user->getNazwa();
                 $_SESSION['level'] = $user->getRodzajKonta();
                 if($_SESSION['level'] == 1) {
                   header("Location: user.php");
                 } else if($_SESSION['level'] == 2) {
                   header("Location: admin.php");
                 }

               } else {
                 echo 'Zle haslo!';
               }
             }
           } else {
             echo 'Nie ma takiego loginu!';
           }
         }
       ?>
     </form>
   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
