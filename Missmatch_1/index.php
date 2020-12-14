<?php
    $tittle = 'Home';
    require_once('php/header.php');
    session_start();
    if (!func::checkLogin($con)){
            require_once('nav.php');
    }else{
        $username = $_SESSION['username'];
        require_once('nav_log.php');
    }
    
?>
 <div class="wrapper">
        <div class="login-header">
            <h3>MISMATCH INDEX.PHP</h3>
        </div>
    </div>
<?php require_once('php/footer.php'); ?>