<?php 
    session_start();
    $title = 'Edit profile';
    require_once('header.php');
    $error = "";

    /***** Allow only logged in users *****/

        if(!func::checkLogin($con)){
            header('Location: login.php');
        }else{

        }

    /***** /allow only clear users *****/

?>

    <!-- Navbar -->

        <div class="row">

            <div class="col-12">
                
                <?php require_once('navbar/navLoggedUser.php'); ?>

            </div>

        </div>

    <!-- /navbar -->

    <!-- Content -->

        <div class="row content">

            <div class="col-10 offset-1">

                <div class="card-group">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="img/profile1.jpg" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Username</h5>
                                    <p class="card-text">Name: </p>
                                    <p class="card-text">Last name: </p>
                                    <p class="card-text">Status: </p>
                                    <p class="card-text">Gender: </p>
                                    <p class="card-text">Birth date: </p>
                                    <p class="card-text">City: </p>
                                    <p class="card-text">State: </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="img/profile2.jpg" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Username</h5>
                                    <p class="card-text">Name: </p>
                                    <p class="card-text">Last name: </p>
                                    <p class="card-text">Status: </p>
                                    <p class="card-text">Gender: </p>
                                    <p class="card-text">Birth date: </p>
                                    <p class="card-text">City: </p>
                                    <p class="card-text">State: </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="img/profile3.jpg" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Username</h5>
                                    <p class="card-text">Name: </p>
                                    <p class="card-text">Last name: </p>
                                    <p class="card-text">Status: </p>
                                    <p class="card-text">Gender: </p>
                                    <p class="card-text">Birth date: </p>
                                    <p class="card-text">City: </p>
                                    <p class="card-text">State: </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

        </div>

    <!-- /content -->


<?php require_once('footer.php'); ?>