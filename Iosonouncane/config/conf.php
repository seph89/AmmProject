<?php
 //classe con le configurazioni e Debug   

    class Conf{   
        protected $DB_HOST = 'localhost';
        protected $DB_USER = 'scanuAndrea';
        protected $DB_PASS = 'gazzella3673';
        protected $DB_NAME = 'amm15_scanuAndrea';
        
        static function debug($item){ //Funzioni di debug
                echo '<pre>';
                print_r($item);
                echo '</pre>';
        }  
        
        static function showerror(){    //Mostra errori mysql
            die("Errore".mysql_errno()." : ".mysql_error());
        }
    }
    
    error_reporting(E_ALL);
?>
