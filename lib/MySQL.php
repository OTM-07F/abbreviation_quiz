<?php
    final class MySQL {
        private static $DB_NAME = 'phpdb';
        private static $IP_ADDRESS = '127.0.0.1';
        private static $ID = 'root';
        private static $PW = 'mita0601';

        public static function createPDO() {
            return new PDO('mysql:dbname=' . self::$DB_NAME . ';host=' . self::$IP_ADDRESS, self::$ID, self::$PW, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }

        public static function mysqli_connect() {
            return mysqli_connect(self::$IP_ADDRESS, self::$ID, self::$PW, self::$DB_NAME);
        }
    }

?>
