<?php
    class func {

        /**
         * Esta función devuelve una cadena aleatoria generada en base a un conjuunto de caracteres.
         * $long Es el tamaño de la cadena que queremos generar.
         *
         */
        static function createSerial($long) {
            $resultado = 0;
            $frase = "";
            $grupoCaracteres = "InJuneduringan85minuteeventcalledTheFutureofGamingSonyfinallyrevealedthePlayStation5Betweenthepresenterswho";
            $numCar = strlen($grupoCaracteres);
            while ($resultado != $long) {
                $pos = rand($numCar * -1, $numCar);
                $frase .= substr($grupoCaracteres, $pos, 1);
                $resultado = $resultado + 1;
            }
            return $frase;
        }

        /**
         * Función que usamos para gestionar errores
         * $errorCode variable que indica el número de error. Por defecto es cero
         *
         */
        public static function mostrarError($error = 0) {
            switch ($error) {
                case 0:
                    $errorMsg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Success!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    break;
                case 5:
                    $errorMsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    One or both fields are empty!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    break;
                case 6:
                    $errorMsg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Invalid user/password!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    break;
                default:
                    $errorMsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    Something were wrong!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    break;
            }
            return $errorMsg;
        }

        static function checklogin($dbc){
            
            if(isset($_COOKIE['id']) && isset($_COOKIE['token'])){
                $user_id = $_COOKIE['id'];
                $token = $_COOKIE['token'];
                $query = "SELECT * FROM sessions WHERE sessions_userid= :user_id AND sessions_token= :token " ;
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
                $query="SELECT * FROM sessions WHERE sessions_userid= :user_id AND sessions_token= :token " ;
                $stmt = $dbc->prepare($query);
                $stmt->execute(array('user_id'=>$user_id,'token'=>$tokensession));
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

        public static function createSession($id, $username, $token) {
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['token'] = $token;
        }

        public static function deleteCookie() {
            setcookie('id', '', time() - 3600, "/");
            setcookie('username', '', time() - 3600, "/");
            setcookie('token', '', time() - 3600, "/");
            setcookie('PHPSESSID', '', time() - 3600, "/");
        }

        public static function createCookie($id, $username, $token) {
            setcookie('id', $id, time() + (3600 * 24 * 7) , "/");
            setcookie('username', $username, time() + (3600 * 24 * 7) , "/");
            setcookie('token', $token, time() + (3600 * 24 * 7) , "/");
        }

        public static function recordSession($cbd, $id, $username, $remember) {
            $cbd->prepare("DELETE FROM sessions WHERE sessions_userid = :id")
                ->execute(array(
                ':id' => $id
            ));
            $token = func::createSerial(40);
            if ($remember == 1) {
                func::createCookie($id, $username, $token);
            }
            func::createSession($id, $username, $token);
            $stmt = $cbd->prepare("INSERT INTO sessions (sessions_id, sessions_token, sessions_date, sessions_userid) VALUES (NULL, :token, now(), :userid);");
            $stmt->execute(array(
                ':token' => $token,
                ':userid' => $id
            ));
        }
    }