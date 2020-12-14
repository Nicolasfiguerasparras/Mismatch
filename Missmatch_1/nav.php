<?php
    require_once('php/header.php');
    if($_SERVER['PHP_SELF'] == '/SGE/Missmatch/Missmatch_1/login.php'){
        $option = "Home";
        $link = "index.php";
    }else{
        $option = "Log In";
        $link = "login.php";
    };
?>
<header> 
    <nav> 
        <ul>
            <li><a href= "<?php echo $link; ?>"><?php echo $option?></a></li>
        </ul>
    </nav>
</header>