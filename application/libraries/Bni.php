<?php
error_reporting(0);
class Bank{
private $act;
private $agent= 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17';
 
function hal_login(){
$urllogin;

$url = 'https://ibank.bni.co.id/MBAWeb/FMB';
$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
$data=stripos($result, "masuk");
if($data===false){
    return false;
}
$kutip=0;
while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data-1,1);
if($kutip==2){
	$urllogin=substr($urllogin,1);
	break;
}
if($kutip>0 && $kutip<3){
$urllogin=$url.$urllogin;
}

--$data;

}
return $urllogin;
}
    
    
function action_login($urllogin){
$actionlogin;
$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL,$urllogin);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
$data=stripos($result, "action");
if($data===false){
    return false;
}
$kutip=0;
while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==2){
	$actionlogin=substr($actionlogin, 0,strlen($actionlogin)-1);
	break;
}
if($kutip>0&&$kutip<3){
$actionlogin=$actionlogin.$url;
}
++$data;
}
$this->act=$actionlogin;     
} 

function login_rekening ($username, $pass){
$urlrekening;
$data=array(
'Num_Field_Err'=>"Please enter digits only!",
'Mand_Field_Err'=>"Mandatory field is empty!",
'CorpId'=>$username,
'PassWord'=>$pass,
'__AUTHENTICATE__'=>'Login',
'CancelPage'=>'HomePage.xml',
'USER_TYPE'=>'1',
'MBLocale'=>'bh',
'language'=>'bh',
'AUTHENTICATION_REQUEST'=>'True',
'__JS_ENCRYPT_KEY__'=>'',
'JavaScriptEnabled'=>'N',
'deviceID'=>'',
'machineFingerPrint'=>'',
'deviceType'=>'',
'browserType'=>'',
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'SignOnRetRq',
'Alignment'=>'LEFT',
'page'=>'SignOnRetRq',
'locale'=>'en',
'PageName'=>'Thin_SignOnRetRq.xml',
'serviceType'=>'Dynamic'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL,$this->act);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
$kutip=0;
$data1=stripos($result, "rekening");
if($data1===false){
    return false;
}
while (true) {
	if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data1-1,1);
if($kutip==2){
	$urlrekening=substr($urlrekening,1);
	break;
}
if($kutip>0&&$kutip<3){
$urlrekening=$url.$urlrekening;
}
--$data1;
}
return $urlrekening;       
}  

    
function mutasi_rekening($urlrekening){
$urlmutasi;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlrekening);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT,5);
$result=curl_exec($ch);
curl_close($ch);
$kutip=0;
$data1=stripos($result, "mutasi rekening");
if($data1===false){
    return false;
}
while (true) {
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data1-1,1);
if($kutip==2){
	$urlmutasi=substr($urlmutasi,1);
	break;
}
if($kutip>0&&$kutip<3){
$urlmutasi=$url.$urlmutasi;
}
--$data1;
}
    
  return $urlmutasi;  
}

function saldo_rekening($urlrekening){
$urlsaldo;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlrekening);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT,5);
$result=curl_exec($ch);
curl_close($ch);
$kutip=0;
$data1=stripos($result, "informasi saldo");
if($data1===false){
    return false;
}
while (true) {
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data1-1,1);
if($kutip==2){
	$urlsaldo=substr($urlsaldo,1);
	break;
}
if($kutip>0&&$kutip<3){
$urlsaldo=$url.$urlsaldo;
}
--$data1;
}
    
  return $urlsaldo;  
}
    
    
function hal_mutasi($urlmutasi, $urlrekening){
$mbparam;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlmutasi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $urlrekening);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;
while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}
++$data;
}
return $mbparam;
}

