<?php 
    session_start();
    $title = 'Edit profile';
    require_once('header.php');
    $error = "";

    /***** Allow only logged in users *****/

        if(!func::checkLogin($connection)){
            header('Location: login.php');
        }else{
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $status = $_POST['status'];
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $gender = $_POST['gender'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $image = $_FILES['file']['name'];

                if(empty($image)){
                    if(empty($password)){
                        $sql = "UPDATE `users` SET `users_username` = :username, 
                                                    `users_status` = :status, 
                                                    `users_name` = :name, 
                                                    `users_lastname` = :lastname, 
                                                    `users_gender` = :gender,
                                                    `users_city` = :city, 
                                                    `users_state` = :state
                                                WHERE `users_id` = '".$_SESSION['id']."'";
                        $stmt = $connection->prepare($sql);
    
                        $stmt->execute(array(':username'=>$username, ':status'=>$status, 'name'=>$name, ':lastname'=>$lastname, ':gender'=>$gender, ':city'=>$city, ':state'=>$state));
                    }else{
                        $sql = "UPDATE `users` SET `users_username` = :username,
                                                    `users_password` = :password,
                                                    `users_status` = :status, 
                                                    `users_name` = :name, 
                                                    `users_lastname` = :lastname, 
                                                    `users_gender` = :gender,
                                                    `users_city` = :city, 
                                                    `users_state` = :state
                                            WHERE `users_id` = '".$_SESSION['id']."'";
                        $stmt = $connection->prepare($sql);

                        $stmt->execute(array(':username'=>$username, ':status'=>$status, 'name'=>$name, ':lastname'=>$lastname, ':gender'=>$gender, ':city'=>$city, ':state'=>$state, ':password'=>sha1($password)));
                        header('Location: logout.php');
                    }
                }else{
                    if(empty($password)){
                        $sql = "UPDATE `users` SET `users_username` = :username, 
                                                    `users_status` = :status, 
                                                    `users_name` = :name, 
                                                    `users_lastname` = :lastname, 
                                                    `users_gender` = :gender,
                                                    `users_city` = :city, 
                                                    `users_state` = :state,
                                                    `users_picture` = :picture
                                                WHERE `users_id` = '".$_SESSION['id']."'";
                        $stmt = $connection->prepare($sql);
    
                        $stmt->execute(array(':username'=>$username, ':status'=>$status, 'name'=>$name, ':lastname'=>$lastname, ':gender'=>$gender, ':city'=>$city, ':state'=>$state, ':picture'=>"img/".$image));
                        move_uploaded_file($_FILES['file']['tmp_name'], "img/".$_FILES['file']['name']);
                    }else{
                        $sql = "UPDATE `users` SET `users_username` = :username,
                                                    `users_password` = :password,
                                                    `users_status` = :status, 
                                                    `users_name` = :name, 
                                                    `users_lastname` = :lastname, 
                                                    `users_gender` = :gender,
                                                    `users_city` = :city, 
                                                    `users_state` = :state,
                                                    `users_picture` = :picture
                                            WHERE `users_id` = '".$_SESSION['id']."'";
                        $stmt = $connection->prepare($sql);

                        $stmt->execute(array(':username'=>$username, ':status'=>$status, 'name'=>$name, ':lastname'=>$lastname, ':gender'=>$gender, ':city'=>$city, ':state'=>$state, ':picture'=>"img/".$image, ':password'=>sha1($password)));
                        move_uploaded_file($_FILES['picture']['tmp_name'], "imgs/".$_FILES['picture']['name']);
                        header('Location: logout.php');
                    }
                }
            }

            // Take ID from SESSION into variable
            $id = $_SESSION['id'];

            // Get all data from logged user
            $sql = "SELECT * FROM users WHERE users_id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $row = $stmt-> fetch(PDO::FETCH_ASSOC);
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
        
            <div class="col-6 offset-3 edit-profile-box">

                <div class="edit-profile-box-inside">

                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

                        <!-- Hidden ID value -->
                        <input type="hidden" value="<?php echo $row['users_id']; ?>" name="id">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" id="inputEmail4" name="username" value=<?php echo $row['users_username']; ?>>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="If you fill this field, your password will change">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress">Status</label>
                                <?php
                                    if($row['users_status'] == 1){
                                        echo "
                                            <select id='inputState' name='status' class='form-control'>
                                                <option disabled>Choose...</option>
                                                <option value='1' selected>Single</option>
                                                <option value='2'>Married</option>
                                                <option value='3'>Divorced</option>
                                            </select>
                                        ";
                                    }elseif($row['users_status'] == 2){
                                        echo "
                                            <select id='inputState' name='status' class='form-control'>
                                                <option disabled>Choose...</option>
                                                <option value='1'>Single</option>
                                                <option value='2' selected>Married</option>
                                                <option value='3'>Divorced</option>
                                            </select>
                                        ";
                                    }elseif($row['users_status'] == 3){
                                        echo "
                                            <select id='inputState' name='status' class='form-control'>
                                                <option disabled>Choose...</option>
                                                <option value='1'>Single</option>
                                                <option value='2'>Married</option>
                                                <option value='3' selected>Divorced</option>
                                            </select>
                                        ";
                                    }else{
                                        echo "
                                            <select id='inputState' name='status' class='form-control'>
                                                <option selected disabled>Choose...</option>
                                                <option value='1'>Single</option>
                                                <option value='2'>Married</option>
                                                <option value='3'>Divorced</option>
                                            </select>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Name</label>
                                <input type="text" class="form-control" id="inputAddress2" name="name" value="<?php echo $row['users_name']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Last name</label>
                                <input type="text" class="form-control" id="inputCity" name="lastname" value="<?php echo $row['users_lastname']; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Gender</label>
                                <?php
                                    if($row['users_gender'] == 1){
                                        echo "
                                            <select id='inputState' class='form-control' name='gender'>
                                                <option disabled>Choose...</option>
                                                <option value='1' selected>Women</option>
                                                <option value='2'>Men</option>
                                            </select>
                                        ";
                                    }elseif($row['users_gender'] == 2){
                                        echo "
                                            <select id='inputState' class='form-control' name='gender'>
                                                <option selected disabled>Choose...</option>
                                                <option value='1'>Women</option>
                                                <option value='2' selected>Men</option>
                                            </select>
                                        ";
                                    }else{
                                        echo "
                                            <select id='inputState' class='form-control' name='gender'>
                                                <option selected disabled>Choose...</option>
                                                <option value='1'>Women</option>
                                                <option value='2'>Men</option>
                                            </select>
                                        ";
                                    }
                                ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Birth date</label>
                                        <input type="datetime-local" class="form-control" id="inputZip" value="<?php echo $row['users_birthdate']; ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">City</label>
                                <input type="text" class="form-control" id="inputZip" name="city" value="<?php echo $row['users_city']; ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">State</label>
                                <input type="text" class="form-control" id="inputZip" name="state" value="<?php echo $row['users_state']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Profile image</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Edit profile</button>

                    </form>

                </div>

            </div>

        </div>

    <!-- /content -->


<?php require_once('footer.php'); ?>