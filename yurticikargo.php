<?php
Class yurtici {
	
    protected static $_wsUserName, $_wsPassword, $_userLanguage, $_parameters, $_sclient;
    public $_debug = false;
    
    public function __construct(array $attributes = array()) {

        self::$_wsUserName = $attributes['wsUserName'];
        self::$_wsPassword = $attributes['wsPassword'];
        self::$_userLanguage = $attributes['userLanguage'];
        self::$_parameters = [

		'wsUserName'   => self::$_wsUserName,
		'wsPassword'   => self::$_wsPassword,
		'userLanguage' => self::$_userLanguage,
		];
    }
    
    public function setUrl($url) {
        self::$_sclient = new \SoapClient($url);
    }


 
    public function createShipment($datagelen) {
		
		$data = array_merge(
          array("wsUserName" => self::$_parameters['wsUserName'], 
                "wsPassword" => self::$_parameters['wsPassword'],
                "userLanguage" => self::$_parameters['userLanguage'],
          ),
          array("ShippingOrderVO" => $datagelen)
        );
		

        $this->setUrl('http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl');
        return self::$_sclient->createShipment($data);
    }
 
    public function cancelShipment($cargoKeys) {
		
		$data = array_merge(
          array("wsUserName" => self::$_parameters['wsUserName'], 
                "wsPassword" => self::$_parameters['wsPassword'],
                "userLanguage" => self::$_parameters['userLanguage'],
                "cargoKeys" => $cargoKeys,
          )
          
        );
		

        $this->setUrl('http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl');
        return self::$_sclient->cancelShipment($data);
    }
 
    public function queryShipment($keys,$keyType,$addHistoricalData=true,$onlyTracking=true) {
		
		$data = array_merge(
          array("wsUserName"        => self::$_parameters['wsUserName'], 
                "wsPassword"        => self::$_parameters['wsPassword'],
                "wsLanguage"        => self::$_parameters['userLanguage'],
                "keys"              => $keys,                                  // array olacak []
                "keyType"           => $keyType,                               // 0 – Kargo Anahtarı 1 – Fatura Anahtarı 
                "addHistoricalData" => $addHistoricalData,                     // true / false Default : false
                "onlyTracking"      => $onlyTracking,                          // true / false Default : false

          )
         
        );
		

        $this->setUrl('http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl');
        return self::$_sclient->queryShipment($data);
    }
	
	
    public function queryShipmentDetail($keys,$keyType,$addHistoricalData=true,$onlyTracking=true,$jsonData=true) {
		
		$data = array_merge(
          array("wsUserName"        => self::$_parameters['wsUserName'], 
                "wsPassword"        => self::$_parameters['wsPassword'],
                "wsLanguage"        => self::$_parameters['userLanguage'],
                "keys"              => $keys,                                  // array olacak []
                "keyType"           => $keyType,                               // 0 – Kargo Anahtarı 1 – Fatura Anahtarı 
                "addHistoricalData" => $addHistoricalData,                     // true / false Default : false
                "onlyTracking"      => $onlyTracking,                          // true / false Default : false
                "jsonData"          => $jsonData,                          // true / false Default : false

          )
         
        );
		

        $this->setUrl('http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl');
        return self::$_sclient->queryShipmentDetail($data);
    }
 
  
  
    public function __destruct() {
        if ($this->_debug) {
            print_r(self::$_parameters);
        }
    }   
}



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

$yurticiparams = [

"wsUserName"=>"**************",
"wsPassword"=>"**************",
"userLanguage"=>"TR"

	];

$yurtici      = new yurtici($yurticiparams);
//$OrderList  = $yurtici->createShipment ($params); //Kargo çıkış , kargo var gelin alın , kargo siparişi verilir.
//$OrderList  = $yurtici->cancelShipment($cargoKeys="**************");// Kargo çıkışı iptal edilir , Kargo siparişi iptal ,Artık Kargom yok maalesef .
//$OrderList  = $yurtici->queryShipment($keys="**************",$keyType="0",$addHistoricalData=true,$onlyTracking=true);//Kargo Siparişinin Durumu
//$OrderList  = $yurtici->queryShipmentDetail($keys="**************",$keyType="0",$addHistoricalData=true,$onlyTracking=true,$jsonData=true);//Siparişin aşamaları ve detayları , kargo takip linki 
$OrderList    = $yurtici->queryShipmentDetail($keys="**************",$keyType="0",$addHistoricalData=true,$onlyTracking=false,$jsonData=false);////Siparişin aşamaları ve detayları , kargo takip linki , true false değerlerine göre bilgiler gelmektedir.





//Tüm hataları ekrana basar
if (is_soap_fault($OrderList)) {
trigger_error("SOAP Fault: (faultcode: {$OrderList->faultcode}, faultstring: {$OrderList->faultstring})", E_USER_ERROR);
}

?>