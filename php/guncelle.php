<?php
include_once("baglan.php");

if (@$_REQUEST["guncelleid"]) {
//düzenleme işlemi (UPDATE)
if (@$_REQUEST["adisoyadi"]) {
$adisoyadi = $_REQUEST["adisoyadi"];
$unvani = $_REQUEST["unvani"];
$telefon = $_REQUEST["telefon"];
$aktif = $_REQUEST["aktif"];


$dogumyeri = $_REQUEST["dogumyeri"];
$dogumtarihi = $_REQUEST["dogumtarihi"];
$medenidurum = $_REQUEST["medenidurum"];
$okul = $_REQUEST["okul"];
$hobiler = $_REQUEST["hobiler"];
$adres = $_REQUEST["adres"];
$yabancidil = $_REQUEST["yabancidil"];	
$tecrube = $_REQUEST["tecrube"];	
$referans = $_REQUEST["referans"];	
$sertifika = $_REQUEST["sertifika"];	
$image_name=$_FILES['resim']['name'];


		$size = filesize($image_name);
	if($size>0) { 	
		
       $temp = explode(".", $image_name);
        $newfilename = round(microtime(true)) . '.' . end($temp);
       $imagepath="resim/".$newfilename;
      
	  move_uploaded_file($_FILES["resim"]["tmp_name"],$imagepath);
	
	} else {
		$imagepath ="resim/resimyok.jpg";
	}
	
$veriler = $db->prepare("UPDATE personeller SET adisoyadi = :adisoyadi, unvani = :unvani, telefon = :telefon, aktif = :aktif where id=".$_REQUEST["guncelleid"]."");
$guncelledim = $veriler->execute(array("adisoyadi" => $adisoyadi, "unvani" => $unvani, "telefon" => $telefon, "aktif" => $aktif));
if ($guncelledim) {
$veriler2 = $db->prepare("UPDATE personelbilgi SET dogumyeri = :dogumyeri,dogumtarihi = :dogumtarihi,medenidurumu = :medenidurumu, resim = :resim,okul = :okul,hobiler = :hobiler,adres = :adres,yabancidil = :yabancidil,tecrube = :tecrube,referans = :referans where personelid=".$_REQUEST["guncelleid"]." ");
$guncelledim2 = $veriler2->execute(array( "dogumyeri" => $dogumyeri,  "dogumtarihi" => $dogumtarihi,  "medenidurumu" => $medenidurumu,"resim" => $imagepath,  "okul" => $okul,"hobiler" => $hobiler,"adres" => $adres,"yabancidil" => $yabancidil,"tecrube" => $tecrube,"referans" => $referans));
}

} else {
	
$veri = $db->prepare("SELECT * FROM personeller WHERE id= ?");
$veri->execute(array($_REQUEST["guncelleid"]));
 $row=$veri->fetch(PDO::FETCH_ASSOC); 
$adisoyadi = $row["adisoyadi"];
$unvani = $row["unvani"];
$telefon = $row["telefon"];
$aktif = $row["aktif"];

$veri2 = $db->prepare("SELECT * FROM personelbilgi WHERE personelid= ?");
$veri2->execute(array($_REQUEST["guncelleid"]));
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

}
}

$sonuc = "<a role='button'  class='btn btn-warning'  href='index.php'>Geri Dön</a>";

?>

<html lang="tr">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap.min.css" >
<script src="jquery-3.3.1.slim.min.js"></script>
<script src="popper.min.js"></script>
<script src="bootstrap.min.js"></script>

</head>

<body>
<div class="container-fluid">
<div class="row">
<form method="POST"  enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">

<thead class="table-primary"><tr><th>Adı Soyadı</th><th>Ünvanı</th><th>Telefonu</th><th >Sertifikalar  </th><th >Aktiflik</th></tr></thead>

<tr>
<td><input type="text" name="adisoyadi" value="<?php echo @$adisoyadi; ?>"></td>
<td><input type="text" name="unvani" value="<?php echo @$unvani; ?>"></td>
<td><input type="number" name="telefon" value="<?php echo @$telefon; ?>"></td>
<td><input type="text" name="sertifika" value="<?php echo @$sertifika; ?>"></td>
<td><select name="aktif">
  <option value="S" <?php if (@$aktif == "S") { echo " selected ";} ?> > Seçiniz </option>
  <option value="E" <?php if (@$aktif == "E") { echo " selected ";} ?>>Aktif</option>
  <option value="H" <?php if (@$aktif == "H") { echo " selected ";} ?>>Pasif</option>
</select></td></tr>
<thead class="table-primary"><tr><th>Dogumyeri</th><th>Dogumtarihi</th><th>Medeni Durum</th><th>Fotoğraf</th><th>İş Tecrübesi</th></tr></thead>
<tr>

<td><input type="text" class="form-control" name="dogumyeri" value="<?php echo @$unvani; ?>"></td>
<td><input type="date" class="form-control" name="dogumtarihi" value="<?php echo @$telefon; ?>"></td>
<td><select name="medenidurum" class="form-control">
  <option value="S" <?php if (@$aktif == "S") { echo " selected ";} ?> > Seçiniz </option>
  <option value="E" <?php if (@$aktif == "E") { echo " selected ";} ?>>Evli</option>
  <option value="B" <?php if (@$aktif == "H") { echo " selected ";} ?>>Bekar</option>
</select></td>
<td><input type="file" class="form-control" name="resim"></td>
<td><input type="text" class="form-control" name="tecrube" value="<?php echo @$tecrube; ?>"></td></tr>



 <thead class="table-primary"><tr><th>Okul</th><th>Hobiler</th><th>Adres</th><th>Yabancı Dil</th><th>Referans</th></tr></thead>
 <tr>
<td><input type="text" class="form-control" name="okul" value="<?php echo @$okul; ?>"></td>
<td><input type="text" class="form-control" name="hobiler" value="<?php echo @$hobiler;?>"></td>
<td><input type="text" class="form-control" name="adres" value="<?php echo @$adres; ?>"></td>
<td><input type="text" class="form-control" name="yabancidil" value="<?php echo @$yabancidil; ?>"></td>
<td><input type="text" class="form-control" name="referans" value="<?php echo @$referans; ?>"></td>
<td><button class="btn btn-success" type="submit" name="bunukaydet">Kaydet</button></td></tr>


</tr>
</div></div>
</table>
<?php echo $sonuc; ?>

</form>
</div>


</body>

<footer>


</footer>



</html>