<?php

namespace App\Controllers;

use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;

class Rol extends ResourceController
{
    
    public function index()
    {

        try {
            $rol_model=new  RolModel();
            $datos=$rol_model->getRol();
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }           

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

        
    }

    public function seleccionarsegunidinmueble($id =null)        
    {        

        try {
            $in_id=$this->request->getPost('in_id');
            
            $inmueble_pago_mensual_model=new  InmueblePagoMensualModel();
            $datos=$inmueble_pago_mensual_model->getPago($in_id);
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }   
            /*=====  End of Busqueda  ======*/
            
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
    }

    public function delete($id = null)
    {
        try {
            $ea_id=$this->request->getPost('ea_id');

            $datos=array(
                "ea_estado"=>0,
            );            
            $en_arriendo_model=new  EnArriendoModel();
            $en_arriendo_model->eliminar($ea_id,$datos);           
            return $this->genericResponse("Eliminado con exito", null, 200);  

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }

    public function create()
    {

        try {
            
                        
            $in_id=$this->request->getPost('in_id');
            $ipm_fecha_pago=$this->request->getPost('ipm_fecha_pago');
            $ipm_valor_mensual=$this->request->getPost('ipm_valor_mensual');
            
            $datos =array(
                "in_id"=> $in_id,
                "ipm_fecha_pago"=> $ipm_fecha_pago,
                "ipm_valor_mensual"=> $ipm_valor_mensual,
                "ipm_estado"=> 1,
            );
            
            
            $inmueble_pago_mensual_model=new  InmueblePagoMensualModel();
            $inmueble_pago_mensual_model->insertar($datos);   

            return $this->genericResponse("Ingresado con exito",null, 200);     

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
        
    }

    public function update($id = null)
    {
        try {
            $ipm_id=$this->request->getPost('ipm_id');
            $ipm_fecha_pago=$this->request->getPost('ipm_fecha_pago');
            $ipm_valor_mensual=$this->request->getPost('ipm_valor_mensual');
            
            $datos =array(
                "ipm_fecha_pago"=> $ipm_fecha_pago,
                "ipm_valor_mensual"=> $ipm_valor_mensual,
                "ipm_estado"=> 1,
            );
            
            
            $inmueble_pago_mensual_model=new  InmueblePagoMensualModel();
            $inmueble_pago_mensual_model->actualizar($ipm_id,$datos);   

            return $this->genericResponse("editado con exito",null, 200);
            
                

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

    }

    private function genericResponse($data, $msj, $code)
    {

        if ($code == 200) {
            return $this->respond(array(
                "data" => $data,
                "code" => $code
            )); //, 404, "No hay nada"
        } else {
            return $this->respond(array(
                "msj" => $msj,
                "code" => $code
            ));
        }
    }
}