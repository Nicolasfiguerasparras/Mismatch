<?php

    class ConectorBD {
        
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

        public function printHello(){
            return "Hello";
        }
    }