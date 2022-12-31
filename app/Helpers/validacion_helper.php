<?php
	public function validar_año_mes_dia($fecha){
        
        $datos1 = array();
        if(!empty($fecha)){
            
            $datos1 = explode('/', $fecha);
            
            if(!empty($datos1)){
                $datos1 = explode('-', $fecha);
            }
        }

        if(!empty($datos1)){
            echo '<pre>'; print_r($datos1); echo '</pre>';            
            $año=$datos1[0];
            $mes=$datos1[1];
            $dia=$datos1[2];
            echo $año.'-'.$mes.'-'.$dia;
        }

    }