<?php
    session_start();
    $title = 'Edit profile';
    require_once('header.php');

    // QUE COSA MÁS PERRA POR DIOS
        $conbd = new ConectorBD(array(
            'driver'=> 'mysql',
            'host'=> 'localhost',
            'dbname'=> 'mismatch',
            'username' => 'root',
            'password' => '',));
    // FIN DEL CODIGO PERRO
    $error = "";

    /***** Allow only logged in users *****/

        if(!func::checkLogin($con)){
            header('Location: login.php');
        }else{
            // Take ID from SESSION into variable
            $id = $_SESSION['id'];

            /********** Get all data from logged user **********/

                $sql = "SELECT * FROM users WHERE users_id = :id";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                $loggedUserData = $stmt-> fetch(PDO::FETCH_ASSOC);

            /********** /get all data from logged user **********/

            /********** Check if user has answered questionaire **********/

                $sql = "SELECT * FROM mismatch_response WHERE user_id = $id";
                $answers = $conbd->consultaConRetorno($sql);
                $answered = 0;
                
                while ($row = $answers->fetch()) {                
                    if(!is_null($row->response)){
                        $answered = 1;
                    }
                }

                if($answered == 0){
                    header('Location: myQuestionaire.php');
                }

            /********** /check if user has answered questionaire **********/

            /********** Get mismatch for user **********/

                // Get answers from user
                $sql = "SELECT * FROM mismatch_response WHERE user_id = $id";
                $resultUserAnswers = $conbd->consultaConRetorno($sql);
                $userAnswers = array();
                while ($row = $resultUserAnswers->fetch()) {
                    $userAnswers[$row->topic_id] = $row->response;
                }

                // Get answers from other users
                $sql = "SELECT * FROM mismatch_response WHERE NOT user_id = $id";
                


            /********** /fet mismatch for user **********/
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

            

        </div>

    <!-- /content -->

<?php require_once('footer.php'); ?>