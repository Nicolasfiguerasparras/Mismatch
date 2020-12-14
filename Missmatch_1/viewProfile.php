<?php 
session_start();
$tittle = 'Vew Profile';
require_once('php/header.php');
if(!func::checkLogin($con)){
	header('Location: index.php');
}
require_once('nav_log.php');?>
	    <div class="Total">
               <?php 
                $sql='SELECT * FROM `users` ORDER BY `users_id` DESC LIMIT 12;';
                $stmt = $con->prepare($sql);
                $stmt->execute();
			    while($row = $stmt-> fetch(PDO::FETCH_OBJ)){
			        
			    echo '<div class="global">';
			        echo '<div class = "nombreUsuario"><a title="profile" href="view.php?id='.$row->users_id.'">'.$row->users_username.'</div>';
			        echo '<div class = "imagenUsuario" style="background-image:url(imgs/'.$row->users_picture.')"></div>';
			    echo '</div>';
			    
			    }
              ?>
	    </div>
<?php
require_once('php/footer.php');
?>