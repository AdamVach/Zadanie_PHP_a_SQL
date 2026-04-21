<?php
session_start();
setcookie("logged", "0", time() - 3600*24);
session_destroy();
header("Location: index.php");
exit();
?>