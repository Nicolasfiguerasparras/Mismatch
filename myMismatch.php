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

        if(!func::checkLogin($connection)){
            header('Location: login.php');
        }else{
            // Take ID from SESSION into variable
            $id = $_SESSION['id'];

            /********** Get all data from logged user **********/

                $sql = "SELECT * FROM users WHERE users_id = :id";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                $loggedUserData = $stmt-> fetch(PDO::FETCH_ASSOC);

            /********** /get all data from logged user **********/

            /********** Check if user has answered questionaire **********/

                $sql = "SELECT * FROM mismatch_response WHERE user_id = $id";
                $answers = $conbd->queryWithReturn($sql);
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

                // Maximum mismatch
                $mismatch = array(
                    "user_id" => 0,
                    "points" => 0
                );

                // Get all users id's and save into associative array
                $sql = "SELECT * FROM users WHERE NOT users_id = $id AND NOT users_id = 1";
                $users = $conbd->queryWithReturn($sql);
                $usersIDs = array();
                while ($row = $users->fetch()) {
                    array_push($usersIDs, $row->users_id);
                }

                // Create multidimensional array with a clean array for each user
                for ($i=0; $i < sizeof($usersIDs); $i++) { 
                    $usersToCompare[$usersIDs[$i]] = array();
                }

                // Get answers from logged user
                $sql = "SELECT * FROM mismatch_response WHERE user_id = $id";
                $resultUserAnswers = $conbd->queryWithReturn($sql);
                $userAnswers = array();
                while ($row = $resultUserAnswers->fetch()) {
                    $userAnswers[$row->topic_id] = $row->response;
                }

                // Get answers from other users and fill multidimensional array with all answers from each user
                $sql = "SELECT * FROM mismatch_response WHERE NOT user_id = $id AND NOT user_id = 1";
                $resultOtherAnswers = $conbd->queryWithReturn($sql);
                while($row = $resultOtherAnswers->fetch()){
                    $usersToCompare[$row->user_id] += [$row->topic_id => $row->response];
                }

                // Compare all answers of each user with logged-in's user
                foreach($usersToCompare as $key=>$actualUser){
                    // Initializate an auxiliar counter to look how many points it has
                    $auxPointsCounter = 0;
                    for($x=1; $x <= 25; $x++){
                        // If they mismatch, increase point's counter
                        if(($actualUser[$key] + $userAnswers[$x]) == 1){
                            $auxPointsCounter++;
                        }
                    }

                    // Check if actual points are higher than the last highest
                    if($auxPointsCounter > $mismatch['points']){
                        // Save user_id and the score
                        $mismatch = array(
                            "user_id" => $key,
                            "points" => $auxPointsCounter
                        );
                    }
                }

                /********** Get mismatch topics **********/

                    // Get mismatch info
                    $sql = "SELECT * FROM users WHERE users_id = $mismatch[user_id]";
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $mismatchInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Initialize arrays to save all mismatch topics and answers
                    $mismatchAnswers = array();
                    $mismatchTopics = array();

                    // Get answers from mismatch
                    $sql = "SELECT * FROM mismatch_response WHERE user_id = $mismatch[user_id]";
                    $mismatchAnswersResulset = $conbd->queryWithReturn($sql);
                    while($row = $mismatchAnswersResulset->fetch()){
                        $mismatchAnswers += [$row->topic_id => $row->response];
                    }                    

                    // Get mismatch topics
                    for($x=1; $x <= 25; $x++){
                        if(($mismatchAnswers[$x] + $userAnswers[$x]) == 1){
                            // Get current topic info
                            $sql = "SELECT * FROM mismatch_topic WHERE topic_id = $x";
                            $stmt = $connection->prepare($sql);
                            $stmt->execute();
                            $currentTopicMismatched = $stmt->fetch(PDO::FETCH_ASSOC);
                            $mismatchTopics[] = $currentTopicMismatched['name'];
                        }
                    }

                /********** /get mismatch topics **********/
               

            /********** /get mismatch for user **********/
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
                            <img src="<?php echo $mismatchInfo['users_picture']; ?>" class="card-img" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="text-align: center">
                                <h1 class="card-title">Your mismatch is: <?php echo $mismatchInfo['users_username']; ?>. <br>The topics are:</h1>
                                <?php
                                    foreach($mismatchTopics as $topic){
                                        echo "<p class='card-text h4'>$topic</p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>        

        </div>

    <!-- /content -->

<?php require_once('footer.php'); ?>