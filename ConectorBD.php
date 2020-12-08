<?php

    /**
     * Clase encargada de conectarse a la base de datos
     */

    class ConectorBD {
        
        /* $configuracion es el array que va a contener los datos que van a formar el dns para establecer la conexión. Esos datos están en un array a parte, guardados en un archivo php. Cuando quieras crear una conexión a una base de datos, crearas un objeto de esta clase, que, recopilará los datos de conexión, en su constructor, y llamará a un método que será el que cree el objeto PDO que realmente se conecta a la base de datos.*/
        protected $configuracion;
        public $dbc;

        public function __construct($confiArray){
            $this->configuracion = $confiArray;
            $this->establecerConexion();
        }

        public function establecerConexion(){
            $dns = ''.$this->configuracion['driver'].':host='.$this->configuracion['host'].';dbname='.$this->configuracion['dbname'];
            $opciones =array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            );
            try{
                $this->dbc =new PDO($dns,$this->configuracion['username'],$this->configuracion['password'],$opciones);
            }catch(PDOException $e){
                echo __LINE__ . $e->getMessage();
            }
        }

        public function consultaConRetorno($sql){
            try{
                $resultado = $this->dbc->query($sql);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $resultado;
        }
        
        public function retornoNumTuplas($sql){
            try{
                $resultado = $this->dbc->exec($sql);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $resultado;
        }
        
        public function getCon(){
            if($this->dbc instanceof PDO){
                return $this->dbc;
            }
        }
    }