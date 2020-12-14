<header>
         <ul>
            <li class="hola">Hello &nbsp;<?php echo $_SESSION['username'];?>&nbsp;
                <img src="<?php echo "imgs/".$pic = func::devuelveImg($_SESSION['id'],$con);?>" class="imgicon" width= "50">
            </li>
        </ul>
    <nav>  
        <ul>
            <li><a href="index.php"><p>HOME</p></a></li>
            <li><a href="viewProfile.php"><p>VIEW PROFILE</p></a></li>
            <li><a href="edit.php"><p>EDIT PROFILE</p></a></li>
            <li><a href="question.php"><p>MY QUESTIONAIRE</p></a></li>
            <li><a href="mymismatch.php"><p>MY MISMATCH</p></a></li>
            <li><a href="logout.php"><p>LOGOUT</p></a></li>
        </ul>
    </nav>
</header>