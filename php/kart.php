<?php

include_once("baglan.php");
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
//birinci tablodan veri çekme
$veri = $db->prepare("SELECT * FROM personeller WHERE id= ?");
$veri->execute(array($_REQUEST["kartid"]));
$row=$veri->fetch(PDO::FETCH_ASSOC); 
$adisoyadi = $row["adisoyadi"];
$unvani = $row["unvani"];
$telefon = $row["telefon"];

//ikinci tablodan veri çekme
$veri2 = $db->prepare("SELECT * FROM personelbilgi WHERE personelid= ?");
$veri2->execute(array($_REQUEST["kartid"]));
$row2=$veri2->fetch(PDO::FETCH_ASSOC); 
$resim = $row2["resim"];
$dogumyeri = $row2["dogumyeri"];
$dogumtarihi = $row2["dogumtarihi"];
$medenidurumu = $row2["medenidurumu"];
$okul = $row2["okul"];
$hobiler = $row2["hobiler"];
$adres = $row2["adres"];
$yabancidil = $row2["yabancidil"];
$tecrube = $row2["tecrube"];
$referans = $row2["referans"];
$sertifika = $row2["sertifika"];

if ($medenidurumu=="E") { $medenidurumu = "Evli";} else if ($medenidurumu=="B") { $medenidurumu = "Bekar";} else { $medenidurumu = "Belirsiz";}


?>


<html lang="tr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap.min.css" >
<script src="jquery-3.3.1.slim.min.js"></script>
<script src="popper.min.js"></script>
<script src="bootstrap.min.js"></script>
<style>
label {color:red;font-weight:bolder:2px; padding:20px; margin:-2px;}
	@media only screen and (min-width: 800px) { /*  css if than else : eğer ekran çöz. yüksekse alttaki alanları yukarı kaydır  */
	.yukari{top:-80px;	}


	}
	.img-frame { background:transparent;  border:5px solid #999999; }


</style>
<body>

<div class="container">
<div class="row">
<div class="card">


<div class="card">
<img src="<?php echo $resim; ?>" class="img-frame" alt="Resim" height="160" >
  <div class="card-header">Kişisel Bilgiler</div>
  <div class="card-body ">

<p> 
 <div class="col-md-12">
<div class="col-md-12"><label>Ad Soyad:</label><?php echo $adisoyadi; ?></div>

<div class="col-md-12"><label>Ünvan:</label><?php echo $unvani; ?></div>

<div class="col-md-12"><label>Doğum Yeri:</label><?php echo $dogumyeri; ?></div>

<div class="col-md-12"><label>Doğum Tarihi:</label><?php echo $dogumtarihi; ?></div>

<div class="col-md-12"><label>Medeni Durum:</label><?php echo $medenidurumu; ?></div>
</p>

</div>
</div>
</div>

<div class="card">

  <div class="card-header">Okul Bilgileri</div>
  <div class="card-body">

    <p>

<label>Okul:</label><?php echo $okul; ?>

</p>
  </div> </div>
</div>
<div class="card">

  <div class="card-header">Aktiviteler</div>
  <div class="card-body">
<p>
<label>Hobiler: </label><?php echo $hobiler; ?></p>
 
</div>


<div class="card">

  <div class="card-header">Staj ve İş tecrübesi</div>
  <div class="card-body">

    <p class="card-text">

<label>İş tecrübesi:</label><?php echo $tecrube; ?>


</p></div>
</div>

<div class="card">

  <div class="card-header">Yabancı Dil</div>
  <div class="card-body">

    <p class="card-text">

<label>Yabancı Dil:</label><?php echo $yabancidil; ?>


</p></div>
</div>

</div>
<div class="card">

  <div class="card-header">İletişim Bilgileri</div>
  <div class="card-body">

    <p class="card-text">

<label>Adres:</label><?php echo $adres; ?>
</br>
<label>telefon:</label><?php echo $telefon; ?>


</p></div>
<div class="card">

  <div class="card-header">Sertifikalar</div>
  <div class="card-body">

    <p class="card-text">

<label>Sertifikalar:</label><?php echo $sertifika; ?>


</p></div>
</div>
<div class="card">

  <div class="card-header">Referans</div>
  <div class="card-body">

    <p class="card-text">

<label>Referans:</label><?php echo $referans; ?>


</p></div>
</div></div>
</div>




</body>
</html>