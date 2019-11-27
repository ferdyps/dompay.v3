<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    /** @noinspection PhpIncludeInspection */
    //To Solve File REST_Controller not found
    require APPPATH . '/libraries/REST_Controller.php';
    require APPPATH . '/libraries/Format.php';
    require APPPATH . '/libraries/Mandiri.class.php';
    use Restserver\Libraries\REST_Controller;

    class Mandiri extends REST_Controller {

        public function __construct() {
            parent::__construct();
        }

        public function index_get() {   
            date_default_timezone_set('Asia/Jakarta');

            // userid & PIN mandiri
                
                $bank = $this->get('bank');
                $req = $this->get('req');
                $pass = $this->get('pass');
                $user = $this->get('user');

                define('USERID', $user);
                define('PASSWD', $pass);
                define('ACCNUM', $req);

            // penetapan tanggal from-to mutasi
                $from_date = date("Y-m-01");
                $to_date = date("Y-m-d");
                
            // load Class
                $mandiri = new bankMandiri;
                $mandiri->userid = USERID;
                $mandiri->password = PASSWD;
                $mandiri->rekening = ACCNUM;
                
                $soawal = 0;
                $soakhir = 0;
            // ################ START ACTION ################# \\
                
            if($mandiri->login()) {
                $result = $mandiri->mutasi($from_date,$to_date);
                $mandiri->logout();
                
                $mutasi = $result['mutasi'];
                
                if (is_array($mutasi) || is_object($mutasi)) {
                    $a = json_encode($mutasi);
                    echo $a;    
                }   
            }
        }
        
        
        public function saldo_get() {
            date_default_timezone_set('Asia/Jakarta');

            // userid & PIN mandiri
                
                $bank = $this->get('bank');
                $req = $this->get('req');
                $pass = $this->get('pass');
                $user = $this->get('user');

                define('USERID', $user);
                define('PASSWD', $pass);
                define('ACCNUM', $req);

            // penetapan tanggal from-to mutasi
                $from_date = date("2018-m-01");
                $to_date = date("Y-m-d");
                
            // load Class
                $mandiri = new bankMandiri;
                $mandiri->userid = USERID;
                $mandiri->password = PASSWD;
                $mandiri->rekening = ACCNUM;
                
                $soakhir = 0;
            // ################ START ACTION ################# \\
                
            if($mandiri->login()) {
                $result = $mandiri->mutasi($from_date,$to_date);
                $mandiri->logout();
                
                $soakhir= $result['soakhir'];
                
                echo $soakhir;    
            }
        }
    }
?>