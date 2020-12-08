<?php
    require_once('header.php');
    session_destroy();

    if(!empty($_COOKIE['id'])){
        func::deleteCookie();
    }

    header('Location: index.php');