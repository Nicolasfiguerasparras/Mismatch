<?php 
    session_start();
    $title = 'Home';
    require_once('header.php'); 
?>

    <!-- Navbar -->

        <div class="row">

            <div class="col-12">
                
                <?php

                    /***** Navbar load *****/

                        if(!func::checkLogin($con)){
                            require_once('navbar/navClearUser.php');
                        }else{
                            $username = $_SESSION['username'];
                            require_once('navbar/navLoggedUser.php');
                        }

                    /***** /navbar load *****/

                ?>

            </div>

        </div>

    <!-- /navbar -->

    <!-- Content -->

        <div class="row">
            <div class="col-6 offset-3">
                
            </div>
        </div>

    <!-- /content -->

<?php require_once('footer.php'); ?>