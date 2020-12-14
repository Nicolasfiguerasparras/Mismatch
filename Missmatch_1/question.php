<?php 
session_start();
$tittle = 'Questioner';
require_once('php/header.php');
if(!func::checkLogin($con)){
	header('Location: index.php');
}
require_once('nav_log.php');

$query = "SELECT * FROM mismatch_response WHERE user_id = '" . $_SESSION['id'] . "'";
$resultset = $cbd->consultaConRetorno($query);
if ($resultset->rowCount() == 0) {

    $query = "SELECT topic_id FROM mismatch_topic ORDER BY category_id, topic_id";
    $topics = $cbd->consultaConRetorno($query);
    $topicIDs = array();
    while ($row = $topics->fetch()) {
        array_push($topicIDs, $row ->topic_id);
    }
    


foreach ($topicIDs as $topic_id) {
     $query = "INSERT INTO mismatch_response (user_id, topic_id) VALUES ('" . $_SESSION['id']. "', '$topic_id')";
     $cbd->retornoNumTuplas($query);
}
}
 if (isset($_POST['submit'])) {
     // Escribimos las respuestas del formulario en la tabla de respuestas
     foreach ($_POST as $response_id => $response) {
         $query = "UPDATE mismatch_response SET response = '$response' WHERE response_id = '$response_id'";
         $cbd->retornoNumTuplas($query);
     }
     echo '<p class="error0">Your responses have been saved.</p>';
}

$query = "SELECT response_id, topic_id, response FROM mismatch_response WHERE user_id = '" .$_SESSION['id'] . "'";
$resultset = $cbd->consultaConRetorno($query);
$responses = array();
while ($row = $resultset->fetch()) {

     // Buscamos el nombre del topic en la tabla topics de la BBDD
     $query2 = "SELECT mismatch_topic.name as my_topic, mismatch_topic.category_id, mismatch_category.name FROM mismatch_topic INNER JOIN mismatch_category USING (category_id) WHERE topic_id = '" . $row ->topic_id . "'";
     $resultset2 = $cbd->consultaConRetorno($query2);
     if ($resultset2->rowCount() == 1) {
         $row2 = $resultset2->fetch();
         $row->topic_name = $row2->my_topic;
         $row->name = $row2->name;
         array_push($responses, $row);
     }
 }
 
 
 
echo '<form class="flexform" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
$category = $responses[0]->name;
echo '<fieldset><legend>' . $responses[0]->name . '</legend>';
foreach ($responses as $response) {
 // Iniciamos un nuevo fieldset si cambia la categoría
     if ($category != $response->name) {
         $category = $response->name;
         echo '<br></fieldset><fieldset><legend>' . $response->name . '</legend>';
     }
 // Visualizamos los topics y los valores de sus respuestas
     echo '<label class="question" ' . ($response->response == NULL ? 'class="error"' : '') . ' for="' . $response->response_id . '">' . $response->topic_name . ':</label>';
     echo '<input type="radio" id="' . $response->response_id . '" name="' . $response->response_id . '" value="1" '. ($response->response == 1 ? 'checked="checked"' : '') . ' />&nbsp;&nbsp;Love &nbsp;&nbsp;';
     echo '<input type="radio" id="' . $response->response_id . '" name="' . $response->response_id . '" value="2" '. ($response->response == 2 ? 'checked="checked"' : '') . ' />&nbsp;&nbsp;Hate<br />';
}
echo '<br></fieldset><br>';
echo '<div class="lastfield"><input class="boton" type="submit" value="Save Questionnaire" name="submit" id="submit" /></div>';
echo '</form>';

?>