<?php
$tittle = 'Edit profile';
require_once('php/header.php');
session_start();
$error=0;

if(!func::checkLogin($con)){
	header('Location: index.php');
}else{
  require_once('nav_log.php');  
  
  $id = $_SESSION['id'];
  
  $sql='SELECT * FROM `users` WHERE users_id = :id;';
  $stmt = $con->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $row = $stmt-> fetch(PDO::FETCH_OBJ);
  
  $_SESSION['pic'] = $row->users_picture;
  
  if (isset($_POST['Update'])) {
  	$name = $_POST['name'];
  	$lastname = $_POST['lastname'];
  	$city = $_POST['city'];
  	$state = $_POST['state'];
  	$date = $_POST['birthdate'];
  	$img = $_FILES['picture']['name'];
  
  	if (empty($img)) {
  		$img =  $_SESSION['pic'];
  	}else{
  		if (move_uploaded_file($_FILES['picture']['tmp_name'], "imgs/".$_FILES['picture']['name'])) {
  				$img = $_FILES['picture']['name'];
  		}else{
  			$error= 9;
  			$img = $_SESSION['pic'];
  		}
  	}
  	
  	if ($_POST['gender'] == 0) {
  		$gender=0;
  	}else{
  		$gender=1;
  	}
  
  if (empty($_POST['password1']) && empty($_POST['password2'])) {
  	$password = $row->users_password;
  }else{
  	if (empty($_POST['password1']) || empty($_POST['password2'])) {
  		$error=7;
  }else{
  	if ($_POST['password1'] == $_POST['password2']) {
  			$password = sha1($_POST['password2']);
  	}else{
  		$error=7;
  	}
  }	
 }
  	if ($error==0) {
  		$query="UPDATE `users` SET `users_password`= :password,`users_name`= :name,`users_lastname`= :lastname, `users_gender`= :gender,`users_birthdate`= :date,`users_city`= :city,`users_state`= :state,`users_picture`= :img WHERE `users_id` = ".$id.";" ;
    	$stmt = $con->prepare($query);
    	$stmt->execute(array(':password'=>$password, ':name'=>$name,':lastname'=> $lastname, ':gender'=>$gender, ':date'=>$date, ':city'=>$city, ':state'=>$state, ':img'=>$img));
	  	func::deleteSession();
	  	header('Location: index.php');
  	}
  }
}
?>
	<h1 class="profiledeuser">Edit profile</h1>
	
    <div class="total2">
      <form class="form2" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" id="formu">
      	
   	<div class="fotoPerfil">
				<img src="<?php echo "imgs/".$_SESSION['pic']  ?>" id="preview"/>
				<input type="hidden" name="MAX_FILE_SIZE" value="300000"/>
		    <input type="file" name="picture" id="picture";/>
		</div>
		
		<div class="camposPerfil">
			<div id="Control">
			<?php
         echo func::mostrarError($error);
       ?>
		</div>
			<div>
				<label for="password1">Password</label>
				<input type="password" name="password1" id="password1">
			</div>
			
			<div>
				<label for="password2">Password</label>
				<input type="password" name="password2" id="password2" placeholder="retype password">
			</div>
			
			<div>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" value="<?php echo $row->users_name; ?>">
			</div>
			            
			<div>
			    <label for="lastname">last name</label>
			    <input type="text" name="lastname" id="lastname" value="<?php echo $row->users_lastname; ?>">
			</div>
			
			<div>
			    <label for="birthdate">Birthdate</label>
			    <input type="date" name="birthdate" id="birthdate" value="<?php echo strftime('%Y-%m-%d', strtotime($row ->users_birthdate)); ?>">
			</div>
			
			<div>
			    <label for="city">City</label>
			    <input type="text" name="city" id="city" value="<?php echo $row->users_city; ?>">
			</div>
			
			<div>
			    <label for="state">State</label>
			    <input type="text" name="state" id="state" value="<?php echo $row->users_state; ?>">
			</div>
			
			<div>
			    <label for="gender">Gender</label>
			    <input type="radio" id="male" name="gender" value="0" <?php if ($row->users_gender==0) {echo "checked";};?>>
	                <label for="male">Female</label>
                <input type="radio" id="male" name="gender" value="1" <?php if ($row->users_gender==1) {echo "checked";};?>>
               		<label for="female">Male</label><br>
			</div>
			
			<div>
			 	<button id="boton" type="submit" value="Update" name="Update" class="button">
			 		update
			 	</button>
			 </div>
		</div>
      </form>
    </div>          
<?php
require_once('php/footer.php');
?>