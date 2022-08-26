# Yurtiçi Kargo - Php Entegrasyon Kütüphanesi

<h3 id="baslangic">Başlangıç</h3>
http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl
<br>Entegrasyon dökümantasyonu (Klavuz) yurtiçi kargo pazarlama sorumlusundan almanız gerekmektedir.
<br>Bu link de sorgu yapabilmek için resmi başvuru yapıp kullanıcı adı ve şifre almak durumundasınız. 

<h3 id="isleyis">İşleyiş</h3>
Kargo Key otomatik oluşturup bu key ve kargo bilgileri ile (adres,telefon,fatura ve irsaliye (ticari gönderiler) numarası zorunludur) 
<br>Kargo siparişi oluşturup yurtiçi kargo nun sistemine sipariş (kargo çıkışı) düşürülür.
<br>Kargo siparişi kargonun ödeme tipine göre 4 şekilde yapılmakda ve her talep için faklı kullanıcı adı şifre bulunmakta.Bu talep nolar ile sipariş vermekte zorunlusunuz.
<br>Kargo firması kargo almaya geldiğinde kargo keyi ile kargoları alır ve bunları sisteme bu key ile girerler.Sizde bu key ile kargonuzun durumunu takip edebilirsiniz.(Biraz zorunlu sorunlu bir süreç).

<h3 id="not">Not</h3>
Sunucu da bu kodun çalışabilmesi için 80 port unun acık olması , soket , openssl , SOAP , curl  gibi eklentilerin açık olması gerekmekte.

<h3 id="iletisim">İletişim</h3>
ÜMİT KATMER
<br>info@umitkatmer.com.tr
<br>https://www.facebook.com/katmersoft


