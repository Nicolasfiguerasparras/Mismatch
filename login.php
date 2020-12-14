<?php 
    session_start();
    $title = 'Home';
    require_once('header.php');
    $error = "";

    /***** Allow only clear users *****/

        if(func::checkLogin($con)){
            header('Location: index.php');
        }else{
            if(isset($_POST['submit'])){
                if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
                    $username = $_POST['username'];
                    $password = sha1($_POST['password']);
                    $sql = "SELECT * FROM users WHERE users_username = :username AND users_password = :password";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(':username', $username);
                    $stmt->bindValue(':password', $password);
                    $stmt->execute();
                    $row = $stmt-> fetch(PDO::FETCH_ASSOC);
                    if($row['users_id'] > 0){
                        // Check if user wants to remember session
                        if($_POST['rememberme'] == 1){
                            func::recordSession($con, $row['users_id'], $username, 1);
                        }else{
                            func::recordSession($con, $row['users_id'], $username, 0);
                        }
                        header('Location: index.php');
                    }else{
                        $error = 6; // No user with those credentials
                    }
                }else{
                    $error = 5; // User or password empty
                }
            }
        }

    /***** /allow only clear users *****/
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
        
            <div class="col-6 offset-3 login-box">

                <div class="login-box-inside">

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        
                        <!-- Show errors -->
                            <?php
                                if(isset($_POST['submit'])){
                                    echo func::mostrarError($error);
                                }
                            ?>
                        <!-- /show errors -->

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme" value="1">
                            <label class="form-check-label" for="rememberme">Remember me</label>
                        </div>

                        <button name="submit" type="submit" class="btn btn-success login-submit">Submit</button>

                        <a class="btn btn-light login-singup" href="singup.php">Sing up</a>

                    </form>

                </div>

            </div>

        </div>

    <!-- /content -->


<?php require_once('footer.php'); ?>