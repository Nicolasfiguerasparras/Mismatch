<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $config = array(
            'driver'=> 'mysql',
            'host'=> 'localhost',
            'dbname'=> 'mismatch',
            'username' => 'root',
            'password' => '',
    );
    
    require_once('functions.php');
    require_once('ConectorBD.php');
    $cbd = new ConectorBD($config);

    $con = $cbd ->getCon();