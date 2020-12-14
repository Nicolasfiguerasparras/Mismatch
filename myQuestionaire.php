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
            if (isset($_POST['submit'])) {
                foreach ($_POST as $name => $value) {
                    $query = "UPDATE mismatch_response SET response = '$value' WHERE response_id = '$name'";
                    $conbd->retornoNumTuplas($query);
                }
            }

            // Take ID from SESSION into variable
            $id = $_SESSION['id'];

            // Get all data from logged user
            $sql = "SELECT * FROM users WHERE users_id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            
            $stmt->execute();
            $loggedUserData = $stmt-> fetch(PDO::FETCH_ASSOC);

            // Get responses
            $sql = "SELECT * FROM mismatch_response WHERE user_id = '$loggedUserData[users_id]'";
            $resulset = $conbd->consultaConRetorno($sql);

            // Check if user has any record on DB
            if($resulset->rowCount() == 0){
                $sql = "SELECT * FROM mismatch_topic ORDER BY category_id, topic_id";
                $topics = $conbd->consultaConRetorno($sql);
                $topicIDs = array();
                while ($row = $topics->fetch()) {
                    array_push($topicIDs, $row->topic_id);
                }

                foreach ($topicIDs as $topic_id) {
                    $query = "INSERT INTO mismatch_response (user_id, topic_id) VALUES ('$id', '$topic_id')";
                    $conbd->retornoNumTuplas($query);
                }
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

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                    <?php

                        $countResponse = 1;

                        for ($i=0; $i < 5; $i++) { 
                            $sql = "SELECT * FROM mismatch_category WHERE category_id = $i+1";
                            $stmt = $con->prepare($sql);
                            $stmt->execute();
                            $categories = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo "
                                <div class=card-group>
            
                                    <div class=card>

                                        <div class='card-body'>
                                            <h5 class='card-title'>".$categories['category_name']."</h5>
                                            <p class='card-text'>
                                                <div class='form-group row'>
                            ";
                            for ($x=0; $x < 5; $x++) {
                                $sql = "SELECT * FROM mismatch_topic WHERE topic_id = $countResponse";
                                $stmt = $con->prepare($sql);
                                $stmt->execute();
                                $currentTopic = $stmt->fetch(PDO::FETCH_ASSOC);

                                $sql = "SELECT * FROM mismatch_response WHERE response_id = $countResponse";
                                $stmt = $con->prepare($sql);
                                $stmt->execute();
                                $currentResponse = $stmt->fetch(PDO::FETCH_ASSOC);

                                echo "
                                                    <label for='staticEmail' class='col-3 col-form-label'>$currentTopic[name]</label>
                                                    <div class='col-sm-9'>
                                                        <div class='form-check'>
                                ";

                                // Check if user has answered this question
                                if($currentResponse['response'] != null){
                                    if($currentResponse['response'] == 1){
                                        echo "
                                                            <input class='form-check-input' type='radio' name='$countResponse' id='$countResponse' value='1' checked>
                                                            <label class='form-check-label' for='$countResponse'>
                                                                Love
                                                            </label>
                                                        </div>

                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='$countResponse' id='$countResponse' value='0'>
                                                            <label class='form-check-label' for='$countResponse'>
                                                                Hate
                                                            </label>
                                                        </div>
                                        ";
                                    }else{
                                        echo "
                                                            <input class='form-check-input' type='radio' name='$countResponse' id='$countResponse' value='1'>
                                                            <label class='form-check-label' for='$countResponse'>
                                                                Love
                                                            </label>
                                                        </div>

                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='$countResponse' id='$countResponse' value='0'checked>
                                                            <label class='form-check-label' for='$countResponse'>
                                                                Hate
                                                            </label>
                                                        </div>
                                        ";
                                    }
                                }else{
                                    echo "
                                                            <input class='form-check-input' type='radio' name='$countResponse' id='$countResponse' value='1'>
                                                            <label class='form-check-label' for='$countResponse'>
                                                                Love
                                                            </label>
                                                        </div>

                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='$countResponse' id='$countResponse' value='0'>
                                                            <label class='form-check-label' for='$countResponse'>
                                                                Hate
                                                            </label>
                                                        </div>
                                    ";
                                }
                                echo "
                                                    </div>
                                ";
                                $countResponse++;
                            }

                            echo "
                                                </div>

                                            </p>

                                        </div>

                                    </div>

                                </div>
                            ";
                            
                        }

                    ?>

                    <br>
                    
                    <button class="button btn-primary" name="submit" type="submit" style="width: 100%;">Enviar</button>

                </form>

            </div>

        </div>

    <!-- /content -->

<?php require_once('footer.php'); ?>