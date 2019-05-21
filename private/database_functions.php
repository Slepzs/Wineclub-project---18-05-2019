<?php 
    
    // Forbindelsen der connecter til databasen;
    function db_connect() {
        $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        confirm_db_connect($connection);
        return $connection;
    }

    // Funktion der tjekker om der rent faktisk er forbindelse til databasen. Hvis det ikke virker får vi en fejlmeddelese. Smart. 
    function confirm_db_connect($connection) {
        if($connection->connect_errno) {
            $msg = "Database connection failed: ";
            $msg .= $connection->connect_error;
            $msg .= " (" . $connection->connect_errno . ")";
            exit($msg);
        }
    }
    


    // function der tjekker om en funktion faktisk er startet, før den prøver at lukke den. Funktionen bliver så kaldt i shared/public_footer.php
    function db_disconnect($connection) {
        if(isset($connection)) {
            $connection->close();
        }
    }
    
    ?>
    