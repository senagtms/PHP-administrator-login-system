<?php
session_start();
include_once("baglan.php");
//girisyapma
if(empty($_SESSION["idsi"])) { header("Location: giris.php"); exit();}

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);


if (@$_REQUEST["silid"]) {
	//silme işlemi (delete)
	
	$query = $db->prepare("DELETE FROM personeller WHERE id = :id");
$delete = $query->execute(array('id' => $_REQUEST['silid']));
}

if (@$_REQUEST["aktif"]) {
//kayıt işlemi (insert)

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

$icerik=$adisoyadi." adı ile ".$unvani." ünvanında "." Telefon numarası : ".$telefon." Olan şahıs eklendi.";

if (strlen($adisoyadi)<3) {
	$sonuc = "<div class='alert alert-danger'>  Geçerli bir  isim giriniz !<div class='alert alert-danger'>";
	
} else {
	//sifreleme
	$sifrele=hash('sha512', "1234");
	
$veriler = $db->prepare("INSERT INTO personeller SET adisoyadi = :adisoyadi, unvani = :unvani, telefon = :telefon, aktif = :aktif,sifre= :sifre");
$kaydettim = $veriler->execute(array("adisoyadi" => $adisoyadi, "unvani" => $unvani, "telefon" => $telefon, "aktif" => $aktif,"sifre" => $sifrele));

if ( $kaydettim ){
    $kayitid = $db->lastInsertId();
    $sonuc = "<div class='alert alert-success'>  Kaydedildi !</div>";
$dogumyeri = $_REQUEST["dogumyeri"];
$dogumtarihi = $_REQUEST["dogumtarihi"];
$medenidurum = $_REQUEST["medenidurum"];
$okul = $_REQUEST["okul"];
$hobiler = $_REQUEST["hobiler"];
$adres = $_REQUEST["adres"];
$yabancidil = $_REQUEST["yabancidil"];	
$tecrube = $_REQUEST["tecrube"];
$referans = $_REQUEST["referans"];	
	
	//resim yükleme kodu
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
	//resim yükleme kodu bitti
	
	$veriler2 = $db->prepare("INSERT INTO personelbilgi SET personelid = :personelid, dogumyeri = :dogumyeri, dogumtarihi = :dogumtarihi, medenidurumu = :medenidurumu, resim = :resim, okul = :okul,hobiler = :hobiler,adres = :adres,yabancidil = :yabancidil,tecrube = :tecrube,referans = :referans,sertifika = :sertifika");
$kaydettim2 = $veriler2->execute(array("personelid" => $kayitid, "dogumyeri" => $dogumyeri, "dogumtarihi" => $dogumtarihi, "medenidurumu" => $medenidurum,  "resim" => $imagepath,"okul" => $okul,"hobiler" => $hobiler,"adres" => $adres,"yabancidil" => $yabancidil,"tecrube" => $tecrube,"referans" => $referans,"sertifika" => $sertifika));
	
//eğer mail gönder işaretlenmişse aşağıdaki kod mail atar  <<<<<<<<<<<<<<<<<-
if(isset($_POST['mailgonder'])) {	

require("mail/class.phpmailer.php");
@$kime = "tremusa@gmail.com";
@$konu = "Personel Kayıt İşlemi";

@$icerik="Bu mesaj oto gönderilmiştir.<br>".$adisoyadi." adı ile ".$unvani." ünvanında "." Telefon numarası : ".$telefon." Olan şahıs eklendi.";

$kimgonderiyor = "sena@miteksoft.com";
$gonderenadi ="Sena";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
$mail->SMTPSecure = ''; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
$mail->Host = "miteksoft.com"; // Mail sunucusunun adresi (IP de olabilir)
$mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = $kimgonderiyor; // Gönderici adresiniz (e-posta adresiniz)
$mail->Password = "246sena.,\\"; // Mail adresimizin sifresi
$mail->SetFrom($kimgonderiyor, $gonderenadi); // Mail atıldığında gorulecek isim ve email
$mail->AddAddress($kime); // Mailin gönderileceği alıcı adres
$mail->Subject = $konu; // Email konu başlığı
$mail->Body = $icerik; // Mailin içeriği
if(!$mail->Send()){
 $sonuc = " <div class='alert alert-danger'> Gönderim Hatası".$mail->ErrorInfo."</div>";
} else {
 $sonuc = " <div class='alert alert-success'> Mail Gönderildi</div>";
}

}	
//eğer mail gönder işaretlenmişse yukarıdaki kod mail atar  ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

} else {
	
	$sonuc = "<div class='alert alert-danger'>  Hata oluştu !</div>";
}
}
} else {
	
	$sonuc = " <div class='alert alert-info'> Hoşgeldin ".$_SESSION["adisoyadi"]." Alanları doldurunuz ! Ya da <a href='cikis.php'>Çıkış</a> Yapınız</div>";
}




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
<form method="POST" action="" enctype="multipart/form-data"	>
      <div class="table-responsive">
        <table class="table table-striped">
 <thead class="table-primary"><tr><th>Adı Soyadı</th><th>Ünvanı</th><th>Telefonu</th><th>Sertifikalar</th><th>Aktiflik</th><th>İşlem</th><th>E-mail</th></tr></thead>
