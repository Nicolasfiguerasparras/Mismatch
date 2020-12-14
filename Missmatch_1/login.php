<?php
$tittle = 'Login';
require_once('php/header.php');
session_start();
$error="";
    if(!func::checkLogin($con)){
        require_once('nav.php');
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
                if($row['users_id'] >0){
                    $remenber = 0;
                    if(isset($_POST['rememberme'])){
                        $remenber = 1;    
                    }
                    func::recordSession($con,$row['users_id'],$username,$remenber);
                    header('Location: index.php');
                }else{
                    $error = 6;
                }
            }else{
                $error = 5;
            }
        }
    }else{
        header('Location: index.php');
    }
?>

        </header>
        <div class="wrapper">
            <div class="login-header">
                <h3>MISSMATCH LOGIN FORM</h3>
            </div>
            <?php
                echo func::mostrarError($error);
            ?>
            <form id="loginform" method="post" class="loginform" action="<?php echo $_SERVER['PHP_SELF'];?>">      
                <div class="field">
                    <label for="username">Name:</label>
                    <input type="text" name="username" id="username" placeholder="User">
                </div>
                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="field">
                    <input type="checkbox" name="rememberme" id="rememberme">
                    <label for="name">Remember me:</label>
                </div>
                <div class="field">
                    <a href="singup.php">Sing Up</a>
                </div>
                <div class="field">
                    <button name="submit" type="submit" form="loginform" class="button">
                        Send
                    </button>
                </div>
            </form>
        </div>
  <?php 
    require_once('php/footer.php');
?>