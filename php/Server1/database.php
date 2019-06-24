<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    define('DB_HOST','192.168.0.4');
    define('DB_USER','server1');
    define('DB_PASS','holamundo1234');
    define('DB_NAME','servidor1');

    function connect()
    {
        $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno($connect)) {
            die("Failed to connect:" . mysqli_connect_error());
        }

        mysqli_set_charset($connect, "utf8");

        return $connect;
    }

    $con = connect();
?>