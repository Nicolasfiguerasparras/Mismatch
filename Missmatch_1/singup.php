<?php 
session_start();
$tittle = 'SigUp';
require_once('php/header.php');
$error=0;
if(func::checkLogin($con)){
	header('Location: login.php');
}
require_once('nav.php');
    
if (isset($_POST['send'])) {
	if (empty ($_POST['name']) || empty ($_POST['username']) || empty($_POST['password1']) || empty($_POST['password2'])) {
		$error= 5;
    }else{
    	$name = $_POST['name'];
  	    $username = $_POST['username'];
  	    $lastname = $_POST['lastname'];
  	    $city = $_POST['city'];
  	    $state = $_POST['state'];
  	    $date = $_POST['birthdate'];
  	    $img = $_FILES['picture']['name'];
  	    
		if (empty($img)) {
  			$img = 'profile0.jpg';
  		}else{
  			if (move_uploaded_file($_FILES['picture']['tmp_name'], "imgs/".$_FILES['picture']['name'])) {
  				$img = $_FILES['picture']['name'];
  			}else{
  				$error= 9;
  				$img = 'profile0.jpg';
  			}
		}
  	
  		if ($_POST['gender'] == 0) {
  			$gender=0;
  		}else{
  			$gender=1;
		}
  	
		if (!empty($_POST['password2'])) {
  			if ($_POST['password1']==$_POST['password2']) {
  				$password = sha1($_POST['password2']);
				}else{
					$error=7;
					}
		}else{
  				$error=7;
  		}
  
		$nick = func::devuelvenick($_POST['username'], $con);
		if ($nick !='') {
  			$error=8;
		}
  	
  		if ($error==0) {
  			$query="INSERT INTO `users` (`users_username`, `users_password`,`users_name`, `users_lastname`, `users_gender`, `users_birthdate`, `users_city`, `users_state`, `users_picture`) VALUES (:username,:password,:name,:lastname,:gender,:date,:city,:state,:picture)";
    		$stmt = $con->prepare($query);
			$stmt->execute(array(':username'=>$username,':password'=>$password,':name'=>$name,':lastname'=> $lastname,':gender'=>$gender,':date'=>$date,':city'=>$city,':state'=>$state,':picture'=>$img));
			func::deleteSession();
	  		header('Location: index.php');
  		}
    }
}

    
?>
    <h1 class="profiledeuser">Create profile</h1>
    <div class="total2">
      <form class="form2" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" id="formu">
      	
   	<div class="fotoPerfil">
				<img src="imgs/profile0.jpg" id="preview"/>
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
				<input type="password" name="password1" id="password1" placeholder="required password">
			</div>
			
			<div>
				<label for="password2">Password</label>
				<input type="password" name="password2" id="password2" placeholder="retype password">
			</div>
			
			<div>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" placeholder="Name">
			</div>
			
			            
			<div>
			    <label for="lastname">last name</label>
			    <input type="text" name="lastname" id="lastname">
			</div>
			
			<div>
				<label for="username">User Name</label>
				<input type="text" name="username" id="username" placeholder="User name">
			</div>
			
			<div>
			    <label for="birthdate">Birthdate</label>
			    <input type="date" name="birthdate" id="birthdate">
			</div>
			
			<div>
			    <label for="city">City</label>
			    <input type="text" name="city" id="city">
			</div>
			
			<div>
			    <label for="state">State</label>
			    <input type="text" name="state" id="state">
			</div>
			
			<div>
			    <label for="gender">Gender</label>
			    <input type="radio" id="male" name="gender" checked>
	                <label for="male">Female</label>
                <input type="radio" id="male" name="gender">
               		<label for="female">Male</label><br>
			</div>
			
			<div>
			 	<button id="boton" type="submit" value="send" name="send" class="button">
			 		Create User
			 	</button>
			 </div>
		</div>
      </form>
    </div>  
<?php
require_once('php/footer.php');
?>