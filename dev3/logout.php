<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php
session_start();
session_unset();
session_destroy();
header("location:login.php");
?>