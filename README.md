# Yurtiçi Kargo - Php Entegrasyon Kütüphanesi

<h3 id="baslangic">Başlangıç</h3>
http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl
<br>Entegrasyon dökümantasyonu (Klavuz) yurtiçi kargo pazarlama sorumlusundan almanız gerekmektedir.
<br>Bu link de sorgu yapabilmek için resmi başvuru yapıp kullanıcı adı ve şifre almak durumundasınız. 

<h3 id="isleyis">İşleyiş</h3>

```php

<?php
require_once "yurticikargo.php";
$cargokey = rand(1111111111111111111,99999999999999999999);

$params = array(
'cargoKey'=>$cargokey,
'invoiceKey'=>"DENEME",
'receiverCustName'=>"DENEME DENEME",
'receiverAddress'=>"DENEME DENEME",
'cityName'=>"DENEME",
'townName'=>"DENEME",
'receiverPhone1'=>"DENEME",
'receiverPhone2'=>"DENEME",
'receiverPhone3'=>"DENEME",
'emailAddress'=>"info@umitkatmer.com.tr",
'taxOfficeId'=>'',
'taxNumber'=>"",
'taxOfficeName'=>"",
'desi'=>"",
'kg'=>"",
'cargoCount'=>'',
'waybillNo'=>"",//Sevk İrsaliye No (Ticari gönderilerde zorunludur)
'specialField1'=>"",
'specialField2'=>"",
'specialField3'=>"",
'ttInvoiceAmount'=>"",
'ttDocumentId'=>'',
'ttCollectionType'=>"",
'ttDocumentSaveType'=>"",
'dcSelectedCredit'=>"",
'dcCreditRule'=>'',
'description'=>"",
'orgGeoCode'=>"",
'privilegeOrder'=>"",
'custProdId'=>"",
'orgReceiverCustId'=>"",
);

//$talepno yurt içi kargodan aldığınız talep koduna göre kargonuzu göndermek istediğiniz şekilde login olup kargoyu oluşturmanız gerekmekte
//4 adet kargo gönderme (talep no var) şekli var bunu  pazarlama sorumlusu arkadaş size iletecektir.
//siz eğer alıcı ödeyecekse bu kullanıcı adı şifre ile kargoyu göndereceksiniz.

$sifreler = array (
    "******(talepno)" => array("bilgi"=>"GÖNDERİCİ ÖDEMELİ NORMAL GÖNDERİLER", "kullaniciadi"=>"************","sifre"=>"************"),
    "******(talepno)" => array("bilgi"=>"GÖNDERİCİ ÖDEMELİ TAHSİLATLI TESLİMAT", "kullaniciadi"=>"************","sifre"=>"************"),
    "******(talepno)" => array("bilgi"=>"ALICI ÖDEMELİ NORMAL GÖNDERİLER", "kullaniciadi"=>"************","sifre"=>"************"),
    "******(talepno)" => array("bilgi"=>"ALICI ÖDEMELİ TAHSİLATLI TESLİMAT", "kullaniciadi"=>"************","sifre"=>"************")
    );
		
		
$kullaniciadi = $sifreler[$talepno]["kullaniciadi"]	;	
$sifre        = $sifreler[$talepno]["sifre"]	;	
		
$yurticiparams = ["wsUserName"=>$kullaniciadi,"wsPassword"=>$sifre,"userLanguage"=>"TR"];

$yurtici      = new yurtici($yurticiparams);
$OrderList  = $yurtici->createShipment ($params); //Kargo çıkış , kargo var gelin alın , kargo siparişi verilir.
//Kargo Key otomatik oluşturup bu key ve kargo bilgileri ile (adres,telefon,fatura ve irsaliye (ticari gönderiler) numarası zorunludur) 
?>
```




<br>Kargo siparişi oluşturup yurtiçi kargo nun sistemine sipariş (kargo çıkışı) düşürülür.
<br>Kargo siparişi kargonun ödeme tipine göre 4 şekilde yapılmakda ve her talep için faklı kullanıcı adı şifre bulunmakta.Bu talep nolar ile sipariş vermekte zorunlusunuz.
<br>Kargo firması kargo almaya geldiğinde kargo keyi ile kargoları alır ve bunları sisteme bu key ile girerler.Sizde bu key ile kargonuzun durumunu takip edebilirsiniz.(Biraz zorunlu sorunlu bir süreç).

<h3 id="not">Not</h3>
Sunucu da bu kodun çalışabilmesi için 80 port unun acık olması , soket , openssl , SOAP , curl  gibi eklentilerin açık olması gerekmekte.

<h3 id="iletisim">İletişim</h3>
ÜMİT KATMER
<br>info@umitkatmer.com.tr
<br>https://www.facebook.com/katmersoft


