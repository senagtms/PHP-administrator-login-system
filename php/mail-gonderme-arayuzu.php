<?php

include_once("baglan.php");

if ((strlen(@$_REQUEST["kime"])>10) && (@strlen($_REQUEST["konu"])>5) && (@strlen($_REQUEST["icerik"])>20)) {
//kayıt işlemi (insert)

@$kime = $_REQUEST["kime"];
@$konu = $_REQUEST["konu"];
@$icerik = $_REQUEST["icerik"];




require("mail/class.phpmailer.php");


$kimgonderiyor = "...com";
$gonderenadi ="Sena";



$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
$mail->SMTPSecure = ''; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
$mail->Host = "..."; // Mail sunucusunun adresi (IP de olabilir)
$mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = $kimgonderiyor; // Gönderici adresiniz (e-posta adresiniz)
$mail->Password = "..."; // Mail adresimizin sifresi
$mail->SetFrom($kimgonderiyor, $gonderenadi); // Mail atıldığında gorulecek isim ve email
$mail->AddAddress($kime); // Mailin gönderileceği alıcı adres
$mail->Subject = $konu; // Email konu başlığı
$mail->Body = $icerik; // Mailin içeriği
if(!$mail->Send()){
 $sonuc = " <div class='alert alert-danger'> Gönderim Hatası".$mail->ErrorInfo."</div>";
} else {
 $sonuc = " <div class='alert alert-success'> Mail Gönderildi</div>";
}




} else {
	
	$sonuc = " <div class='alert alert-info'> Alanları doldurunuz !</div>";
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
<div class="row col-md-12">
<form method="POST" action="">

<div class="col-md-6"><label>Kime</label><input type="text" class="form-control" name="kime"></div>
<div class="col-md-6"><label>Konu</label><input type="text" class="form-control" name="konu"></div>
<div class="col-md-12"><label>İçerik</label><textarea class="form-control" rows="3" name="icerik"></textarea></div>

<button  class="btn btn-success" type="submit" name="bunukaydet">Gönder</button>
</form>
</div>
</div>




<?php echo $sonuc; ?>

</body>

<footer>


</footer>



</html>