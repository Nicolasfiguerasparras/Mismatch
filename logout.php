<?php
    require_once('header.php');
    session_unset();
    session_destroy();

    func::deleteCookie();

    header('Location: index.php');