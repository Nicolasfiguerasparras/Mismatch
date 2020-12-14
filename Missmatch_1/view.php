<?php
$tittle = 'Vew';
require_once('php/header.php');
session_start();
if(!func::checkLogin($con)){
	header('Location: index.php');
}else{
  require_once('nav_log.php');  
  $id = $_GET['id'];
  $sql='SELECT * FROM `users` WHERE users_id = :id;';
  $stmt = $con->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $row = $stmt-> fetch(PDO::FETCH_OBJ);
}
?>
	  <h1 class="profiledeuser">View <?php echo $row->users_name ?></h1>
    <div class="total2">
      <form class="form2">
        <?php 
        
        if ($row->users_gender == 0) {
          $gender="female";
        }else{
          $gender="male";
        }
        
        $fecha = new DateTime($row->users_birthdate);
        $fechaform = $fecha->format('d-m-Y');
        echo 
              '<div class="fotoPerfil">
			              <img src="imgs/'.$row->users_picture.'"">
			          </div>
			          <div class="camposPerfil">
			            <div>
			              <label for="username">User name</label>
			              <input type="text" readonly name="username" id="username" value="'.$row->users_name.'">
			            </div>
			            
			            <div>
			              <label for="lastname">last name</label>
			              <input type="text" readonly name="lastname" id="lastname" value="'.$row->users_lastname.'">
			            </div>
			            
			            <div>
			              <label for="gender">Gender</label>
			              <input type="text" readonly name="gender" id="gender" value="'.$gender.'">
			            </div>
			            
			            <div>
			              <label for="birthdate">Birthdate</label>
			              <input type="text" readonly name="birthdate" id="birthdate" value="'.$fechaform.'">
			            </div>
			            
			             <div>
			              <label for="city">City</label>
			              <input type="text" readonly name="City" id="City" value="'.$row->users_city.'">
			            </div>
			            
			              <div>
			              <label for="state">State</label>
			              <input type="text" readonly name="state" id="state" value="'.$row->users_state.'">
			            </div>
			            
			          </div>';
              ?>
      </form>
    </div>          
<?php
require_once('php/footer.php');
?>