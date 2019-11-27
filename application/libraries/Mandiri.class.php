<?php
/****
CLASS Bank Mandiri
***/

class bankMandiri {
        var $userid = "";
        var $password = "";
        var $rekening = "1";

        var $login_url = "https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID";
        var $login_process_url="https://ib.bankmandiri.co.id/retail/Login.do";
        var $login_success_url="https://ib.bankmandiri.co.id/retail/Redirect.do?action=forward";

        var $mutasi_form_url="https://ib.bankmandiri.co.id/retail/TrxHistoryInq.do?action=form";
        var $mutasi_url = "https://ib.bankmandiri.co.id/retail/TrxHistoryInq.do";
        var $logout_url = "https://ib.bankmandiri.co.id/retail/Logout.do?action=result";

        var $cookie="./cookie.txt";
        var $ch;
        var $dom;

        function __construct(){
                $this->dom = new DOMDocument();
        }

        function openCurl(){

                $this->ch = curl_init();
                curl_setopt($this->ch, CURLOPT_HEADER,1);
                curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($this->ch, CURLOPT_USERAGENT,
                        "Mozilla/5.0 (X11; Linux i686 (x86_64); rv:2.0b4pre) Gecko/20100812 Minefield/4.0b4pre");
                curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie);
                curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie);
                curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($this->ch, CURLOPT_SSLVERSION, 1);
        }

        function closeCurl(){
                curl_close($this->ch);
        }

        function browse($url, $post = false, $follow = false){
                $this->openCurl();
                curl_setopt($this->ch, CURLOPT_URL, $url);

                if($post){
                        curl_setopt($this->ch, CURLOPT_POST, 1 );
                        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
                }

                if($follow){
                        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
                }

                $result = array("data"=>curl_exec($this->ch),"info"=>curl_getinfo($this->ch));

                if(!$result['data']){
                        echo 'Curl error: '.curl_error($this->ch);
                }

                $result['headers'] = substr($result['data'], 0, $result['info']['header_size']);
                //      echo $result['data'];
                $this->closeCurl();

                return $result;
        }

        function login(){
                $this->browse($this->login_url);
                //curl_setopt($this->ch, CURLOPT_REFERER, $this->login_url);
                $param = "action=result&userID=".$this->userid."&password=".$this->password."&image.x=0&image.y=0";
                $result = $this->browse($this->login_process_url,$param);
                return $isLogin = strpos($result['headers'], $this->login_success_url);
        }

        function mutasi($dari,$sampai,$rekening=false){
                if(!$rekening){
                        $rekening=$this->rekening;
                }

                $page = $this->browse($this->mutasi_form_url);
                $dom = new DOMDocument();

                libxml_use_internal_errors(true);
                $dom->loadHTML($page['data']);
                $nodes = $dom->getElementsByTagName('select');

                foreach($nodes as $node){
                        if($node->getAttribute('name')=='fromAccountID'){
                                $options = $node->getElementsByTagName('option');
                                $i=1;

                                foreach($options as $option){
                                        if($i=$this->rekening){
                                                $param = "fromAccountID=".$option->getAttribute('value');
                                        }
                                        $i++;
                                }
                        }
                }

                $param.="&action=result&searchType=R&fromDay=".date('d', strtotime($dari))."&fromMonth=".date('n', strtotime($dari))."&fromYear=".date('Y', strtotime($dari))."&toDay=".date('d', strtotime($sampai))."&toMonth=".date('n', strtotime($sampai))."&toYear=".date('Y', strtotime($sampai))."&sortType=Date&orderBy=DESC&lastTransaction=10";
//              die($param);

                $result = $this->browse($this->mutasi_url,$param);
                $mydata = $result['data'];
                unset($result);
                
                return array(   
                                'mutasi'    => $this->parseMutasi($mydata),
                                'soakhir'   => $this->getSaldoAkhir($mydata)
                            );
               
        }


        function getSaldoAkhir($page) {
                    preg_match_all('/<td id="(.*?)">(.*?)<\/td>/si',$page,$grab);
                    $sal=$grab[0][3];
	            	$sald= str_replace(".", "", $sal);
	            	$saldo= strip_tags ($sald);
	            	$saldoo= trim ($saldo);
	            	$saldooo = str_replace( ",", ".", $saldoo);
	            	return $saldooo;
            	            	
        }
        

       function parseMutasi($page){
                preg_match('/<table border="0" cellpadding="2" cellspacing="1" width="100%">(.*?)<\/table>/s', $page, $data);
                preg_match_all('/<tr height="25">(.*?)<\/tr>/si', $data[0], $trs);
                //preg_match_all('#<tr[^>]*>(.*?)</tr>#is', $data[0], $trs);
                $rows=array();
                $i = 0;
                foreach($trs[1] as $tr){
                        $str = preg_replace("/\n+/","",$tr);
                        $str = preg_replace("/<br>/"," ",$str);
                       
                       
                       
                        $strb = $str;
 
                        if($i%1) {
                           preg_match_all("|<td[^>]*>+(.*)</[td>]+>|U", $strb, $tda); 
                          preg_match_all('/<td.*>(.*)<\\/td>/Ui', $strb, $tdb);
                        }      
                        else {
                              preg_match_all('/<td.*>(.*)<\\/td>/Ui', $str, $tda);
                            preg_match_all('/<td.*>(.*)<\\/td>/Ui', $strb, $tdb);
                        }
                        
                        $tgl = $tda[1][0];
                        $ket = $tda[1][1];
                        $deb = $tda[1][2];
                        $debit= substr($deb,0,-3);
		            	$debitt= str_replace(".", "", $debit);
                        $cred = $tdb[1][3];
                        $credit= substr($cred,0,-3);
		            	$creditt= str_replace(".", "", $credit);
                        $i++;
                        $rows[] = array('tanggal' => $tgl,
										'keterangan' => $ket,
										'debit' => $debitt,
										'kredit' => $creditt);
                }
                return $rows;
        }
        
 
 
        
        

        function logout(){
                $this->browse($this->logout_url);
        }

}

?>