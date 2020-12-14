<?php 
require_once('php/functions.php');
func::deleteSession();
header('Location: index.php');
?>