<?php
session_start();
include_once("baglan.php");

if (@$_REQUEST["adisoyadi"] && @$_REQUEST["sifre"]) {
//sha512 ile şifreleme yaptık
$sifrele=hash('sha512', $_REQUEST["sifre"]);
//giris yaparken veritabanındaki bilgiyi seçmemiz gerektiğinden select kullanılır
$veri = $db->prepare("SELECT *  FROM personeller WHERE adisoyadi= ?  and sifre= ?");
$veri->execute(array($_REQUEST["adisoyadi"],$sifrele));
 $row=$veri->fetch(PDO::FETCH_ASSOC); 
if ($row["id"] >0 ) {
	
	$_SESSION["idsi"] =$row["id"] ;
	$_SESSION["adisoyadi"] =$row["adisoyadi"] ;
	$_SESSION["telefon"] =$row["telefon"] ;
	//giris bilgileri doğru olduğunda index sayfasına gidecek
	header("Location: index.php");
	
} else {
	
	echo "Giriş Yapın";
}


}?>


<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap.min.css" >
<script src="jquery-3.3.1.slim.min.js"></script>
<script src="popper.min.js"></script>
<script src="bootstrap.min.js"></script>
<style>
@import "bourbon";
.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 50 auto;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);  

</style>
</head>
<body>


<div class="wrapper">
    <form class="form-signin" method="post">       
      <h2 class="form-signin-heading">Lütfen Giriş Yapınız</h2>
      <input type="text" class="form-control" name="adisoyadi" placeholder="Email" required="" autofocus="" />
      <input type="password" class="form-control" name="sifre" placeholder="sifre" required=""/>      
     
      <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş</button>   
    </form>
  </div>

</body>
</html>