<tr>
<td><input type="text" class="form-control" name="adisoyadi" value="<?php echo @$adisoyadi; ?>"></td>
<td><input type="text" class="form-control" name="unvani" value="<?php echo @$unvani; ?>"></td>
<td><input type="number" class="form-control" name="telefon" value="<?php echo @$telefon; ?>"></td>
<td><input type="text" class="form-control" name="sertifika" value="<?php echo @$sertifika; ?>"></td>
<td><select name="aktif" class="form-control">
  <option value="S" <?php if (@$aktif == "S") { echo " selected ";} ?> > Seçiniz </option>
  <option value="E" <?php if (@$aktif == "E") { echo " selected ";} ?>>Aktif</option>
  <option value="H" <?php if (@$aktif == "H") { echo " selected ";} ?>>Pasif</option>
</select></td>
<td><button  class="btn btn-success" type="submit" name="bunukaydet">Kaydet</button></td>
<td><label><input type="checkbox" class="form-control" name="mailgonder"/> Mail Gönder</label></td>
</tr>
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
<td><input type="text" class="form-control" name="hobiler" value="<?php echo @$hobiler; ?>"></td>
<td><input type="text" class="form-control" name="adres" value="<?php echo @$adres; ?>"></td>
<td><input type="text" class="form-control" name="yabancidil" value="<?php echo @$yabancidil; ?>"></td>
<td><input type="text" class="form-control" name="referans" value="<?php echo @$referans; ?>"></td>

	
</tr>
</table>

</div>


</form>
</div>
</div>

<table class="table table-striped">
<thead class="table-primary "><tr><th>Adı Soyadı</th><th>Ünvanı</th><th>Telefonu</th><th>Aktiflik</th><th colspan="2">İşlemler</th><th>Personel Kart</th></tr></thead>
<div class="valid-feedback">
        Looks good!
      </div>

<?php
//listeleme (select)
$vericek = $db->query("SELECT * FROM personeller where 1=1 limit 10", PDO::FETCH_ASSOC);
if ( $vericek->rowCount() ){
     foreach( $vericek as $row ){
		 

		 if ($row["aktif"] == "E") {$secenek = "Aktif";} else if ($row["aktif"] == "H") {$secenek = "Pasif";} else {$secenek = "Seçilmedi";}
		 
		 
          echo '
		  
		<tr>
<td>'.$row["adisoyadi"].'</td>
<td>'.$row["unvani"].'</td>
<td>'.$row["telefon"].'</td>
<td>'.$secenek.'</td>

<td><a role="button"  class="btn btn-danger" href="index.php?silid='.$row["id"].'" onclick="return confirm(\'Bu kayıt silinecek , emin misiniz ?\');">Sil</a></td>
<td><a role="button"  class="btn btn-warning"  href="guncelle.php?guncelleid='.$row["id"].'">Düzenle</a></td>
<td><a role="button"  class="btn btn-primary"  href="kart.php?kartid='.$row["id"].'">Sicil Kartı</a></td>

</tr>  
		  	  
		  ';
     }
}
?>

</table>

<?php echo $sonuc; ?>

</body>

<footer>


</footer>



</html>