function hal_saldo($urlsaldo, $urlrekening){
$mbparam;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlsaldo);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $urlrekening);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;
while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}
++$data;
}
return $mbparam;
}
 
    
    
    
function hal_akhir($param, $urlmutasi){
$mbparam;
$data=array(
'Num_Field_Err'=>'Please enter digits only!',
'Mand_Field_Err'=>'Mandatory field is empty!',
'MAIN_ACCOUNT_TYPE'=>'OPR',
'AccountIDSelectRq'=>'Lanjut',
'AccountRequestType'=>'Query',
'mbparam'=>$param,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'AccountTypeSelectRq',
'Alignment'=>'LEFT',
'page'=>'AccountTypeSelectRq',
'locale'=>'bh',
'PageName'=>'TranHistoryRq',
'formAction'=>'',
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic',
);
$ch=curl_init();
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_REFERER, $urlmutasi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,  CURLOPT_URL, $this->act);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
//return $result;

$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;

while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}

++$data;

}
return $mbparam;      
}
 

function hal_akhirs($param, $urlsaldo){
$mbparam;
$data=array(
'Num_Field_Err'=>'Please enter digits only!',
'Mand_Field_Err'=>'Mandatory field is empty!',
'MAIN_ACCOUNT_TYPE'=>'OPR',
'AccountIDSelectRq'=>'Lanjut',
'AccountRequestType'=>'Query',
'mbparam'=>$param,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'AccountTypeSelectRq',
'Alignment'=>'LEFT',
'page'=>'AccountTypeSelectRq',
'locale'=>'bh',
'PageName'=>'BalanceInqRq',
'formAction'=>'',
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic',
);
$ch=curl_init();
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_REFERER, $urlsaldo);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,  CURLOPT_URL, $this->act);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
//return $result;

$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;

while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}

++$data;

}
return $mbparam;      
}
 
    
function hal_utama($mbparam,$norekening){
$data=array(
'Num_Field_Err'=>'Please enter digits only!',
'Mand_Field_Err'=>'Mandatory field is empty!',
'acc1'=>'OPR|'.$norekening.'|BNI TAPLUS MUDA PB',
'Search_Option'=>'TxnPrd',
'TxnPeriod'=>'LastMonth',
'txnSrcFromDate'=>'01-Aug-2017',
'txnSrcToDate'=>'01-Aug-2017',
'FullStmtInqRq'=>'Lanjut',
'MAIN_ACCOUNT_TYPE'=>'OPR',
'mbparam'=>$mbparam,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'AccountIDSelectRq',
'Alignment'=>'LEFT',
'page'=>'AccountIDSelectRq',
'locale'=>'bh',
'PageName'=>'AccountTypeSelectRq',
'formAction'=>$this->act,
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic'
);
$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,  CURLOPT_URL, $this->act);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
return $result;   
}

function hal_utamas($mbparam,$norekening){
$data=array(
'acc1'=>'OPR|'.$norekening.'|BNI TAPLUS MUDA PB',
'BalInqRq'=>'Lanjut',
'MAIN_ACCOUNT_TYPE'=>'OPR',
'mbparam'=>$mbparam,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'AccountIDSelectRq',
'Alignment'=>'LEFT',
'page'=>'AccountIDSelectRq',
'locale'=>'bh',
'PageName'=>'AccountTypeSelectRq',
'formAction'=>$this->act,
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic'
);
$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,  CURLOPT_URL, $this->act);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$result=curl_exec($ch);
curl_close($ch);
return $result;   
}
    
    
function keluar($result){
$mbparam;
$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;

while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}

++$data;

}

$post = array(
'Num_Field_Err'=>'Please enter digits only!',
'Mand_Field_Err'=>'Mandatory field is empty!',
'LogOut'=>'Keluar',
'dispRow'=>'10',
'currentStartVal'=>'0',
'prefetching'=>'',
'lastValue'=>'10',
'mbparam'=> $mbparam,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'FullStmtInqRq',
'Alignment'=>'LEFT',
'page'=>'FullStmtInqRq',
'locale'=>'bh',
'PageName'=>'AccountIDSelectRq',
'formAction'=>$this->act,
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic'
);   
$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $this->act);
$result=curl_exec($ch);  
curl_close($ch);
return $result;
} 

function keluars($result){
$mbparam;
$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;

while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result, $data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}

++$data;

}

