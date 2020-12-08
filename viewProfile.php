<?php 
    session_start();
    $title = 'Edit profile';
    require_once('header.php');
    $error = "";

    /***** Allow only logged in users *****/

        if(!func::checkLogin($con)){
            header('Location: login.php');
        }else{
            // Take ID from SESSION into variable
            $id = $_SESSION['id'];

            // Get all data from logged user
            $sql = "SELECT * FROM users WHERE users_id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $row = $stmt-> fetch(PDO::FETCH_ASSOC);
            switch($row['users_status']){
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

            switch($row['users_gender']){
                case 1:
                    $gender = "Women";
                    break;
                case 2:
                    $gender = "Men";
                    break;
            }
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

            <div class="col-6 offset-3">

                <div class="card mb-12">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/profile1.jpg" class="card-img" alt="Profile image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="text-align: center">
                                <h1 class="card-title"><?php echo $row['users_name']; ?></h1>
                                <p class="card-text h4">Username: <?php echo $row['users_username']; ?></p>
                                <p class="card-text h4">Status: <?php echo $status; ?></p>
                                <p class="card-text h4">Name: <?php echo $row['users_name']; ?></p>
                                <p class="card-text h4">Last name: <?php echo $row['users_lastname']; ?></p>
                                <p class="card-text h4">Gender: <?php echo $gender; ?></p>
                                <p class="card-text h4">Birth date: <?php echo $row['users_birthdate']; ?></p>
                                <p class="card-text h4">City: <?php echo $row['users_city']; ?></p>
                                <p class="card-text h4">State: <?php echo $row['users_state']; ?></p>
                            </div>

                            <div class="card-body">
                                <a class="btn btn-primary" href="editProfile.php" style="width: 100%">Edit profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

        </div>

    <!-- /content -->


<?php require_once('footer.php'); ?>