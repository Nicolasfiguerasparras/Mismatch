<?php
/**
 * Esta función devuelve una cadena aleatoria generada en base a un conjuunto de caracteres.
 * $long Es el tamaño de la cadena que queremos generar.
 *
 */
class func
{
    static function createSerial($long)
    {
        $resultado = 0;
        $frase = "";
        $grupoCaracteres = "InJuneduringan85minuteeventcalledTheFutureofGamingSonyfinallyrevealedthePlayStation5Betweenthepresenterswho";
        $numCar = strlen($grupoCaracteres); //Esta función te cuenta el número de caracteres.
        while ($resultado != $long)
        {
            $pos = rand($numCar * -1, $numCar); //Desde donde quieres que empeice a buscar
            $frase .= substr($grupoCaracteres, $pos, 1); //Te saca un número de caracteres que le indicas con la última variable, empezando por el valor de pos
            $resultado = $resultado + 1;
        }
        return $frase;
    }

    /**
     * Función que usamos para gestionar errores
     * $errorCode variable que indica el número de error. Por defecto es cero
     *
     */
    public static function mostrarError($error = 0)
    {
        switch ($error)
        {
            case 0:
                $mensaje = '<span class ="noerror"></span>';
            break;
            case 5:
                $mensaje = '<span class ="error">Campos obligatorios</span>';
            break;
            case 6:
                $mensaje = '<span class ="error">Usuario o contraseña incorrectos</span>';
            break;
            case 7:
                $mensaje = '<span class ="error">contraseña incorrecta</span>';
            break;
            case 8:
                $mensaje = '<span class ="error">Usuario existente</span>';
            break;
            case 9:
                $mensaje = '<span class ="error">Error cargando imágen</span>';
            break;
            default:
                $mensaje = '<span class ="error">Error interno. Has hecho algo mal</span>';
        }
        return $mensaje;
    }

	public static function checklogin($dbc){
         if(isset($_COOKIE['id']) && isset($_COOKIE['token'])){
            $user_id = $_COOKIE['id'];
            $token = $_COOKIE['token'];
            $query="SELECT * FROM sessions WHERE sessions_userid= :user_id AND sessions_token= :token " ;
            $stmt = $dbc->prepare($query);
            $stmt->execute(array('user_id'=>$user_id,'token'=>$token));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['sessions_userid']>0){
                func::createSession($_COOKIE['id'],$_COOKIE['username'],$_COOKIE['token']);
                return true;
            }
            }elseif(isset($_SESSION['id'])){
                    $user_id = $_SESSION['id'];
                    $tokensession = $_SESSION['token'];
                    $query="SELECT * FROM sessions WHERE sessions_userid= :id AND sessions_token= :token " ;
                    $stmt = $dbc->prepare($query);
                    $stmt->execute(array('id'=>$user_id,'token'=>$tokensession));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row['sessions_userid']>0){
                                return true;
                        }else{
                                return false;
                        }
            }else{
                    return false;
            }
}
    public static function createSession($id, $username, $token)
    {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['token'] = $token;
    }

    public static function deleteCookie()
    {
        setcookie('id', '', time() - 3600, "/");
        setcookie('username', '', time() - 3600, "/");
        setcookie('token', '', time() - 3600, "/");
        setcookie('PHPSESSID', '', time() - 3600, "/");
    }

    public static function createCookie($id, $username, $token)
    {
        setcookie('id', $id, time() + (3600 * 24 * 7) , "/");
        setcookie('username', $username, time() + (3600 * 24 * 7) , "/");
        setcookie('token', $token, time() + (3600 * 24 * 7) , "/");
    }

    public static function recordSession($cbd, $id, $username, $remember)
    {
        $stmt = $cbd->prepare("DELETE FROM sessions WHERE sessions_userid = :id");
        $stmt->execute(array(':id' => $id));
        $token = func::createSerial(40);
        if ($remember == 1)
        {
            func::createCookie($id, $username, $token);
        }
        
        func::createSession($id, $username, $token);
        $stmt = $cbd->prepare("INSERT INTO sessions (sessions_id, sessions_token, sessions_date, sessions_userid) VALUES (NULL, :token, now(), :userid);");
        $stmt->execute(array(':token' => $token,':userid' => $id));
    }
    
    public static function deleteSession(){
    	if(isset($_COOKIE)){
    		func::deleteCookie();
    		session_unset();
    		session_destroy();
    	}else{
    		session_unset();
    		session_destroy();
    	}
    }
    
      public static function devuelveNick($username,$cbd)
    {
       $query="SELECT users_username FROM users WHERE users_username = :username;" ;
       $stmt = $cbd->prepare($query);
       $stmt->execute(array(':username'=>$username));
       $row = $stmt->fetch(PDO::FETCH_OBJ);
       $nick = $row->users_username;
    }
    
          public static function devuelveImg($id,$cbd)
    {
       $query="SELECT users_picture FROM users WHERE users_id = :id;" ;
       $stmt = $cbd->prepare($query);
       $stmt->execute(array(':id'=>$id));
       $row = $stmt->fetch(PDO::FETCH_OBJ);
       $img = $row->users_picture;
       return $img;
    }
}
?>