$post = array(
'LogOut'=>'Keluar',
'mbparam'=> $mbparam,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'getBalInqRq',
'Alignment'=>'LEFT',
'page'=>'getBalInqRq',
'locale'=>'bh',
'PageName'=>'AccountIDSelectRq',
'formAction'=>$this->act,
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic'
);   
$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $this->act);
$result=curl_exec($ch);  
curl_close($ch);
return $result;
} 


function logout($result){
$mbparam;
$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;

while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result,$data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}

++$data;

}
$post=array(
'Num_Field_Err'=>'Please enter digits only!',
'Mand_Field_Err'=>'Mandatory field is empty!',
'__LOGOUT__'=>'Keluar',
'mbparam'=>$mbparam,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'SignOffUrlRq',
'Alignment'=>'LEFT',
'page'=>'SignOffUrlRq',
'locale'=>'bh',
'PageName'=>'FullStmtInqRq',
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic'
);

$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $this->act);
$result =curl_exec($ch);
curl_close($ch);
}
function logouts($result){
$mbparam;
$data=stripos($result, 'id="mbparam"');
if($data===false){
    return false;
}
$kutip=0;

while(true){
if($url=='"'){
$kutip+=1;
}
$url=substr($result,$data+1,1);
if($kutip==4){
	$mbparam=substr($mbparam, 0,strlen($mbparam)-1);
	break;
}
if($kutip>2&&$kutip<5){
$mbparam=$mbparam.$url;
}

++$data;

}
$post=array(
'Num_Field_Err'=>'Please enter digits only!',
'Mand_Field_Err'=>'Mandatory field is empty!',
'__LOGOUT__'=>'Keluar',
'mbparam'=>$mbparam,
'uniqueURLStatus'=>'disabled',
'imc_service_page'=>'SignOffUrlRq',
'Alignment'=>'LEFT',
'page'=>'SignOffUrlRq',
'locale'=>'bh',
'PageName'=>'getBalInqRq',
'mConnectUrl'=>'FMB',
'serviceType'=>'Dynamic'
);

$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_REFERER, $this->act);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $this->act);
$result =curl_exec($ch);
curl_close($ch);
}

function prosesdata($data){
$data= strip_tags($data);
$data= preg_replace('/\s+/', ' ', $data);
$data=explode(" ", $data);
$counter=count($data);
		$data1=array();
		for($l=0;$l<$counter;++$l){
			$cr=stripos($data[$l],"tipecr");
			$db=stripos($data[$l],"tipedb");
			$uraian=stripos($data[$l],"uraian");
				if($cr!==false||$db!==false||$uraian!==false){
				$data1[]= $l;
				}
		}
		$counter=count($data1)/2;
		$transaksi=array();
		$a=array();
			for($k=0;$k<$counter;++$k){
			$x=$k*2;
			//$tanggal="7777".$data[$data1[$x]-1];
			$tgl=substr($data[$data1[$x]-1],9);
			$nominal=$data[$data1[$x+1]+2];
			$keterangan=$data[$data1[$x]+1];
			$tipe=$data[$data1[$x+1]];
			$tipee=strtoupper(substr($tipe,-2));
			$saldo=$data[$data1[$x+1]+4];
			$saldoo= substr($saldo,0,-3);
			$nominall= substr($nominal,0,-3);
			$nominal1= str_replace(".", "", $nominall);
			$a[] =  array('tanggal' => $tgl,
										'keterangan' => $keterangan,
										'type' => $tipee,
										'nominal' => $nominal1,
										'saldo' => $saldoo);
			}

		return $a;


}

function prosesdataa($data){
preg_match_all('/<span id="(.*?)" class="(.*?)">(.*?)<\/span>/si',$data,$grab);
                    $sal=$grab[0][22];
	            	$sald= str_replace(".", "", $sal);
	            	$saldo= strip_tags ($sald);
	            	$saldoo= trim ($saldo);
	            	$saldooo = str_replace( ",", ".", $saldoo);
	            	return $saldooo;


}


}
?>