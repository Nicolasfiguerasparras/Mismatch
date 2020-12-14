<?php 
    session_start();
    $title = 'Edit profile';
    require_once('header.php');
    $error = "";

    // Take ID from SESSION into variable
    $id = $_SESSION['id'];

    /***** Allow only logged in users *****/

        if(!func::checkLogin($connection)){
            header('Location: login.php');
        }else{
            // Get all profiles
            $sql = "SELECT * FROM users WHERE NOT users_id = 1 AND NOT users_id = $id";
            $resulset = $dbc->queryWithReturn($sql);
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

                    <?php
                        $countCards = 0;
                        while($row = $resulset->fetch()){
                            switch($row->users_gender){
                                case 1:
                                    $gender = "Women"; 
                                    break;
                                case 2:
                                    $gender = "Men";
                                    break;
                            }


                            switch($row->users_status){
                                case 1:
                                    $status = "Single";
                                    break;
                                case 2:
                                    $status = "Married";
                                    break;
                                case 3:
                                    $status = "Divorced";
                                    break;

                            }

                            $date = new DateTime($row->users_birthdate);
                            $dateFormatted = $date->format('d-m-Y');

                            echo "
                    <div class='card mb-3' style='max-width: 540px;'>
                        <div class='row no-gutters'>
                            <div class='col-md-4'>
                            <img src='$row->users_picture' class='card-img' alt=''>
                            </div>
                            <div class='col-md-8'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$row->users_username</h5>
                                    <p class='card-text'>Name: $row->users_name</p>
                                    <p class='card-text'>Last name: $row->users_lastname</p>
                                    <p class='card-text'>Status: $status</p>
                                    <p class='card-text'>Gender: $gender</p>
                                    <p class='card-text'>Birth date: $dateFormatted</p>
                                    <p class='card-text'>City: $row->users_city</p>
                                    <p class='card-text'>State: $row->users_state</p>
                                </div>
                            </div>
                        </div>
                    </div>
                            ";

                            if($countCards%3 == 0 && $countCards != 0){
                                echo "
                </div>
                <div class='card-group'>
                                ";
                            }
                            $countCards++;
                        }
                    ?>

                </div>
            
            </div>

        </div>

    <!-- /content -->


<?php require_once('footer.php'); ?>