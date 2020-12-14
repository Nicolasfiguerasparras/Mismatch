<?php

    class ConectorBD {
        
        protected $configuracion;
        public $dbc;

        public function __construct($confiArray){
            $this->configuracion = $confiArray;
            $this->startConnection();
        }

        public function startConnection(){
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

        public function queryWithReturn($sql){
            try{
                $result = $this->dbc->query($sql);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }
        
        public function returnTupleNumber($sql){
            try{
                $result = $this->dbc->exec($sql);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }
        
        public function getConnection(){
            if($this->dbc instanceof PDO){
                return $this->dbc;
            }
        }
    }