<?php
session_start();
if (isset($_SESSION['username'])) {
    echo '欢迎您，'.$_SESSION["username"];
}
?>
<br>
<a href="login.php">注销</a>
