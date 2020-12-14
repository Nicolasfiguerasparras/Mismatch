<?php 
    session_start();
    $title = 'Sing up';
    require_once('header.php');

    $conbd = new ConectorBD(array(
        'driver'=> 'mysql',
        'host'=> 'localhost',
        'dbname'=> 'mismatch',
        'username' => 'root',
        'password' => '',));

    $error = "";


    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $status = $_POST['status'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        $query = "INSERT INTO `users` (`users_id`, 
                                     `users_username`, 
                                     `users_password`, 
                                     `users_status`, 
                                     `users_name`, 
                                     `users_lastname`, 
                                     `users_gender`, 
                                     `users_birthdate`, 
                                     `users_city`, 
                                     `users_state`
                                    ) 
                            VALUES  (NULL, 
                                    '$username', 
                                    '$password', 
                                    $status, 
                                    '$name', 
                                    '$lastname', 
                                    $gender, 
                                    '$birthdate', 
                                    '$city', 
                                    '$state')";
                            
        $conbd->returnTupleNumber($query);

        header('Location: login.php');
    }
?>

    <!-- Navbar -->

        <div class="row">

            <div class="col-12">
                
                <?php require_once('navbar/navClearUser.php'); ?>

            </div>

        </div>

    <!-- /navbar -->

    <!-- Content -->

        <div class="row content">
        
            <div class="col-6 offset-3 edit-profile-box">

                <div class="edit-profile-box-inside">

                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" id="inputEmail4" name="username">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4" name="password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress">Status</label>
                                <select id='inputState' name='status' class='form-control'>
                                    <option disabled selected>Choose...</option>
                                    <option value='1'>Single</option>
                                    <option value='2'>Married</option>
                                    <option value='3'>Divorced</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Name</label>
                                <input type="text" class="form-control" id="inputAddress2" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Last name</label>
                                <input type="text" class="form-control" id="inputCity" name="lastname">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Gender</label>
                                <select id='inputState' class='form-control' name='gender'>
                                    <option disabled selected>Choose...</option>
                                    <option value='1'>Women</option>
                                    <option value='2'>Men</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Birth date</label>
                                <input type="date" class="form-control" id="inputZip" name="birthdate">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">City</label>
                                <input type="text" class="form-control" id="inputZip" name="city">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">State</label>
                                <input type="text" class="form-control" id="inputZip" name="state">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Create user</button>

                    </form>

                </div>

            </div>

        </div>

    <!-- /content -->


<?php require_once('footer.php'); ?>