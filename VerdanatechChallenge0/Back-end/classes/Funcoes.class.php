<?php

class Funcoes {
    public function caracterTratar($val, $tipo){
        switch($tipo){
            case 1: 
                $rst = utf8_decode($val);
                break;
            case 2:
                $rst = htmlentities($val, ENT_QUOTES, "ISO-8859-1");
                break;
        }
        return $rst;
    }

    public function dataAtual($tipo){
        switch ($tipo) {
            case 1: 
                $rst = date("Y-m-d h:i:s"); 
                break;
            case 2: 
                $rst = date("d-m-Y"); 
                break;
            
        }
        return $rst;
    }

    public function base64($val, $tipo){
        switch ($tipo){
            case 1:
                $rst = base64_encode($val);
                break;
            case 2:
                $rst = base64_decode($val);
                break;
        }
        return $rst;

    }
    


}



?>