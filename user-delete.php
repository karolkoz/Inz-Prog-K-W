<?php

//Tutaj sprawdzamy czy jest aktywna sesja
//Jeśli jest, to usuwamy konto pobrane z sesji
//Potem zamykamy sesje i przenosimy na strone główną
echo '<script type="text/javascript">
  window.location = "index.php";
</script>'
 ?>
