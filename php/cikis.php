<?php
session_start();


session_destroy();   
session_unset(); 
unset($_SESSION['id']);
//çıkış yaptığında giriş sayfasına tekrar dönecek
header("Location: giris.php");
?>