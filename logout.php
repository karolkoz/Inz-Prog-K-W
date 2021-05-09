<?php
session_start();
if(isset($_SESSION['login'])) {
  $_SESSION = array();
  session_destroy();
  echo 'Sesja zniszczona';
}
echo '<script type="text/javascript">
  window.location = "index.php";
</script>';
 ?>
