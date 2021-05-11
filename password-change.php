<?php
include 'session.php';
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
     <form class="content__form content__form--login" id="userNameChange" method="post" action="password-change.php" onsubmit="return change_password_validation()">
       <h1>Formularz zmiany hasła</h1>
       <div class="content__form__input">
         <input type="password" id="currentPassword" name="currentPassword" placeholder="Wpisz obecne hasło" onchange="password_validation('currentPassword')" required />
       </div>
       <div class="content__form__input">
         <input type="password" id="newPassword" name="newPassword" placeholder="Wpisz nowe hasło" onchange="password_validation('newPassword')" required />
       </div>
       <div class="content__form__input">
         <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Potwierdź hasło" onchange="password_validation('confirmPassword')" required />
       </div>
       <div class="content__form__button content__form__button--login">
         <button type="submit"> Zmień hasło</button>
       </div>
       <script src="script-Haslo.js"></script>
       <?php
       require_once __DIR__.'/vendor/autoload.php';
       require_once __DIR__.'/generated-conf/config.php';

          if(!isset($_POST['currentPassword']) || !isset($_POST['newPassword']) || !isset($_POST['confirmPassword'])) {
            echo 'Nie wprowadzono danych!';
          }
          else if(isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword']))
          {
            $sendedCurrentPassword = $_POST['currentPassword'];
            $userLogin = $_SESSION['login'];
            $user = UzytkownikQuery::create()
                          ->filterByLogin($userLogin)
                          ->findOne();
            $currentPasswd = $user->getHaslo();

            if(password_verify($sendedCurrentPassword, $currentPasswd))
            {
              echo ' obecne haslo podane prawidlowo!';
              $sendedNewPasswd = $_POST['newPassword'];
              $sendedConfirmPasswd = $_POST['confirmPassword'];

              if($sendedNewPasswd == $sendedConfirmPasswd)
              {
                echo ' nowe hasla podane prawidlowo!';
                $passwd_hash = password_hash($sendedNewPasswd, PASSWORD_BCRYPT);
                $user->setHaslo($passwd_hash);
                $user->save();
                header("Location: user.php");
              }
              // else
              // {
              //   echo ' zle podane nowe hasla!';
              // }
            }
            else
            {
              echo 'Błędnie podane obecne haslo!';
            }
          }
       ?>
     </form>

   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
