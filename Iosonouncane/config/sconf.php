<?php
//Classe con le configurazioni e Debug --- per Server Web
    class Conf{
            protected $DB_HOST = '...';
            protected $DB_USER = '...';
            protected $DB_PASS = '...';
            protected $DB_NAME = '...';
            
            static function showerror(){  //Mostra errori mysql
                die("Errore".mysql_errno()." : Ci scusiamo per il disagio, si è verificato un
                    errore sul Database");
            }

    }

    error_reporting(0);
?>
