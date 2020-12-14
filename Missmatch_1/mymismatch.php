<?php 
session_start();
$tittle = 'My mismatch';
require_once('php/header.php');
$error=0;
if(!func::checkLogin($con)){
	header('Location: login.php');
}
require_once('nav_log.php');
$id = $_SESSION['id'];

$query="SELECT `response` FROM `mismatch_response` WHERE `user_id`= :id;";
$stmt = $con->prepare($query);
$stmt->execute(array(':id'=>$id));
$row = $stmt-> fetch(PDO::FETCH_OBJ);
$num = $stmt->rowCount();

if ($num == 0) {
    header('Location: question.php');
}else{

	$mis_puntuacion=0;
	$mis_usuarioElegido=-1;
	$mis_topics = array();

    $query = "SELECT response_id, user_id, mismatch_response.topic_id, response FROM mismatch_topic, mismatch_response WHERE mismatch_response.user_id = mismatch_topic.topic_id AND mismatch_response.user_id ='".$_SESSION['id']."'";
    $response = $cbd->consultaConRetorno($query);
    $respuestas_Usuario = array();
    while($response->fetch(PDO::FETCH_ASSOC)){
    	array_push($respuestas_Usuario, $row);
    }

    $query ="SELECT users_id FROM users WHERE users_id != '1' AND users_id != '".$_SESSION['id']."'";
    $resulset_users= $cbd->consultaConRetorno($query);

    while($row = $resulset_users->fetch(PDO::FETCH_ASSOC)){
    	$query2 = "SELECT response_id, user_id, topic_id, response FROM mismatch_topic, mismatch_response WHERE mismatch_response.user_id = mismatch__topic.topic_id AND mismatch_response.user_id ='".$row['user_id']."'";
    	$response2 = $cbd->consultaConRetorno($query2);
    	if($response2->rowCount()>0){
    		$mismatch_responses =array();
    		while($row2 = $response->fetch()){
    			array_push($mismatch_response, $row2);
    		}
    		$score = 0;
    		$topics = array();
    		for($i =0; $i < count($respuestas_Usuario); $i++){
    			if($respuestas_Usuario[$i]['response']+ $mismatch_response[$i]['response']){
    					$score+=1;
    					array_push($topics, $respuestas_Usuario[$i]['topic_name']);
    				}
    			}

    			if ($score > $mismatch_score) {
    				$mis_puntuacion = $score;
    				$mis_usuarioElegido = $row['user_id'];
    				$mis_topics = array_slice($topics, 0);
    			}
    		}
        }
        
        echo $mis_usuarioElegido;

    	if($mis_usuarioElegido != -1){
            $query = "SELECT username, firstname, lastname, city, state, picture FROM users WHERE id ='$mis_usuarioElegido'";
            $resultset = $cbd->getQuery($query);
            if($resultset->rowCount()>0){
                $row = $resultset->fetch();
                echo '<h2>Your soul mate: </h2><br>';
                echo '<div><div class="row relative">';
                echo '<div class="mymismatch">';
                echo '<div class="myright">';

                if(!empty($row['user_firstname']) && !empty($row['user_lastname'])){ 
                	echo $row['user_firstname'].','.$row['user_lastname'].'<br />';
                }

                if(!empty($row['user_city']) && !empty($row['user_state'])){ 
                	echo $row['user_city'].','.$row['user_state'].'<br />';
                }

                echo '</div>';
                // if (!empty($row['user_picture'])) {
                // 	echo '<div';
                // }
            }
        }
    }
